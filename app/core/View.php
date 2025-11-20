<?php
// app/core/View.php
class View
{
    public static function render(string $layout, string $viewPath, array $data = [])
    {
        extract($data);
        $content = null;
        ob_start();
        require __DIR__ . '/../views/' . $viewPath . '.php';
        $content = ob_get_clean();
        require __DIR__ . '/../views/layouts/' . $layout . '.php';
    }
}
