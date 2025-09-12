<?php

abstract class User
{
    abstract public function isLoggedIn(): bool;
    abstract public function name(): string;
    abstract public function canRead(): bool;
    abstract public function canWrite(): bool;
    abstract public function canBan(): bool;
}