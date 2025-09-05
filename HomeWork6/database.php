<?php

class Database {

    private $pdo;

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
    public function addTestUsers() {
        $statement = $this->pdo->query("SELECT COUNT(*) FROM users");
        if ($statement->fetchColumn() == 0) {
            $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
            $testPassword = password_hash('test123', PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users (first_name, last_name, email, password) 
                    VALUES 
                    ('Admin', 'Admin', 'admin@example.com', ?),
                    ('Test', 'Test', 'test@example.com', ?)";
            
            //Используется prepare() и execute() — это защита от взлома (SQL-инъекций).
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$adminPassword, $testPassword]);
        }
    }

    public function getAllUsers() {
    $statement = $this->pdo->query("SELECT * FROM users ORDER BY id");
    return $statement->fetchAll(PDO::FETCH_ASSOC);

    
    }
    public function findUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
  
    public function close() {
        $this->pdo = null;
    }
}
