<?php

class PrestasiModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function getAllPrestasi()
    {
        $query = "SELECT * FROM data_prestasi";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPrestasiById($id_prestasi)
    {
        // Query untuk mendapatkan data prestasi
        $query = "SELECT 
        dp.id_prestasi, 
        dp.tgl_pengajuan, 
        dp.thn_akademik, 
        dp.jenis_kompetisi, 
        dp.juara, 
        dp.tingkat_kompetisi, 
        dp.judul_kompetisi, 
        dp.tempat_kompetisi, 
        dp.jumlah_pt, 
        dp.jumlah_peserta, 
        dp.status_pengajuan
    FROM 
        data_prestasi dp
    WHERE dp.id_prestasi = :id_prestasi";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_prestasi', $id_prestasi, PDO::PARAM_INT);
        $stmt->execute();

        $prestasi = $stmt->fetch(PDO::FETCH_ASSOC);

        $queryMahasiswa = "SELECT m.nama_mahasiswa
                       FROM mahasiswa m
                       INNER JOIN mahasiswa_prestasi mp ON m.id_mahasiswa = mp.id_mahasiswa
                       WHERE mp.id_prestasi = :id_prestasi";
        $stmtMahasiswa = $this->conn->prepare($queryMahasiswa);
        $stmtMahasiswa->bindParam(':id_prestasi', $id_prestasi, PDO::PARAM_INT);
        $stmtMahasiswa->execute();
        $mahasiswa = $stmtMahasiswa->fetchAll(PDO::FETCH_COLUMN);

        $queryDosen = "SELECT d.nama_dosen
                   FROM dosen d
                   INNER JOIN dosen_prestasi dpd ON d.id_dosen = dpd.id_dosen
                   WHERE dpd.id_prestasi = :id_prestasi";
        $stmtDosen = $this->conn->prepare($queryDosen);
        $stmtDosen->bindParam(':id_prestasi', $id_prestasi, PDO::PARAM_INT);
        $stmtDosen->execute();
        $dosen = $stmtDosen->fetchAll(PDO::FETCH_COLUMN);

        $prestasi['nama_mahasiswa'] = implode('<br>', $mahasiswa);
        $prestasi['nama_dosen'] = implode('<br>', $dosen);

        return $prestasi;
    }
    public function getAllMahasiswa()
    {
        $query = "SELECT id_mahasiswa, nama_mahasiswa FROM mahasiswa";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllDosen()
    {
        $query = "SELECT id_dosen, nama_dosen FROM dosen";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addPrestasi($data_prestasi, $mahasiswa_ids, $dosen_ids)
    {
        try {
            $this->conn->beginTransaction();

            $data_prestasi['tgl_pengajuan'] = date('Y-m-d H:i:s');

            $query = "INSERT INTO [dbo].[data_prestasi]
                    ([tgl_pengajuan], [thn_akademik], [jenis_kompetisi], [juara], 
                        [tingkat_kompetisi], [judul_kompetisi], [tempat_kompetisi], 
                        [jumlah_pt], [jumlah_peserta], [status_pengajuan]) 
                    VALUES 
                    (:tgl_pengajuan, :thn_akademik, :jenis_kompetisi, :juara, 
                        :tingkat_kompetisi, :judul_kompetisi, :tempat_kompetisi, 
                        :jumlah_pt, :jumlah_peserta, 'belum disetujui')";

            $stmt = $this->conn->prepare($query);
            $stmt->execute($data_prestasi);

            $id_prestasi = $this->conn->lastInsertId();

            foreach ($mahasiswa_ids as $id_mahasiswa) {
                $query_mahasiswa = "INSERT INTO mahasiswa_prestasi (id_mahasiswa, id_prestasi) 
                                VALUES (:id_mahasiswa, :id_prestasi)";
                $stmt_mahasiswa = $this->conn->prepare($query_mahasiswa);
                $stmt_mahasiswa->execute(['id_mahasiswa' => $id_mahasiswa, 'id_prestasi' => $id_prestasi]);
            }

            foreach ($dosen_ids as $id_dosen) {
                $query_dosen = "INSERT INTO dosen_prestasi (id_dosen, id_prestasi) 
                            VALUES (:id_dosen, :id_prestasi)";
                $stmt_dosen = $this->conn->prepare($query_dosen);
                $stmt_dosen->execute(['id_dosen' => $id_dosen, 'id_prestasi' => $id_prestasi]);
            }

            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function deletePrestasi($id_prestasi)
    {
        $sql = "DELETE FROM data_prestasi WHERE id_prestasi = :id_prestasi";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_prestasi', $id_prestasi, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function editPrestasi($id_prestasi, $data_prestasi, $mahasiswa_ids, $dosen_ids)
    {
        try {
            $this->conn->beginTransaction();

            // Update data prestasi
            $query_update_prestasi = "UPDATE [dbo].[data_prestasi]
            SET [thn_akademik] = :thn_akademik,
                [jenis_kompetisi] = :jenis_kompetisi,
                [juara] = :juara,
                [tingkat_kompetisi] = :tingkat_kompetisi,
                [judul_kompetisi] = :judul_kompetisi,
                [tempat_kompetisi] = :tempat_kompetisi,
                [jumlah_pt] = :jumlah_pt,
                [jumlah_peserta] = :jumlah_peserta,
                [status_pengajuan] = :status_pengajuan
            WHERE [id_prestasi] = :id_prestasi";

            $stmt = $this->conn->prepare($query_update_prestasi);
            $data_prestasi['id_prestasi'] = $id_prestasi;
            $stmt->execute($data_prestasi);

            // Hapus relasi lama di mahasiswa_prestasi
            $query_delete_mahasiswa = "DELETE FROM mahasiswa_prestasi WHERE id_prestasi = :id_prestasi";
            $stmt_delete_mahasiswa = $this->conn->prepare($query_delete_mahasiswa);
            $stmt_delete_mahasiswa->execute(['id_prestasi' => $id_prestasi]);

            // Masukkan relasi baru di mahasiswa_prestasi
            foreach ($mahasiswa_ids as $id_mahasiswa) {
                $query_insert_mahasiswa = "INSERT INTO mahasiswa_prestasi (id_mahasiswa, id_prestasi) 
                                       VALUES (:id_mahasiswa, :id_prestasi)";
                $stmt_insert_mahasiswa = $this->conn->prepare($query_insert_mahasiswa);
                $stmt_insert_mahasiswa->execute(['id_mahasiswa' => $id_mahasiswa, 'id_prestasi' => $id_prestasi]);
            }

            // Hapus relasi lama di dosen_prestasi
            $query_delete_dosen = "DELETE FROM dosen_prestasi WHERE id_prestasi = :id_prestasi";
            $stmt_delete_dosen = $this->conn->prepare($query_delete_dosen);
            $stmt_delete_dosen->execute(['id_prestasi' => $id_prestasi]);

            // Masukkan relasi baru di dosen_prestasi
            foreach ($dosen_ids as $id_dosen) {
                $query_insert_dosen = "INSERT INTO dosen_prestasi (id_dosen, id_prestasi) 
                                   VALUES (:id_dosen, :id_prestasi)";
                $stmt_insert_dosen = $this->conn->prepare($query_insert_dosen);
                $stmt_insert_dosen->execute(['id_dosen' => $id_dosen, 'id_prestasi' => $id_prestasi]);
            }

            $this->conn->commit();

            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function updateStatusPrestasi($id_prestasi, $status)
    {
        $sql = "UPDATE data_prestasi SET status_pengajuan = :status WHERE id_prestasi = :id_prestasi";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_prestasi', $id_prestasi, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function insertHistoryApproval($id_prestasi, $status, $alasan = null)
    {
        $sql = "INSERT INTO history_approval (id_prestasi, status_approval, alasan) 
                VALUES (:id_prestasi, :status_approval, :alasan)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_prestasi', $id_prestasi);
        $stmt->bindParam(':status_approval', $status);
        $stmt->bindParam(':alasan', $alasan);
        return $stmt->execute();
    }

    public function getApprovalHistory($id_prestasi)
    {
        $sql = "SELECT * FROM history_approval WHERE id_prestasi = :id_prestasi ORDER BY tgl_approval DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_prestasi', $id_prestasi, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
