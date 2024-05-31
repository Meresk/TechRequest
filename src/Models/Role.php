<?php

namespace App\Models;

class Role
{
    public function __construct(
        private int $id,
        private string $title,
    ){
    }

    public function id(): int
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }
}