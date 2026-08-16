<?php

class SettingModel extends Model
{
    protected string $table = 'settings';

    public function get(string $key, ?string $default = null): ?string
    {
        $rows = $this->query('SELECT value FROM settings WHERE skey = ?', [$key]);
        return isset($rows[0]) ? $rows[0]['value'] : $default;
    }

    public function set(string $key, string $value): void
    {
        $this->execute(
            'INSERT INTO settings (skey, value) VALUES (?, ?)
             ON DUPLICATE KEY UPDATE value = VALUES(value)',
            [$key, $value]
        );
    }

    public function all(?string $orderBy = null): array
    {
        $rows = parent::all($orderBy ?? 'skey ASC');
        $out = [];
        foreach ($rows as $row) {
            $out[$row['skey']] = $row['value'];
        }
        return $out;
    }
}
