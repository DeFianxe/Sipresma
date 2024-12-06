<?php include 'partials/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include 'partials/sidenav.php'; ?>
        </div>

        <div class="col-md-9">
            <?php if (isset($_SESSION['flash_message'])): ?>
                <div class="alert alert-<?= $_SESSION['flash_message']['type']; ?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['flash_message']['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['flash_message']); ?>
            <?php endif; ?>
            <a href="index.php?page=dosen_prestasi_add" class="btn btn-primary mb-3">Add Prestasi</a>
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <th>Tahun Akademik</th>
                        <th>Judul Kompetisi</th>
                        <th>Status Pengajuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prestasiList as $prestasi) : ?>
                        <tr>
                            <td><?php echo date('d-m-Y', strtotime($prestasi['tgl_pengajuan'])); ?></td>
                            <td><?php echo htmlspecialchars($prestasi['thn_akademik']); ?></td>
                            <td><?php echo htmlspecialchars($prestasi['judul_kompetisi']); ?></td>
                            <td><?php echo htmlspecialchars($prestasi['status_pengajuan'] ?? ''); ?></td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $prestasi['id_prestasi']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $prestasi['id_prestasi']; ?>">
                                        <li>
                                            <a class="dropdown-item" href="index.php?page=dosen_prestasi_detail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>">Lihat Detail</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="index.php?page=dosen_prestasi_edit&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>">Edit Prestasi</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="index.php?page=dosen_prestasi&action=delete&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>"
                                                onclick="return confirm('Are you sure you want to delete this prestasi?');">
                                                Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'partials/footer.php'; ?>