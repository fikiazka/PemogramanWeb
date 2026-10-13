<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/csrf.php';

// Menentukan path relatif dari root project
$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);

$__rel = ltrim(
    str_replace(
        '\\',
        '/',
        substr($__scriptDir, strlen($__jobsheetRoot))
    ),
    '/'
);

$base = $__rel === ''
    ? ''
    : str_repeat(
        '../',
        substr_count($__rel, '/') + 1
    );

$page_title = $page_title ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIMPUS-Mini<?= $page_title !== '' ? ' | ' . e($page_title) : '' ?></title>

    <link
        rel="stylesheet"
        href="<?= e($base) ?>assets/css/style.css"
    >
</head>
<body>

<header>
    <h1>SIMPUS-Mini</h1>

    <button
        type="button"
        id="nav-toggle-btn"
        class="nav-toggle-label"
        aria-label="Buka menu navigasi"
        aria-expanded="false"
    >
        &#9776;
    </button>

    <nav id="main-nav">
        <ul>
            <li>
                <a href="<?= e($base) ?>index.php">Beranda</a>
            </li>

            <?php if (isset($_SESSION['user_id'])): ?>

                <li>
                    <a href="<?= e($base) ?>buku/list.php">Daftar Buku</a>
                </li>

                <li>
                    <a href="<?= e($base) ?>buku/tambah.php">Tambah Buku</a>
                </li>

                <li>
                    <a href="<?= e($base) ?>anggota/list.php">Daftar Anggota</a>
                </li>

                <li>
                    <a href="<?= e($base) ?>anggota/tambah.php">Tambah Anggota</a>
                </li>

                <li>
                    <a href="<?= e($base) ?>peminjaman/tambah.php">Peminjaman Baru</a>
                </li>

                <li>
                    <a href="<?= e($base) ?>peminjaman/kembali.php">Pengembalian</a>
                </li>

                <li>
                    <a href="<?= e($base) ?>peminjaman/riwayat.php">Riwayat</a>
                </li>

                <li class="user-menu">
                    <span>
                        👤 <?= e($_SESSION['nama'] ?? 'Pengguna') ?>
                    </span>
                </li>

                <li>
                    <a href="<?= e($base) ?>auth/logout.php">Logout</a>
                </li>

            <?php else: ?>

                <li>
                    <a href="<?= e($base) ?>auth/login.php">Login</a>
                </li>

            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>