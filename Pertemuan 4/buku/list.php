<?php
require __DIR__ . '/../auth/auth.php';
$page_title = "Daftar Buku";

include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$perPage = 10;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM buku WHERE judul ILIKE :kw OR pengarang ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);

    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare(
        "SELECT *
         FROM buku
         WHERE judul ILIKE :kw
            OR pengarang ILIKE :kw
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );

    $stmt->bindValue('kw','%' . $keyword . '%', PDO::PARAM_STR );

} else {
    $totalRows = $pdo->query(
        "SELECT COUNT(*) FROM buku"
    )->fetchColumn();
    $stmt = $pdo->prepare(
        "SELECT *
         FROM buku
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );
}

$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalPages = max(
    1,
    (int) ceil($totalRows / $perPage)
);
?>

<section>
    <h2>Daftar Buku</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['pesan']) ?>
        </p>
    <?php endif; ?>

    <div class="search-box">
        <form method="get" action="list.php">
            <span>
                <label for="search-input">
                    Cari Judul atau Pengarang
                </label>
                <br>
                <input
                    type="text"
                    id="search-input"
                    name="q"
                    value="<?= htmlspecialchars($keyword) ?>"
                    placeholder="Ketik judul atau pengarang..."
                >
            </span>

            <button type="submit">
                Cari
            </button>
        </form>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarBuku)): ?>
                    <tr>
                        <td colspan="5">
                            Tidak ada data buku yang cocok.
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach ($daftarBuku as $buku): ?>
                        <tr>
                            <td><?= htmlspecialchars($buku['judul']) ?></td>
                            <td><?= htmlspecialchars($buku['pengarang']) ?></td>
                            <td><?= (int) $buku['tahun'] ?></td>
                            <td><?= (int) $buku['stok'] ?></td>
                            <td>
                                <a
                                    href="edit.php?id=<?= (int) $buku['id'] ?>"
                                    class="btn-edit"
                                >
                                    Edit
                                </a>

                                <?php if ($_SESSION['role'] === 'admin'): ?>
                                    <form
                                        action="hapus.php"
                                        method="post"
                                        class="form-hapus"
                                        style="display:inline;"
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
                                        <button
                                            type="submit"
                                            class="btn-hapus"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <nav class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a
                href="list.php?page=<?= $i ?><?= $keyword !== '' ? '&q=' . urlencode($keyword) : '' ?>"
                class="<?= $i === $page ? 'active' : '' ?>"
            >
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </nav>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>