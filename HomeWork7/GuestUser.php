<?php

class GuestUser extends User
{
    public function isLoggedIn(): bool
    {
        return false;
    }

    public function name(): string
    {
        return 'Гость';
    }

    public function canRead(): bool
    {
        return true; 
    }

    public function canWrite(): bool
    {
        return false; // Гости не могут писать
    }

    public function canBan(): bool
    {
        return false; // Только админ может банить
    }
}