<?php

abstract class Model
{
    protected PDO $db;
    protected string $table = '';

    public function __construct()
    {
        $this->db = Database::conn();
    }

    public function query(string $sql, array $params = []): array
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function execute(string $sql, array $params = []): int
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    public function all(string $orderBy = 'id DESC'): array
    {
        return $this->query("SELECT * FROM {$this->table} ORDER BY {$orderBy}");
    }

    public function find(int $id): ?array
    {
        $rows = $this->query("SELECT * FROM {$this->table} WHERE id = ?", [$id]);
        return $rows[0] ?? null;
    }

    public function create(array $data): int
    {
        $keys = array_keys($data);
        $cols = implode(', ', $keys);
        $placeholders = implode(', ', array_map(fn ($k) => ':' . $k, $keys));
        $stmt = $this->db->prepare("INSERT INTO {$this->table} ({$cols}) VALUES ({$placeholders})");
        $stmt->execute($data);
        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $data): int
    {
        $sets = implode(', ', array_map(fn ($k) => "{$k} = :{$k}", array_keys($data)));
        $data['id'] = $id;
        $stmt = $this->db->prepare("UPDATE {$this->table} SET {$sets} WHERE id = :id");
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function delete(int $id): int
    {
        return $this->execute("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    public function count(string $where = ''): int
    {
        $sql = "SELECT COUNT(*) AS c FROM {$this->table}";
        if ($where !== '') {
            $sql .= " WHERE {$where}";
        }
        $rows = $this->query($sql);
        return (int) ($rows[0]['c'] ?? 0);
    }
}
