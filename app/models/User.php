<?php
require_once 'BaseModel.php';

class User extends BaseModel
{
    public function findByUsername($username): ?array
    {
        return $this->findUserByUsername($username);
    }

    public function findByUsernameOrEmail($username, $email): ?array
    {
        return $this->findUserByUsernameOrEmail($username, $email);
    }

    public function verifyPassword($username, $password)
    {
        $user = $this->findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function create(array $data): void
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $data += [
            'first_name' => $data['first_name'] ?? '',
            'last_name' => $data['last_name'] ?? '',
            'phone' => $data['phone'] ?? null,
            'gender' => $data['gender'] ?? null,
            'birthdate' => $data['birthdate'] ?? null,
            'address' => $data['address'] ?? null,
            'avatar' => $data['avatar'] ?? null,
            'role' => $data['role'] ?? 'user',
            'status' => $data['status'] ?? 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->addUser($data);
    }

    public function updateProfile($username, array $data): bool
    {
        $user = $this->findByUsername($username);
        if (!$user) return false;

        $newData = [
            'first_name' => $data['first_name'] ?? $user['first_name'],
            'last_name' => $data['last_name'] ?? $user['last_name'],
            'email' => $data['email'] ?? $user['email'],
            'phone' => $data['phone'] ?? $user['phone'],
            'address' => $data['address'] ?? $user['address'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        return $this->updateUser($user['id'], $newData);
    }
}
