<?php
require_once "../App/Core/Controller.php";
class sinhvien extends Controller {
    public function index($limit = 5, $offset = 0, $search = "") {
    $sinhvienModel = $this->model('sinhvienModel');
    $result = $sinhvienModel->paging($limit, $offset, $search);
    $sinhviens = $result['sinhviens'];
    $totalPages = $result['totalPages'];
    $this->view("layout/masterlayout", ['viewName' => 'sinhvien/index', 'sinhviens' => $sinhviens, 'title' => 'Danh sách sinh viên', 'totalPages' => $totalPages]);
    }
    public function create() {
        require_once "../App/Views/sinhvien/create.php";
    }
    public function store() {   
        if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = $_POST['hoten'];
            $gioitinh = $_POST['gioitinh'];
            $mssv = $_POST['mssv'];
            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel ->create($hoten, $gioitinh, $mssv);
            if($result) {
                echo "Thêm sinh viên thành công";
                exit();
            } else {
                echo "Thêm sinh viên thất bại";
                exit();
            }
        }   
    }
}
?>