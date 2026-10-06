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

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = filter_var(
    $_POST['tahun'] ?? '',
    FILTER_VALIDATE_INT
);
$isbn = trim($_POST['isbn'] ?? '');
$stok = filter_var(
    $_POST['stok'] ?? '',
    FILTER_VALIDATE_INT
);
$kategori = trim($_POST['kategori'] ?? '');

$kategoriValid = [
    'fiksi',
    'non-fiksi',
    'referensi'
];

$errors = [];
if (!$id || $id <= 0) {
    $errors[] = "ID buku tidak valid.";
}
if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}

if (strlen($judul) > 200) {
    $errors[] = "Judul terlalu panjang.";
}

if ($pengarang === '') {
    $errors[] = "Pengarang wajib diisi.";
}

if (strlen($pengarang) > 100) {
    $errors[] = "Nama pengarang terlalu panjang.";
}

if (
    $tahun === false ||
    $tahun < 1900 ||
    $tahun > 2026
) {
    $errors[] = "Tahun harus di antara 1900-2026.";
}

if (
    $stok === false ||
    $stok < 0
) {
    $errors[] = "Stok tidak boleh negatif.";
}

if (!in_array($kategori, $kategoriValid, true)) {
    $errors[] = "Kategori tidak valid.";
}

if (strlen($isbn) > 30) {
    $errors[] = "ISBN terlalu panjang.";
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
    "UPDATE buku
     SET judul = :judul,
         pengarang = :pengarang,
         tahun = :tahun,
         isbn = :isbn,
         stok = :stok,
         kategori = :kategori
     WHERE id = :id"
);

$stmt->execute([
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => $tahun,
    'isbn' => $isbn,
    'stok' => $stok,
    'kategori' => $kategori,
    'id' => $id
]);

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Buku berhasil diperbarui.'
];

header('Location: list.php');
exit;