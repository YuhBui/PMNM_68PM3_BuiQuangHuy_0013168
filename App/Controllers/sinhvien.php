<?php
require_once "../App/Core/Controller.php";
class sinhvien extends Controller {
    public function index() {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhviens = $sinhvienModel->getAllSinhVien();
        $this->view("layout/masterlayout", ['viewName' => 'sinhvien/index', 'sinhviens' => $sinhviens]);
    }
    public function create() {
        require_once "../App/Views/sinhvien/create.php";
    }
    public function store() {   
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = $_POST['hoten'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? '';
            $mssv = $_POST['mssv'] ?? '';
            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel ->create($hoten, $gioitinh, $mssv);
            if($result) {
                echo "Thêm sinh viên thành công";
            } else {
                echo "Thêm sinh viên thất bại";
            }
        }   
    }
}
?>