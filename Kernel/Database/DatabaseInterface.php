<?php

namespace App\Kernel\Database;

interface DatabaseInterface
{
    public function insert(string $table, array $data): int|false;

    /**
     * Задача метода в определенной таблице $table по определенным условиям $conditions искать запись и возвращать ее если она есть
     */
    public function first(string $table, array $conditions = []): ?array;

    public function get(string $table, array $conditions = [], array $order = [], int $limit = -1): array;

    public function delete(string $table, array $conditions = []): void;

    public function update(string $table, array $data, array $conditions = []): void;
}