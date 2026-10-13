<?php
require __DIR__ . '/auth/auth.php';
require __DIR__ . '/includes/koneksi.php';
$page_title = "Beranda";

/* AMBIL JUMLAH DATA DARI DATABASE */
$stmtBuku = $pdo->query("SELECT COUNT(*) FROM buku");
$totalBuku = $stmtBuku->fetchColumn();

$stmtAnggota = $pdo->query("SELECT COUNT(*) FROM anggota");
$totalAnggota = $stmtAnggota->fetchColumn();

$stmtPeminjaman = $pdo->query("
    SELECT COUNT(*)
    FROM peminjaman
    WHERE status = 'dipinjam'
");
$totalPeminjaman = $stmtPeminjaman->fetchColumn();

include __DIR__ . '/includes/header.php';
?>

<section>
    <h2>
        Selamat Datang di Sistem Perpustakaan Mini
    </h2>

    <p>
        Aplikasi sederhana untuk mengelola data buku
        dan anggota perpustakaan.
    </p>

    <p>
        Selamat datang,
        <strong>
            <?php echo htmlspecialchars($_SESSION['nama'] ?? 'Pengguna'); ?>
        </strong>.
    </p>
</section>

<section>
    <h2>Ringkasan</h2>

    <article>
        <h3>Total Buku</h3>
        <p><?php echo $totalBuku; ?></p>
    </article>

    <article>
        <h3>Total Anggota</h3>
        <p><?php echo $totalAnggota; ?></p>
    </article>

    <article>
        <h3>Sedang Dipinjam</h3>
        <p><?php echo $totalPeminjaman; ?></p>
    </article>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>