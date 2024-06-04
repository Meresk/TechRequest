<?php

namespace App\Models;

class User
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email,
        private int $role,
    ){
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function role(): int
    {
        return $this->role;
    }

}