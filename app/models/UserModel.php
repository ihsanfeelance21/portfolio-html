<?php

class UserModel extends Model
{
    protected string $table = 'users';

    public function findByUsername(string $username): ?array
    {
        $rows = $this->query('SELECT * FROM users WHERE username = ?', [$username]);
        return $rows[0] ?? null;
    }

    public function updatePassword(int $id, string $passwordHash): int
    {
        return $this->execute('UPDATE users SET password_hash = ? WHERE id = ?', [$passwordHash, $id]);
    }
}
