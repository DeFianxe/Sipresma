<?php
session_start();
require_once '../config/config.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/PrestasiController.php';

$authController = new AuthController($conn);
$prestasiController = new PrestasiController($conn);

if (isset($_SESSION['user'])) {
    $authController->isSessionActive();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'login';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'logout') {
    $authController->logout();
    exit;
} elseif ($action === 'login') {
    $authController->login();
    exit;
}

switch ($page) {
    case 'home':
        include '../app/views/mahasiswa/home.php';
        break;

    case 'prestasi':
        if (isset($_GET['id_prestasi'])) {
            include '../app/views/mahasiswa/edit_prestasi.php';
        } else {
            include '../app/views/mahasiswa/prestasi.php';
        }
        break;

    case 'dosen_dashboard':
        include '../app/views/dosen/dosen_dashboard.php';
        break;

    case 'dosen_prestasi':
        if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id_prestasi'])) {
            $id_prestasi = $_GET['id_prestasi'];
            $prestasiController->deletePrestasi($id_prestasi);
        }
        $prestasiList = $prestasiController->showAllPrestasi();
        include '../app/views/dosen/dosen_prestasi.php';
        break;

    case 'dosen_prestasi_add':
        $mahasiswaList = $prestasiController->getMahasiswaList();
        $dosenList = $prestasiController->getDosenList();
        include '../app/views/dosen/dosen_prestasi_add.php';
        break;

    case 'dosen_prestasi_detail':
        if (isset($_GET['id_prestasi'])) {
            $id_prestasi = $_GET['id_prestasi'];
            $prestasiDetail = $prestasiController->showPrestasiDetail($id_prestasi);
        } else {
            echo "ID prestasi tidak ditemukan.";
        }
        break;

    case 'dosen_prestasi_edit':
        if (isset($_GET['id_prestasi'])) {
            $id_prestasi = $_GET['id_prestasi'];
            $prestasiDetail = $prestasiController->showPrestasiDetail($id_prestasi);

            if ($prestasiDetail) {
                include 'app/views/dosen/dosen_prestasi_edit.php';
            } else {
                echo "Data prestasi tidak ditemukan.";
            }
        } else {
            echo "ID prestasi tidak ditemukan.";
        }
        break;


    case 'addPrestasi':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data_prestasi = [
                'thn_akademik' => $_POST['thn_akademik'],
                'jenis_kompetisi' => $_POST['jenis_kompetisi'],
                'juara' => $_POST['juara'],
                'tingkat_kompetisi' => $_POST['tingkat_kompetisi'],
                'judul_kompetisi' => $_POST['judul_kompetisi'],
                'tempat_kompetisi' => $_POST['tempat_kompetisi'],
                'jumlah_pt' => $_POST['jumlah_pt'],
                'jumlah_peserta' => $_POST['jumlah_peserta']
            ];

            $mahasiswa_ids = $_POST['mahasiswa_ids'];
            $dosen_ids = $_POST['dosen_ids'];

            $prestasiController->addPrestasi($data_prestasi, $mahasiswa_ids, $dosen_ids);
        }
        break;
    case 'login':
        include '../app/views/login.php';
        break;

    default:
        echo "Halaman tidak ditemukan.";
        break;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['setujui']) && isset($_GET['id_prestasi'])) {
        $id_prestasi = (int)$_GET['id_prestasi'];
        $prestasiController->setujuiPrestasi($id_prestasi);
    } elseif (isset($_POST['tolak']) && isset($_GET['id_prestasi']) && isset($_POST['alasan'])) {
        $id_prestasi = (int)$_GET['id_prestasi'];
        $alasan = $_POST['alasan'];
        $prestasiController->tolakPrestasi($id_prestasi, $alasan);
    }
}
