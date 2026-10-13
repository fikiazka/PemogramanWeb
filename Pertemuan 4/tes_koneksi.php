<?php
try {
    $pdo = new PDO(
        "pgsql:host=localhost;port=5434;dbname=simpus_mini_deploy",
        getenv("DB_USER"),
        getenv("DB_PASSWORD")
    );
    echo "KONEKSI BERHASIL";
} catch (PDOException $e) {
    echo $e->getMessage();
}
