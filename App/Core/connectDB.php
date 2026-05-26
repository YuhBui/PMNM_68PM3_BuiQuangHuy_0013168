<?php
class connectDB {
    private $host = "localhost";
    private $dbname = "68pm3";
    private $username = "root";
    private $password = "";
    public $conn;
    
    public static function Connect() {
        $self = new self();
        $self->conn = null;
        try {
            $self->conn = new PDO("mysql:host=" . $self->host . ";dbname=" . $self->dbname, $self->username, $self->password);
            $self->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }
        return $self->conn;
    }
}
?>