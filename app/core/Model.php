<?php
// app/core/Model.php
class Model
{
    protected $db;

    public function __construct()
    {
        // load config DB
        $cfg = __DIR__ . '/../config/database.php';
        if (!file_exists($cfg)) {
            throw new \Exception("Database config not found: app/config/database.php");
        }
        require $cfg;

        // gunakan PDO
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->db = new PDO($dsn, DB_USER, DB_PASS, $options);
    }
}
