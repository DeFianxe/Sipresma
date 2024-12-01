<?php include 'partials/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include 'partials/sidenav.php'; ?>
        </div>
        <div class="col-md-9">
            <h2>Detail Prestasi</h2>
            <?php if (isset($_SESSION['flash_message'])): ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['flash_message'];
                    unset($_SESSION['flash_message']);
                    ?>
                </div>

            <?php endif; ?>
            <?php if ($prestasi['status_pengajuan'] != 'disetujui') : ?>
                <form action="index.php?page=dosen_prestasi_detail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>" method="POST">
                    <button type="submit" name="setujui" class="btn btn-success">Setujui</button>
                </form>

                <form action="index.php?page=dosen_prestasi_detail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>" method="POST">
                    <button type="submit" name="show_tolak_form" class="btn btn-danger mt-3">Tolak</button>
                </form>

                <?php if (isset($_POST['show_tolak_form'])) : ?>
                    <form action="index.php?page=dosen_prestasi_detail&id_prestasi=<?php echo $prestasi['id_prestasi']; ?>" method="POST">
                        <div class="form-group mt-3">
                            <label for="alasan">Alasan Penolakan:</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="3"></textarea>
                        </div>
                        <button type="submit" name="tolak" class="btn btn-danger mt-3">Tolak</button>
                    </form>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!empty($alasanPenolakan)) : ?>
                <div class="mt-3">
                    <h5>Alasan Penolakan:</h5>
                    <?php foreach ($alasanPenolakan as $alasan) : ?>
                        <div class="alert alert-warning">
                            <strong><?php echo htmlspecialchars($alasan['tgl_penolakan']); ?>:</strong> <?php echo htmlspecialchars($alasan['alasan']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>
                        <?php echo isset($prestasi['tgl_pengajuan']) ? htmlspecialchars($prestasi['tgl_pengajuan']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td>
                        <?php echo isset($prestasi['program_studi']) ? htmlspecialchars($prestasi['program_studi']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Tahun Akademik</th>
                    <td>
                        <?php echo isset($prestasi['thn_akademik']) ? htmlspecialchars($prestasi['thn_akademik']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Kategori Akademik</th>
                    <td>
                        <?php echo isset($prestasi['kategori_akademik']) ? htmlspecialchars($prestasi['kategori_akademik']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>URL Kompetisi</th>
                    <td>
                        <?php echo isset($prestasi['url_kompetisi']) ? '<a href="' . htmlspecialchars($prestasi['url_kompetisi']) . '" target="_blank">Link Kompetisi</a>' : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Jenis Kompetisi</th>
                    <td>
                        <?php echo isset($prestasi['jenis_kompetisi']) ? htmlspecialchars($prestasi['jenis_kompetisi']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Tingkat Kompetisi</th>
                    <td>
                        <?php echo isset($prestasi['tingkat_kompetisi']) ? htmlspecialchars($prestasi['tingkat_kompetisi']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Judul Kompetisi</th>
                    <td>
                        <?php echo isset($prestasi['judul_kompetisi']) ? htmlspecialchars($prestasi['judul_kompetisi']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Tempat Kompetisi</th>
                    <td>
                        <?php echo isset($prestasi['tempat_kompetisi']) ? htmlspecialchars($prestasi['tempat_kompetisi']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Jumlah PT</th>
                    <td>
                        <?php echo isset($prestasi['jumlah_pt']) ? htmlspecialchars($prestasi['jumlah_pt']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Jumlah Peserta</th>
                    <td>
                        <?php echo isset($prestasi['jumlah_peserta']) ? htmlspecialchars($prestasi['jumlah_peserta']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>No. Surat Tugas</th>
                    <td>
                        <?php echo isset($prestasi['no_surat_tugas']) ? htmlspecialchars($prestasi['no_surat_tugas']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Surat Tugas</th>
                    <td>
                        <?php echo isset($prestasi['tgl_surat_tugas']) ? htmlspecialchars($prestasi['tgl_surat_tugas']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>File Surat Tugas</th>
                    <td>
                        <?php echo isset($prestasi['file_surat_tugas']) ? '<a href="uploads/' . htmlspecialchars($prestasi['file_surat_tugas']) . '" target="_blank">Lihat File</a>' : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>File Sertifikat</th>
                    <td>
                        <?php echo isset($prestasi['file_sertifikat']) ? '<a href="uploads/' . htmlspecialchars($prestasi['file_sertifikat']) . '" target="_blank">Lihat Sertifikat</a>' : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Foto Kegiatan</th>
                    <td>
                        <?php echo isset($prestasi['foto_kegiatan']) ? '<img src="uploads/' . htmlspecialchars($prestasi['foto_kegiatan']) . '" alt="Foto Kegiatan" width="100">' : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>File Poster</th>
                    <td>
                        <?php echo isset($prestasi['file_poster']) ? '<a href="uploads/' . htmlspecialchars($prestasi['file_poster']) . '" target="_blank">Lihat Poster</a>' : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Status Pengajuan</th>
                    <td>
                        <?php echo isset($prestasi['status_pengajuan']) ? htmlspecialchars($prestasi['status_pengajuan']) : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Lampiran Hasil Kompetisi</th>
                    <td>
                        <?php echo isset($prestasi['lampiran_hasil_kompetisi']) ? '<a href="uploads/' . htmlspecialchars($prestasi['lampiran_hasil_kompetisi']) . '" target="_blank">Lihat Lampiran</a>' : 'Data Tidak Tersedia'; ?>
                    </td>
                </tr>
                <tr>
                    <th>Nama Mahasiswa</th>
                    <td>
                        <?php
                        if (isset($prestasi['nama_mahasiswa'])) {
                            $nama_mahasiswa = explode(', ', $prestasi['nama_mahasiswa']);

                            if (count($nama_mahasiswa) > 1) {
                                echo '<ul>';
                                foreach ($nama_mahasiswa as $nama) {
                                    echo '<li>' . htmlspecialchars($nama) . '</li>';
                                }
                                echo '</ul>';
                            } else {
                                echo htmlspecialchars($nama_mahasiswa[0]);
                            }
                        } else {
                            echo 'Data Tidak Tersedia';
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <th>Nama Dosen</th>
                    <td>
                        <?php
                        if (isset($prestasi['nama_dosen'])) {
                            $nama_dosen = explode(',', $prestasi['nama_dosen']);
                            if (count($nama_dosen) > 1) {
                                echo '<ul>';
                                foreach ($nama_dosen as $nama) {
                                    echo '<li>' . htmlspecialchars($nama) . '</li>';
                                }
                                echo '</ul>';
                            } else {
                                echo htmlspecialchars($nama_dosen[0]);
                            }
                        } else {
                            echo 'Data Tidak Tersedia';
                        }
                        ?>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>
<?php include 'partials/footer.php'; ?>