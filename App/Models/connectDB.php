<?php
class connectDB {
    public static function connectDB() {
        $server = "localhost";
        $user = "root";
        $password = "";
        $db = "68pm3";

        $conn = new mysqli($server, $user, $password, $db);

        mysqli_set_charset($conn, 'UTF8');
        
        if($conn->connect_error){
            die("Lỗi kết nối: " .$conn->connect_error);
        }

        return $conn;
    }

}
?>