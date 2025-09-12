<?php

class AdminUser extends User
{
    public function isLoggedIn(): bool
    {
        return true;
    }

    public function name(): string
    {
        return 'Администратор';
    }

    public function canRead(): bool
    {
        return true; 
    }

    public function canWrite(): bool
    {
        return true; 
    }

    public function canBan(): bool
    {
        return true; // может банить
    }
}