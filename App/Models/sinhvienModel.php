<?php
require_once '../App/Core/connectDB.php';
class sinhvienModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = ConnectDB::Connect();
    }

    public function getAllSinhVien()
    {
        $query = "SELECT * FROM sinhvien";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($hoten, $gioitinh, $mssv, $malop = null)
    {
        $query = "INSERT INTO sinhvien (hoten, gioitinh, mssv, malop) VALUES (:hoten, :gioitinh, :mssv, :malop)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':malop', $malop);
        return $stmt->execute();
    }

    public function paging($limit = 5, $offset = 0, $search = "", $malop = "")
    {
        $conditions = [];
        $params = [];

        if (!empty($search)) {
            $conditions[] = "(sinhvien.hoten LIKE :search OR sinhvien.mssv LIKE :search)";
            $params[':search'] = "%" . $search . "%";
        }

        if (!empty($malop)) {
            $conditions[] = "sinhvien.malop = :malop";
            $params[':malop'] = $malop;
        }

        $whereClause = !empty($conditions) ? " WHERE " . implode(" AND ", $conditions) : "";

        $query = "SELECT sinhvien.*, lop.tenlop FROM sinhvien 
                  LEFT JOIN lop ON sinhvien.malop = lop.malop" 
                  . $whereClause . 
                  " LIMIT :limit OFFSET :offset";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $countQuery = "SELECT COUNT(*) FROM sinhvien" . $whereClause;
        $countStmt = $this->conn->prepare($countQuery);
        foreach ($params as $key => $val) {
            $countStmt->bindValue($key, $val);
        }
        $countStmt->execute();
        $totalRecords = $countStmt->fetchColumn();

        $totalPages = max(1, ceil($totalRecords / $limit));

        return [
            'sinhviens' => $result, 
            'totalPages' => $totalPages, 
            'totalRecords' => $totalRecords
        ];
    }

    public function getSinhVienById($id)
    {
        $query = "SELECT * FROM sinhvien WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $hoten, $gioitinh, $mssv, $malop = null)
    {
        $query = "UPDATE sinhvien SET hoten = :hoten, gioitinh = :gioitinh, mssv = :mssv, malop = :malop WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hoten', $hoten);
        $stmt->bindParam(':gioitinh', $gioitinh);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->bindParam(':malop', $malop);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM sinhvien WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}