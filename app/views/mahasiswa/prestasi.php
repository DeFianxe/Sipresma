<?php
include 'partials/header.php';

$prestasiController = new PrestasiController($conn);
$id_mahasiswa = $_SESSION['user']['id_mahasiswa'];

$prestasiList = $prestasiController->showPrestasi($id_mahasiswa);
?>

<div class="prestasi-list">
    <h2>Daftar Prestasi Anda:</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Judul Kompetisi</th>
                <th>Tingkat Kompetisi</th>
                <th>Tempat</th>
                <th>Tanggal Pengajuan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($prestasiList) > 0): ?>
                <?php foreach ($prestasiList as $prestasi): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($prestasi['judul_kompetisi']); ?></td>
                        <td><?php echo htmlspecialchars($prestasi['tingkat_kompetisi']); ?></td>
                        <td><?php echo htmlspecialchars($prestasi['tempat_kompetisi']); ?></td>
                        <td><?php echo htmlspecialchars($prestasi['tgl_pengajuan']->format('Y-m-d')); ?></td>
                        <td>
                            <a href="update_prestasi.php?id=<?php echo $prestasi['id_prestasi']; ?>" class="btn btn-update">Update</a>
                            <a href="delete_prestasi.php?id=<?php echo $prestasi['id_prestasi']; ?>" class="btn btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Anda belum memiliki prestasi yang diajukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<?php include 'partials/footer.php'; ?>