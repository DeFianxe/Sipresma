<?php include 'partials/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include 'partials/sidenav.php'; ?>
        </div>
        <div class="col-md-9">
            <div class="container mt-4">
                <h2>Edit Prestasi</h2>
                <form action="/app/controllers/PrestasiController.php?action=update" method="POST">
                    <input type="hidden" name="id_prestasi" value="<?= $prestasi['id_prestasi']; ?>">

                    <div>
                        <label for="tgl_pengajuan">Tanggal Pengajuan:</label>
                        <input type="date" id="tgl_pengajuan" name="tgl_pengajuan" value="<?= $prestasi['tgl_pengajuan']; ?>" required>
                    </div>

                    <div>
                        <label for="thn_akademik">Tahun Akademik:</label>
                        <input type="text" id="thn_akademik" name="thn_akademik" value="<?= $prestasi['thn_akademik']; ?>" required>
                    </div>

                    <div>
                        <label for="jenis_kompetisi">Jenis Kompetisi:</label>
                        <input type="text" id="jenis_kompetisi" name="jenis_kompetisi" value="<?= $prestasi['jenis_kompetisi']; ?>" required>
                    </div>

                    <div>
                        <label for="juara">Juara:</label>
                        <input type="text" id="juara" name="juara" value="<?= $prestasi['juara']; ?>" required>
                    </div>

                    <div>
                        <label for="tingkat_kompetisi">Tingkat Kompetisi:</label>
                        <input type="text" id="tingkat_kompetisi" name="tingkat_kompetisi" value="<?= $prestasi['tingkat_kompetisi']; ?>" required>
                    </div>

                    <div>
                        <label for="judul_kompetisi">Judul Kompetisi:</label>
                        <input type="text" id="judul_kompetisi" name="judul_kompetisi" value="<?= $prestasi['judul_kompetisi']; ?>" required>
                    </div>

                    <div>
                        <label for="tempat_kompetisi">Tempat Kompetisi:</label>
                        <input type="text" id="tempat_kompetisi" name="tempat_kompetisi" value="<?= $prestasi['tempat_kompetisi']; ?>" required>
                    </div>

                    <div>
                        <label for="jumlah_pt">Jumlah PT:</label>
                        <input type="text" id="jumlah_pt" name="jumlah_pt" value="<?= $prestasi['jumlah_pt']; ?>" required>
                    </div>

                    <div>
                        <label for="jumlah_peserta">Jumlah Peserta:</label>
                        <input type="text" id="jumlah_peserta" name="jumlah_peserta" value="<?= $prestasi['jumlah_peserta']; ?>" required>
                    </div>

                    <div>
                        <label for="status_pengajuan">Status Pengajuan:</label>
                        <select id="status_pengajuan" name="status_pengajuan" required>
                            <option value="disetujui" <?= $prestasi['status_pengajuan'] == 'disetujui' ? 'selected' : ''; ?>>Disetujui</option>
                            <option value="ditolak" <?= $prestasi['status_pengajuan'] == 'ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                            <option value="belum disetujui" <?= $prestasi['status_pengajuan'] == 'belum disetujui' ? 'selected' : ''; ?>>Belum Disetujui</option>
                        </select>
                    </div>

                    <button type="submit" name="submit">Update Prestasi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>