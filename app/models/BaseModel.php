<?php
require_once __DIR__ . '/../../core/Database.php';

class BaseModel
{
    public function __construct()
    {
        Database::connect();
    }

    protected function getUsers(): array
    {
        return Database::getUsers();
    }

    protected function addUser(array $user): void
    {
        Database::addUser($user);
    }

    protected function updateUser(int $id, array $newData): bool
    {
        return Database::updateUser($id, $newData);
    }

    protected function findUserByUsername(string $username): ?array
    {
        return Database::findUserByUsername($username);
    }

    protected function findUserByUsernameOrEmail(string $username, string $email): ?array
    {
        return Database::findUserByUsernameOrEmail($username, $email);
    }
}
