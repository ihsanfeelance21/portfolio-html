<?php

class Upload
{
    /**
     * Menyimpan upload gambar, mengembalikan array:
     * [ 'ok' => bool, 'path' => string|null (relatif /uploads/...), 'error' => string|null ]
     */
    public static function image(array $file): array
    {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return ['ok' => false, 'path' => null, 'error' => null]; // tidak ada file (opsional)
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['ok' => false, 'path' => null, 'error' => 'Gagal meng-upload file (error ' . $file['error'] . ').'];
        }

        $cfg = config('upload');

        if ($file['size'] > $cfg['max_size']) {
            return ['ok' => false, 'path' => null, 'error' => 'Ukuran file melebihi 2 MB.'];
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = $finfo ? finfo_file($finfo, $file['tmp_name']) : ($file['type'] ?? '');
        finfo_close($finfo);

        if (!in_array($mime, $cfg['allowed'], true)) {
            return ['ok' => false, 'path' => null, 'error' => 'Tipe file tidak diizinkan (' . $mime . ').'];
        }

        $ext = array_search($mime, $cfg['extensions'], true);
        if ($ext === false) {
            return ['ok' => false, 'path' => null, 'error' => 'Ekstensi tidak dikenal.'];
        }

        $filename = date('Ymd') . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
        $dir = $cfg['dir'];
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        if (!move_uploaded_file($file['tmp_name'], $dir . '/' . $filename)) {
            return ['ok' => false, 'path' => null, 'error' => 'Gagal menyimpan file.'];
        }

        return ['ok' => true, 'path' => '/uploads/' . $filename, 'error' => null];
    }

    public static function remove(?string $path): void
    {
        if (!$path || strpos($path, '/uploads/') !== 0) {
            return;
        }
        $file = APP_ROOT . '/public' . $path;
        if (is_file($file)) {
            @unlink($file);
        }
    }
}
