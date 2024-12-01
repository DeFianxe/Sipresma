<?php
require_once __DIR__ . '/../models/PrestasiModel.php';

class PrestasiController
{
    private $prestasiModel;

    public function __construct($conn)
    {
        $this->prestasiModel = new PrestasiModel($conn);
    }

    public function showPrestasi($id_mahasiswa)
    {
        // Ambil daftar prestasi berdasarkan id mahasiswa
        return $this->prestasiModel->getPrestasiByMahasiswa($id_mahasiswa);
    }

    public function showAllPrestasi()
    {
        return $this->prestasiModel->getAllPrestasi();
    }

    public function getPrestasiDetail($id_prestasi)
    {
        // Mengambil detail prestasi
        $prestasi = $this->prestasiModel->getPrestasiById($id_prestasi);
        if ($prestasi) {
            $alasanPenolakan = $this->prestasiModel->getAlasanPenolakan($id_prestasi);

            include '../app/views/dosen/dosen_prestasi_detail.php';
        } else {
            echo "Prestasi tidak ditemukan.";
        }
    }

    public function setujuiPrestasi($id_prestasi)
    {
        if ($this->prestasiModel->updateStatusPrestasi($id_prestasi, 'disetujui')) {
            $_SESSION['flash_message'] = 'Data telah disetujui';
            header("Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi_detail&id_prestasi=" . $id_prestasi);
            exit();
        }
    }

    public function tolakPrestasi($id_prestasi)
    {
        if (isset($_POST['alasan']) && !empty($_POST['alasan'])) {
            $alasan = $_POST['alasan'];

            if ($this->prestasiModel->tolakPrestasi($id_prestasi, $alasan)) {
                $_SESSION['flash_message'] = 'Prestasi telah ditolak';
                header("Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi_detail&id_prestasi=" . $id_prestasi);
                exit();
            }
        } else {
            $_SESSION['flash_message'] = 'Alasan penolakan tidak boleh kosong!';
            header("Location: http://localhost/sipresma/public/index.php?page=dosen_prestasi_detail&id_prestasi=" . $id_prestasi);
            exit();
        }
    }
}
