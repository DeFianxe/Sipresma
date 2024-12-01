<?php include 'partials/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include 'partials/sidenav.php'; ?>
        </div>

        <div class="col-md-9">
            <table border="1" cellpadding="10">
                <thead>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <th>Program Studi</th>
                        <th>Tahun Akademik</th>
                        <th>Kategori Akademik</th>
                        <th>Judul Kompetisi</th>
                        <th>Status Pengajuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prestasiList as $prestasi) : ?>
                        <tr>
                            <td><?php echo date('d-m-Y', strtotime($prestasi['tgl_pengajuan'])); ?></td>
                            <td><?php echo htmlspecialchars($prestasi['program_studi']); ?></td>
                            <td><?php echo htmlspecialchars($prestasi['thn_akademik']); ?></td>
                            <td><?php echo htmlspecialchars($prestasi['kategori_akademik']); ?></td>
                            <td><?php echo htmlspecialchars($prestasi['judul_kompetisi']); ?></td>
                            <td><?php echo htmlspecialchars($prestasi['status_pengajuan']); ?></td>
                            <td>
                                <!-- Dropdown action -->
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $prestasi['id_prestasi']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $prestasi['id_prestasi']; ?>">
                                        <li><a class="dropdown-item" href="index.php?page=dosen_prestasi_detail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>">Lihat Detail</a></li>
                                        <li><a class="dropdown-item" href="index.php?page=approve_prestasi&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>">Setuju</a></li>
                                        <li><a class="dropdown-item text-danger" href="index.php?page=reject_prestasi&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>">Tolak</a></li>
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
<?php include 'partials/footer.php'; ?>