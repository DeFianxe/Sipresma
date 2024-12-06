<?php include 'partials/header.php'; ?>

<h1>Selamat datang, <?php echo isset($_SESSION['user']['nama_mahasiswa']) ? $_SESSION['user']['nama_mahasiswa'] : 'Mahasiswa'; ?></h1>

<?php echo isset($_SESSION['user']['email_mahasiswa']) ? $_SESSION['user']['email_mahasiswa'] : 'Email Mahasiswa'; ?>

<?php echo isset($_SESSION['user']['program_studi']) ? $_SESSION['user']['program_studi'] : 'PRODI'; ?>

<?php echo isset($_SESSION['user']['telp_mahasiswa']) ? $_SESSION['user']['telp_mahasiswa'] : 'PRODI'; ?>

<?php include 'partials/footer.php'; ?>