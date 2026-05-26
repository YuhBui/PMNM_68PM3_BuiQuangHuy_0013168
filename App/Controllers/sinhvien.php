<?php
class sinhvien extends Controller {
    public function index() {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhviens = $sinhvienModel->getAllSinhVien();
        $this->view("sinhvien/index", ['sinhviens' => $sinhviens]);
    }

    public function create()
    {
        require_once "../App/Views/sinhvien/create.php";
    }
}
?>