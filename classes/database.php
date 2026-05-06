<?php

namespace App;

use PDO;
use PDOException;

class Database {
    private $host = "localhost";
    private $dbname = "formular_sj";
    private $port = 3307;
    private $username = "root";
    private $password = "";

    private $conn;

    public function connect() {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname};port={$this->port}",
                    $this->username,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ]
                );
            } catch (PDOException $e) {
                die("Chyba pripojenia: " . $e->getMessage());
            }
        }

        return $this->conn;
    }
}