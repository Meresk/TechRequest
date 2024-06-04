<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Models\Role;
use App\Models\User;

class UserService
{
    public function __construct(
        private DatabaseInterface $db
    ) {
    }

    public function all(): array
    {
        $users = $this->db->get('users');

        $users = array_map(function ($user) {
            return new User(
                id: $user['id'],
                name: $user['name'],
                email: $user['email'],
                role: $user['role_id'],
            );
        }, $users);

        return $users;
    }

    public function delete(int $id): void
    {
        $this->db->delete('users', ['id' => $id]);
    }
}