<?php
session_start();
require_once '../config/config.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/PrestasiController.php';

$authController = new AuthController($conn);

if (isset($_SESSION['user'])) {
    $authController->isSessionActive();
}

$prestasiController = new PrestasiController($conn);

$page = isset($_GET['page']) ? $_GET['page'] : 'login';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'logout') {
    $authController->logout();
}
if ($action == 'login') {
    $authController->login();
}

if ($page == 'home') {
    include '../app/views/mahasiswa/home.php';
}

if ($page == 'dosen_dashboard') {
    include '../app/views/dosen/dosen_dashboard.php';
}

if (isset($_POST['setujui']) && isset($_GET['id_prestasi'])) {
    $id_prestasi = $_GET['id_prestasi'];
    $prestasiController->setujuiPrestasi($id_prestasi);
}

if (isset($_POST['tolak']) && isset($_GET['id_prestasi']) && isset($_POST['alasan'])) {
    $id_prestasi = $_GET['id_prestasi'];
    $alasan = $_POST['alasan'];
    $prestasiController->tolakPrestasi($id_prestasi, $alasan);
}

if ($page == 'dosen_prestasi') {
    $prestasiList = $prestasiController->showAllPrestasi();
    include '../app/views/dosen/dosen_prestasi.php';
} elseif ($page == 'dosen_prestasi_detail') {
    $id_prestasi = isset($_GET['id_prestasi']) ? $_GET['id_prestasi'] : 0;
    if ($id_prestasi > 0) {
        $prestasiController->getPrestasiDetail($id_prestasi);
    } else {
        echo "ID Prestasi tidak valid.";
    }
}

if ($page == 'prestasi') {
    if (isset($_GET['id_prestasi'])) {
        include '../app/views/mahasiswa/edit_prestasi.php';
    } else {
        include '../app/views/mahasiswa/prestasi.php';
    }
}

// Halaman Login
if ($page == 'login') {
    include '../app/views/login.php';
}
