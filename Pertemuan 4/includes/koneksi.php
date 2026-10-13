<?php

$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '5434';
$db   = getenv('DB_NAME') ?: 'simpus_mini';
$user = getenv('DB_USER') ?: 'postgres';
$pass = getenv('DB_PASSWORD');

try {
    if ($pass === false) {
        throw new RuntimeException(
            'Environment variable DB_PASSWORD belum diatur.'
        );
    }

    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db",
        $user,
        $pass
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (Throwable $e) {
    error_log('Koneksi database gagal: ' . $e->getMessage());
    http_response_code(500);
    exit('Koneksi database gagal. Periksa konfigurasi database.');
}