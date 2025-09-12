<?php

class RegisteredUser extends User
{
    public function isLoggedIn(): bool
    {
        return true;
    }

    public function name(): string
    {
        return 'Зарегистрированный пользователь';
    }

    public function canRead(): bool
    {
        return true; 
    }

    public function canWrite(): bool
    {
        return true; // могут писать
    }

    public function canBan(): bool
    {
        return false; //  не может банить
    }
}