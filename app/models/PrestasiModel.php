<?php
class PrestasiModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getPrestasiByMahasiswa($id_mahasiswa)
    {
        $query = "SELECT * FROM data_prestasi WHERE id_mahasiswa = ?";

        // Menyiapkan parameter untuk query SQL Server
        $params = array($id_mahasiswa);

        // Eksekusi query menggunakan sqlsrv_query
        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        // Ambil data sebagai array
        $prestasiList = [];
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $prestasiList[] = $row;
        }

        return $prestasiList;  // Kembalikan data prestasi
    }

    public function getAllPrestasi()
    {
        $query = "SELECT * FROM data_prestasi";

        try {
            $stmt = $this->conn->query($query);
            $prestasiList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $prestasiList;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function getPrestasiById($id_prestasi)
    {
        $sql = "SELECT p.*, 
               STUFF((SELECT ', ' + m.nama_mahasiswa
                      FROM mahasiswa m
                      JOIN mahasiswa_prestasi mp ON m.id_mahasiswa = mp.id_mahasiswa
                      WHERE mp.id_prestasi = p.id_prestasi
                      ORDER BY m.nama_mahasiswa
                      FOR XML PATH('')), 1, 2, '') AS nama_mahasiswa, 
               STUFF((SELECT ', ' + d.nama_dosen
                      FROM dosen d
                      JOIN dosen_prestasi dp ON d.id_dosen = dp.id_dosen
                      WHERE dp.id_prestasi = p.id_prestasi
                      ORDER BY d.nama_dosen
                      FOR XML PATH('')), 1, 2, '') AS nama_dosen
        FROM data_prestasi p
        WHERE p.id_prestasi = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_prestasi]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Mengambil hasil query sebagai array asosiasi
    }

    public function updateStatusPrestasi($id_prestasi, $status)
    {
        $sql = "UPDATE data_prestasi SET status_pengajuan = :status WHERE id_prestasi = :id_prestasi";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_prestasi', $id_prestasi);
        return $stmt->execute();
    }

    public function tolakPrestasi($id_prestasi, $alasan)
    {
        $sql = "INSERT INTO alasan_penolakan (id_prestasi, alasan) VALUES (:id_prestasi, :alasan)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_prestasi', $id_prestasi);
        $stmt->bindParam(':alasan', $alasan);
        $stmt->execute();

        $sql2 = "UPDATE data_prestasi SET status_pengajuan = 'ditolak' WHERE id_prestasi = :id_prestasi";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->bindParam(':id_prestasi', $id_prestasi);
        return $stmt2->execute();
    }

    public function getAlasanPenolakan($id_prestasi)
    {
        $sql = "SELECT alasan, tgl_penolakan FROM alasan_penolakan WHERE id_prestasi = :id_prestasi ORDER BY tgl_penolakan DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_prestasi', $id_prestasi);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
