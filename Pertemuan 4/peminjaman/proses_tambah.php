<?php
require __DIR__ . '/../auth/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

csrf_verify();

$anggotaId = $_POST['anggota_id'] ?? '';
$bukuId = $_POST['buku_id'] ?? '';

if ($anggotaId === '' || $bukuId === '') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Anggota dan buku wajib dipilih.'
    ];
    header('Location: tambah.php');
    exit;
}

try {
    $pdo->beginTransaction();

    // Cek peminjaman aktif yang terlambat lebih dari 14 hari
    $cekTerlambat = $pdo->prepare("
        SELECT COUNT(*)
        FROM peminjaman
        WHERE anggota_id = :anggota_id
          AND status = 'dipinjam'
          AND tanggal_pinjam < CURRENT_DATE - 14
    ");

    $cekTerlambat->execute([
        'anggota_id' => $anggotaId
    ]);

    if ((int) $cekTerlambat->fetchColumn() > 0) {
        throw new Exception(
            'Peminjaman ditolak. Anggota memiliki peminjaman terlambat lebih dari 14 hari.'
        );
    }

    // Kunci baris buku agar stok tidak berubah
    // saat transaksi sedang diproses
    $cek = $pdo->prepare(
        "SELECT stok FROM buku WHERE id = :id FOR UPDATE"
    );

    $cek->execute(['id' => $bukuId]);
    $buku = $cek->fetch(PDO::FETCH_ASSOC);

    if (!$buku || $buku['stok'] < 1) {
        throw new Exception('Stok buku tidak tersedia.');
    }

    // Simpan transaksi peminjaman
    $insert = $pdo->prepare("
        INSERT INTO peminjaman
            (buku_id, anggota_id, tanggal_pinjam, status)
        VALUES
            (:buku_id, :anggota_id, CURRENT_DATE, 'dipinjam')
    ");

    $insert->execute([
        'buku_id' => $bukuId,
        'anggota_id' => $anggotaId
    ]);

    // Kurangi stok buku
    $update = $pdo->prepare(
        "UPDATE buku SET stok = stok - 1 WHERE id = :id"
    );

    $update->execute(['id' => $bukuId]);

    $pdo->commit();

    $_SESSION['flash'] = [
        'type' => 'success',
        'pesan' => 'Peminjaman berhasil dicatat.'
    ];

    header('Location: ../index.php');
    exit;

} catch (Throwable $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Gagal mencatat peminjaman: ' . $e->getMessage()
    ];

    header('Location: tambah.php');
    exit;
}