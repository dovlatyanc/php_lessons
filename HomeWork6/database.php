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
    //создаем БД если ее нет
    public function initDatabase() {
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        first_name TEXT NOT NULL,
        last_name TEXT NOT NULL,
        email TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL
    )";
    
    $this->pdo->exec($sql);
}
}