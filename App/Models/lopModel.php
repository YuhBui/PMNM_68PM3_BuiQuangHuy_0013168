<?php
require_once '../App/Core/connectDB.php';
class lopModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = ConnectDB::Connect();
    }

    public function getAllLop()
    {
        $query = "SELECT * FROM lop ORDER BY malop ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($malop, $tenlop, $ghichu)
    {
        $query = "INSERT INTO lop (malop, tenlop, ghichu) VALUES (:malop, :tenlop, :ghichu)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':malop', $malop);
        $stmt->bindParam(':tenlop', $tenlop);
        $stmt->bindParam(':ghichu', $ghichu);
        return $stmt->execute();
    }

    public function paging($limit = 5, $offset = 0, $search = "")
    {
        $whereClause = "";
        if (!empty($search)) {
            $whereClause = " WHERE malop LIKE :search OR tenlop LIKE :search";
        }

        $query = "SELECT * FROM lop" . $whereClause . " LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        if (!empty($search)) {
            $searchParam = "%" . $search . "%";
            $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($search)) {
            $countQuery = "SELECT COUNT(*) FROM lop WHERE malop LIKE :search OR tenlop LIKE :search";
            $countStmt = $this->conn->prepare($countQuery);
            $countStmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
            $countStmt->execute();
            $totalRecords = $countStmt->fetchColumn();
        } else {
            $selectAllQuery = $this->conn->query("SELECT COUNT(*) FROM lop");
            $totalRecords = $selectAllQuery->fetchColumn();
        }

        $totalPages = max(1, ceil($totalRecords / $limit));

            return [
                'lops' => $result, 
                'totalPages' => $totalPages, 
                'totalRecords' => $totalRecords
            ];
    }

    public function getLopByMa($malop)
    {
        $query = "SELECT * FROM lop WHERE malop = :malop";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':malop', $malop);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($malop, $tenlop, $ghichu)
    {
        $query = "UPDATE lop SET tenlop = :tenlop, ghichu = :ghichu WHERE malop = :malop";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tenlop', $tenlop);
        $stmt->bindParam(':ghichu', $ghichu);
        $stmt->bindParam(':malop', $malop);
        return $stmt->execute();
    }

    public function delete($malop)
    {
        $query = "DELETE FROM lop WHERE malop = :malop";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':malop', $malop);
        return $stmt->execute();
    }
}