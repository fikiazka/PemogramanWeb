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

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);

$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

$errors = [];

if (!$id || $id <= 0) {
    $errors[] = "ID anggota tidak valid.";
}

if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}

if (strlen($nama) > 100) {
    $errors[] = "Nama terlalu panjang.";
}

if ($noAnggota === '') {
    $errors[] = "No. Anggota wajib diisi.";
}

if (strlen($noAnggota) > 50) {
    $errors[] = "No. Anggota terlalu panjang.";
}

if (strlen($alamat) > 255) {
    $errors[] = "Alamat terlalu panjang.";
}

if (strlen($noHp) > 30) {
    $errors[] = "No. HP terlalu panjang.";
}

if (!empty($errors)) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];

    header(
        'Location: edit.php?id=' . urlencode($id)
    );

    exit;
}

require __DIR__ . '/../includes/koneksi.php';

$stmt = $pdo->prepare(
    "UPDATE anggota
     SET nama = :nama,
         no_anggota = :no_anggota,
         alamat = :alamat,
         no_hp = :no_hp
     WHERE id = :id"
);

$stmt->execute([
    'nama' => $nama,
    'no_anggota' => $noAnggota,
    'alamat' => $alamat,
    'no_hp' => $noHp,
    'id' => $id
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Anggota berhasil diperbarui.'
];

header('Location: list.php');
exit;