<?php include 'partials/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include 'partials/sidenav.php'; ?>
        </div>
        <div class="col-md-9">
            <?php if ($prestasi): ?>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2>Detail Prestasi</h2>
                    <button onclick="window.location.href='edit_prestasi.php?id=<?= $prestasi['id_prestasi']; ?>'" class="btn btn-primary">Edit</button>
                </div>
                <table class="table">
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <td><?php echo date('d-m-Y', strtotime($prestasi['tgl_pengajuan'])); ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Akademik</th>
                        <td><?php echo htmlspecialchars($prestasi['thn_akademik']); ?></td>
                    </tr>
                    <tr>
                        <th>Judul Kompetisi</th>
                        <td><?php echo htmlspecialchars($prestasi['judul_kompetisi']); ?></td>
                    </tr>
                    <tr>
                        <th>Status Pengajuan</th>
                        <td><?php echo htmlspecialchars($prestasi['status_pengajuan']); ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kompetisi</th>
                        <td><?php echo htmlspecialchars($prestasi['jenis_kompetisi']); ?></td>
                    </tr>
                    <tr>
                        <th>Juara</th>
                        <td><?php echo htmlspecialchars($prestasi['juara']); ?></td>
                    </tr>
                    <tr>
                        <th>Tingkat Kompetisi</th>
                        <td><?php echo htmlspecialchars($prestasi['tingkat_kompetisi']); ?></td>
                    </tr>
                    <tr>
                        <th>Tempat Kompetisi</th>
                        <td><?php echo htmlspecialchars($prestasi['tempat_kompetisi']); ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah PT</th>
                        <td><?php echo htmlspecialchars($prestasi['jumlah_pt']); ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Peserta</th>
                        <td><?php echo htmlspecialchars($prestasi['jumlah_peserta']); ?></td>
                    </tr>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <td>
                            <ul>
                                <?php
                                echo $prestasi['nama_mahasiswa'];
                                ?>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Dosen</th>
                        <td>
                            <ul>
                                <?php
                                echo $prestasi['nama_dosen'];
                                ?>
                            </ul>
                        </td>
                    </tr>
                </table>
            <?php else: ?>
                <p>Data prestasi tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include 'partials/footer.php'; ?>