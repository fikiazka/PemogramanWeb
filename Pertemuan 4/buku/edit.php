<?php
require __DIR__ . '/../auth/auth.php';
require __DIR__ . '/../includes/koneksi.php';
$page_title = "Edit Buku";
$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);

if (!$id || $id <= 0) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'ID buku tidak valid.'
    ];

    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare(
    "SELECT * FROM buku WHERE id = :id"
);

$stmt->execute([
    'id' => $id
]);

$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Data buku tidak ditemukan.'
    ];
    header('Location: list.php');
    exit;
}
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
include __DIR__ . '/../includes/header.php';
?>
<section>
    <h2>Edit Buku</h2>
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
            value="<?= (int) $buku['id'] ?>"
        >

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"
        >

        <div>
            <label for="judul">
                Judul
            </label>

            <input
                type="text"
                id="judul"
                name="judul"
                value="<?= htmlspecialchars($buku['judul']) ?>"
                required
            >
        </div>

        <div>
            <label for="pengarang">
                Pengarang
            </label>

            <input
                type="text"
                id="pengarang"
                name="pengarang"
                value="<?= htmlspecialchars($buku['pengarang']) ?>"
                required
            >
        </div>

        <div>
            <label for="tahun">
                Tahun
            </label>

            <input
                type="number"
                id="tahun"
                name="tahun"
                value="<?= (int) $buku['tahun'] ?>"
                min="1900"
                max="2026"
                required
            >
        </div>

        <div>
            <label for="isbn">
                ISBN
            </label>

            <input
                type="text"
                id="isbn"
                name="isbn"
                value="<?= htmlspecialchars($buku['isbn'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="stok">
                Stok
            </label>

            <input
                type="number"
                id="stok"
                name="stok"
                value="<?= (int) $buku['stok'] ?>"
                min="0"
                required
            >
        </div>

        <div>
            <label for="kategori">
                Kategori
            </label>

            <select
                id="kategori"
                name="kategori"
                required
            >

                <option
                    value="fiksi"
                    <?= $buku['kategori'] === 'fiksi' ? 'selected' : '' ?>
                >
                    Fiksi
                </option>

                <option
                    value="non-fiksi"
                    <?= $buku['kategori'] === 'non-fiksi' ? 'selected' : '' ?>
                >
                    Non-Fiksi
                </option>

                <option
                    value="referensi"
                    <?= $buku['kategori'] === 'referensi' ? 'selected' : '' ?>
                >
                    Referensi
                </option>

            </select>

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