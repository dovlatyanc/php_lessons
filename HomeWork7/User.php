<?php

abstract class User
{
    abstract public function isLoggedIn(): bool;
    abstract public function name(): string;
    abstract public function canRead(): bool;
    abstract public function canWrite(): bool;
    abstract public function canBan(): bool;
    public function __toString(): string
        {
            $name = htmlspecialchars($this->name(), ENT_QUOTES, 'UTF-8');
            $loggedIn = $this->isLoggedIn() ? '✅ Да' : '❌ Нет';
            $canRead = $this->canRead() ? '✅ Да' : '❌ Нет';
            $canWrite = $this->canWrite() ? '✅ Да' : '❌ Нет';
            $canBan = $this->canBan() ? '✅ Да' : '❌ Нет';

            return 
            '<div class="user-info">' .
                '<p><strong>Имя:</strong> ' . $name . '</p>' .
                '<p><strong>Вошёл в систему:</strong> ' . $loggedIn . '</p>' .
                '<p><strong>Может читать:</strong> ' . $canRead . '</p>' .
                '<p><strong>Может писать:</strong> ' . $canWrite . '</p>' .
                '<p><strong>Может банить:</strong> ' . $canBan . '</p>' .
            '</div>';
        }
}