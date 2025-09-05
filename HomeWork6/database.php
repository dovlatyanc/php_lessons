<?php

class Database {
    private PDO $pdo;



    public function __construct(){
        try {
            
            $this->pdo = new PDO('sqlite:users.sqlite');
            
            // Устанавливаем режим ошибок - исключения
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Ошибка подключения к базе данных: " . $e->getMessage());
        }
    }
}