<?php
require_once "../App/Models/connectDB.php";
require_once "../App/Models/sinhvien_ett.php";

class Sinhvien_ctrl 
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB::connectDB();
    }

    public function getAll()
    {
        $sql = "SELECT hoten, mssv, gioitinh FROM sinhvien";
        $result = $this->conn->query($sql);
        $dsSinhvien = array();
    
        if($result === false) {
            return $dsSinhvien;
        }
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dsSinhvien[] = new sinhvien_ett(
                    $row["hoten"],
                    $row["mssv"],
                    $row["gioitinh"]
                );
            }
        }
        
        return $dsSinhvien;
    }
}
?>