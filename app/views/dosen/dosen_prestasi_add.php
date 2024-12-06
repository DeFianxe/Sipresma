<?php include 'partials/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <?php include 'partials/sidenav.php'; ?>
        </div>
        <div class="col-md-9">
            <form action="index.php?page=addPrestasi" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label for="judul_kompetisi" class="form-label">Judul Kompetisi</label>
                    <input type="text" name="judul_kompetisi" id="judul_kompetisi" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="thn_akademik" class="form-label">Tahun Akademik</label>
                    <input type="text" name="thn_akademik" id="thn_akademik" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="jenis_kompetisi" class="form-label">Jenis Kompetisi</label>
                    <input type="text" name="jenis_kompetisi" id="jenis_kompetisi" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="juara" class="form-label">Juara</label>
                    <input type="text" name="juara" id="juara" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="tingkat_kompetisi" class="form-label">Tingkat Kompetisi</label>
                    <input type="text" name="tingkat_kompetisi" id="tingkat_kompetisi" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="tempat_kompetisi" class="form-label">Tempat Kompetisi</label>
                    <input type="text" name="tempat_kompetisi" id="tempat_kompetisi" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="jumlah_pt" class="form-label">Jumlah Perguruan Tinggi</label>
                    <input type="number" name="jumlah_pt" id="jumlah_pt" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="jumlah_peserta" class="form-label">Jumlah Peserta</label>
                    <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="mahasiswa" class="form-label">Mahasiswa</label>
                    <select name="mahasiswa_ids[]" id="mahasiswa" class="form-select" multiple>
                        <?php foreach ($mahasiswaList as $mahasiswa): ?>
                            <option value="<?= $mahasiswa['id_mahasiswa'] ?>">
                                <?= htmlspecialchars($mahasiswa['nama_mahasiswa']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted">* Tahan tombol Ctrl/Command untuk memilih lebih dari satu mahasiswa</small>
                </div>

                <div class="col-md-6">
                    <label for="dosen" class="form-label">Dosen</label>
                    <select name="dosen_ids[]" id="dosen" class="form-select" multiple>
                        <?php foreach ($dosenList as $dosen): ?>
                            <option value="<?= $dosen['id_dosen'] ?>">
                                <?= htmlspecialchars($dosen['nama_dosen']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted">* Tahan tombol Ctrl/Command untuk memilih lebih dari satu dosen</small>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100">Tambah Prestasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'partials/footer.php'; ?>