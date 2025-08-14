<?php

class Database
{
    protected static string $file = __DIR__ . '/database.json';
    protected static array $data = [];

    public static function connect(): void
    {
        if (!file_exists(self::$file)) {
            file_put_contents(self::$file, json_encode(['users' => []], JSON_PRETTY_PRINT));
        }
        $json = file_get_contents(self::$file);
        self::$data = json_decode($json, true) ?? ['users' => []];
    }

    public static function save(): void
    {
        file_put_contents(self::$file, json_encode(self::$data, JSON_PRETTY_PRINT));
    }

    public static function init(): void
    {
        self::connect();
        if (!isset(self::$data['users'])) {
            self::$data['users'] = [];
            self::save();
        }
    }

    public static function getUsers(): array
    {
        self::connect();
        return self::$data['users'];
    }

    public static function addUser(array $user): void
    {
        self::connect();
        $maxId = 0;
        foreach (self::$data['users'] as $u) {
            if ($u['id'] > $maxId) $maxId = $u['id'];
        }
        $user['id'] = $maxId + 1;
        self::$data['users'][] = $user;
        self::save();
    }

    public static function updateUser(int $id, array $newData): bool
    {
        self::connect();
        foreach (self::$data['users'] as &$user) {
            if ($user['id'] === $id) {
                $user = array_merge($user, $newData);
                self::save();
                return true;
            }
        }
        return false;
    }

    public static function findUserByUsernameOrEmail(string $username, string $email): ?array
    {
        self::connect();
        foreach (self::$data['users'] as $user) {
            if ($user['username'] === $username || $user['email'] === $email) {
                return $user;
            }
        }
        return null;
    }

    public static function findUserByUsername(string $username): ?array
    {
        self::connect();
        foreach (self::$data['users'] as $user) {
            if ($user['username'] === $username) return $user;
        }
        return null;
    }
}
