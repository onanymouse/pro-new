<?php
// app/core/Controller.php
class Controller
{
    protected function view(string $view, array $data = []): void
    {
        // $viewPath relatif ke /app/views/
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        extract($data);

        // jika layout spesifik (auth) view akan include layout sendiri
        require $viewPath;
    }

    protected function model(string $model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model;
    }
}
