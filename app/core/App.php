<?php

class App
{
    protected $controller = 'DashboardController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        // Ambil URI
        $url = $this->parseUrl();

        // --- Routing sederhana berdasarkan URL ---
        // Jika ada controller sesuai URL, gunakan, jika tidak pakai default DashboardController
        if (isset($url[0]) && file_exists(__DIR__ . '/../controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        // Inisialisasi controller
        $this->controller = new $this->controller;

        // Method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Parameters
        $this->params = $url ? array_values($url) : [];

        // --- Middleware untuk auth ---
        $publicRoutes = ['login', 'auth']; // semua controller public
        $currentController = strtolower(str_replace('Controller','',get_class($this->controller)));
        if (!in_array($currentController, $publicRoutes)) {
            AuthMiddleware::handle();
        }

        // Jalankan controller + method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            // Bersihkan URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}