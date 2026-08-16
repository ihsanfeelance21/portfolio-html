<?php

/**
 * CLI: Migrasi & seed database.
 * Dijalankan di dalam container saat deploy:
 *   docker compose exec -T app php migrate.php
 *
 * Idempotent: membuat tabel bila belum ada, seed bila tabel users kosong,
 * lalu memastikan password admin sesuai env (ADMIN_PASSWORD / default admin123).
 */

declare(strict_types=1);

define('APP_ROOT', __DIR__);
define('APP_DIR', APP_ROOT . '/app');
define('CONFIG_DIR', APP_DIR . '/config');
define('VIEWS_DIR', APP_DIR . '/views');

require APP_DIR . '/helpers.php';

spl_autoload_register(function (string $class): void {
    foreach (['core', 'models'] as $dir) {
        $file = APP_DIR . '/' . $dir . '/' . $class . '.php';
        if (is_file($file)) {
            require $file;
            return;
        }
    }
});

function db_connect_with_retry(int $attempts = 40): PDO
{
    for ($i = 1; $i <= $attempts; $i++) {
        try {
            return Database::conn();
        } catch (Throwable $e) {
            echo "  db belum siap ({$i}/{$attempts})...\n";
            sleep(2);
        }
    }
    fwrite(STDERR, "!! Gagal konek ke database setelah {$attempts} percobaan.\n");
    exit(1);
}

function run_sql_file(PDO $db, string $file): void
{
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    if ($lines === false) {
        fwrite(STDERR, "!! File SQL tidak ditemukan: {$file}\n");
        exit(1);
    }
    $clean = [];
    foreach ($lines as $line) {
        $trimmed = ltrim($line);
        if ($trimmed === '' || str_starts_with($trimmed, '--')) {
            continue;
        }
        $clean[] = $line;
    }
    $sql = implode("\n", $clean);
    foreach (array_filter(array_map('trim', explode(';', $sql))) as $statement) {
        if ($statement === '') {
            continue;
        }
        $db->exec($statement);
    }
}

$db = db_connect_with_retry();

echo "== Memastikan struktur tabel ==\n";
run_sql_file($db, APP_ROOT . '/database/schema.sql');

$userCount = (int) $db->query('SELECT COUNT(*) AS c FROM users')->fetch()['c'];
if ($userCount === 0) {
    echo "== Seed data awal ==\n";
    run_sql_file($db, APP_ROOT . '/database/seed.sql');
} else {
    echo "== Data sudah ada, seed dilewati ==\n";
}

// Password admin dari env (default admin123 untuk dev, wajib diganti di produksi)
$password = getenv('ADMIN_PASSWORD') ?: 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);
$db->prepare('UPDATE users SET password_hash = ? WHERE username = ?')
   ->execute([$hash, 'admin']);

$username = getenv('ADMIN_USERNAME') ?: 'admin';
echo "== Migrasi selesai. Admin: {$username} / (password dari ADMIN_PASSWORD) ==\n";
