<?php

require __DIR__ . '/../auth/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: list.php');
    exit;
}

if (
    !isset($_POST['csrf_token']) ||
    !isset($_SESSION['csrf_token']) ||
    !hash_equals(
        $_SESSION['csrf_token'],
        $_POST['csrf_token']
    )
) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Token keamanan tidak valid.'
    ];

    header('Location: list.php');
    exit;
}

if ($_SESSION['role'] !== 'admin') {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Anda tidak memiliki akses untuk menghapus anggota.'
    ];

    header('Location: list.php');
    exit;
}

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id || $id <= 0) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'ID anggota tidak valid.'
    ];

    header('Location: list.php');
    exit;
}

require __DIR__ . '/../includes/koneksi.php';

$stmt = $pdo->prepare(
    "DELETE FROM anggota WHERE id = :id"
);

$stmt->execute([
    'id' => $id
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Anggota berhasil dihapus.'
];

header('Location: list.php');
exit;