<?php
session_start();

require __DIR__ . '/../includes/koneksi.php';

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim(
    $_POST['kategori'] ?? ''
);
$errors = [];

if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}

if ($pengarang === '') {
    $errors[] = "Pengarang wajib diisi.";
}

if (
    $tahun === '' ||
    !is_numeric($tahun) ||
    $tahun < 1900 ||
    $tahun > 2026
) {
    $errors[] =
        "Tahun harus di antara 1900-2026.";
}
if ($tahun === '') {
    $errors[] = "Tahun wajib diisi.";
} elseif (!ctype_digit($tahun) || (int) $tahun < 1900 || (int) $tahun > 2026) {
    $errors[] = "Tahun harus berupa angka antara 1900 sampai 2026.";
}

if ($isbn === '') {
    $errors[] = "ISBN wajib diisi.";
} elseif (!ctype_digit($isbn)) {
    $errors[] = "ISBN hanya boleh berisi angka.";
}

if (
    $stok === '' ||
    !is_numeric($stok) ||
    $stok < 0
) {
    $errors[] =
        "Stok tidak boleh negatif.";
}

if ($kategori === '') {
    $errors[] =
        "Kategori wajib dipilih.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(
            ' ',
            $errors
        )
    ];
    header(
        'Location: tambah.php'
    );
    exit;
}

// SIMPAN KE DATABASE 
try {

    $stmt = $pdo->prepare("
        INSERT INTO buku
            (judul, pengarang, tahun, isbn, stok, kategori)
        VALUES
            (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)
        RETURNING id
    ");

    $stmt->execute([
        ':judul' => $judul,
        ':pengarang' => $pengarang,
        ':tahun' => (int) $tahun,
        ':isbn' => $isbn,
        ':stok' => (int) $stok,
        ':kategori' => $kategori
    ]);

    $id = $stmt->fetchColumn();

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Buku berhasil ditambahkan.'
    ];

    header('Location: list.php');
    exit;

} catch (PDOException $e) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Gagal menambahkan buku: ' . $e->getMessage()
    ];

    header('Location: tambah.php');
    exit;
}
?>