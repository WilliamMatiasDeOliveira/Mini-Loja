<?php
declare(strict_types=1);

namespace App\Functions;

use PDO;
use PDOException;

abstract class Connection{

    protected PDO $pdo;
    private string $host = HOST;
    private string $dbname = DBNAME;
    private string $user = USER;
    private string $pass = PASS;

    public function __construct()
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new PDOException("Falha na conexão: " . $e->getMessage());
        }
    }
}