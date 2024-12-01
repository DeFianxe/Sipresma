<?php include 'partials/header.php'; ?>

<h1>Selamat datang, <?php echo isset($_SESSION['user']['nama_mahasiswa']) ? $_SESSION['user']['nama_mahasiswa'] : 'Mahasiswa'; ?></h1>

<?php include 'partials/footer.php'; ?>