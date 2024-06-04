<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Models\Role;

class RoleService
{
    public function __construct(
        private DatabaseInterface $db
    ) {
    }

    public function all(): array
    {
        $roles = $this->db->get('roles');

        $roles = array_map(function ($role) {
            return new Role(
                id: $role['id'],
                title: $role['title'],
            );
        }, $roles);

        return $roles;
    }

}