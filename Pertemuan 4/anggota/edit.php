<?php
require __DIR__ . '/../auth/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$page_title = "Edit Anggota";
$id = filter_input(
    INPUT_GET,
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

$stmt = $pdo->prepare(
    "SELECT * FROM anggota WHERE id = :id"
);

$stmt->execute([
    'id' => $id
]);

$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anggota) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Data anggota tidak ditemukan.'
    ];

    header('Location: list.php');
    exit;
}

$flash = $_SESSION['flash'] ?? null;

unset($_SESSION['flash']);

include __DIR__ . '/../includes/header.php';
?>

<section>

    <h2>Edit Anggota</h2>

    <?php if ($flash): ?>

        <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['pesan']) ?>
        </p>

    <?php endif; ?>

    <form
        action="proses_edit.php"
        method="post"
    >

        <input
            type="hidden"
            name="id"
            value="<?= (int) $anggota['id'] ?>"
        >

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
        >

        <div>

            <label for="no_anggota">
                No. Anggota
            </label>

            <input
                type="text"
                id="no_anggota"
                name="no_anggota"
                value="<?= htmlspecialchars($anggota['no_anggota']) ?>"
                required
            >

        </div>

        <div>

            <label for="nama">
                Nama
            </label>

            <input
                type="text"
                id="nama"
                name="nama"
                value="<?= htmlspecialchars($anggota['nama']) ?>"
                required
            >

        </div>

        <div>

            <label for="alamat">
                Alamat
            </label>

            <textarea
                id="alamat"
                name="alamat"
            ><?= htmlspecialchars($anggota['alamat']) ?></textarea>

        </div>

        <div>

            <label for="no_hp">
                No. HP
            </label>

            <input
                type="text"
                id="no_hp"
                name="no_hp"
                value="<?= htmlspecialchars($anggota['no_hp']) ?>"
            >

        </div>

        <button type="submit">
            Simpan Perubahan
        </button>

        <a href="list.php">
            Batal
        </a>

    </form>

</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>