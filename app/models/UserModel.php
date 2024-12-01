<?php

class UserModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function validateLogin($username, $password)
    {
        $sqlMahasiswa = "SELECT id_mahasiswa, NIM, nama_mahasiswa FROM mahasiswa WHERE NIM = ? AND password_mahasiswa = ?";
        $stmt = $this->conn->prepare($sqlMahasiswa);
        $stmt->execute([$username, $password]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $result['role'] = 'mahasiswa';
            return $result;
        }

        $sqlDosen = "SELECT id_dosen, NIDN, role_dosen, nama_dosen FROM dosen WHERE NIDN = ? AND password_dosen = ?";
        $stmt = $this->conn->prepare($sqlDosen);
        $stmt->execute([$username, $password]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        }

        return false;
    }
}
