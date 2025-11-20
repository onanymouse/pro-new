<?php
// app/core/App.php
class App
{
    protected $controller = 'DashboardController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // controller dari URL (mis: /auth/login -> AuthController)
        if (isset($url[0]) && file_exists(__DIR__ . '/../controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // params
        $this->params = $url ? array_values($url) : [];

        // middleware: protect non-public controllers
        $publicControllers = ['Auth']; // controller names without "Controller" suffix
        $currentController = str_replace('Controller', '', get_class($this->controller));
        if (!in_array($currentController, $publicControllers)) {
            // pastikan AuthMiddleware ada
            if (file_exists(__DIR__ . '/../middlewares/AuthMiddleware.php')) {
                require_once __DIR__ . '/../middlewares/AuthMiddleware.php';
                AuthMiddleware::handle();
            }
        }

        // eksekusi
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl(): array
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }

        // jika tidak ada url param, ambil dari REQUEST_URI (lebih friendly)
        $base = $_SERVER['SCRIPT_NAME']; // /public/index.php
        $uri = $_SERVER['REQUEST_URI'];
        $path = parse_url($uri, PHP_URL_PATH);
        $path = preg_replace('#/+$#','',$path);
        // hapus base folder kalau ada
        $scriptDir = str_replace('/index.php', '', $base);
        if ($scriptDir !== '' && strpos($path, $scriptDir) === 0) {
            $path = substr($path, strlen($scriptDir));
        }
        $path = ltrim($path, '/');
        return $path === '' ? [] : explode('/', $path);
    }
}
