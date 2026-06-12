<?php
require_once "../App/Core/Controller.php";
class sinhvien extends Controller
{
    public function index($limit = 5, $offset = 0, $search = "")
    {
        // $sinhvienModel = $this->model('sinhvienModel');
        // $data = $sinhvienModel->paging($limit, $offset, $search);
        // $sinhviens = $data['sinhviens'];
        // $totalPages = $data['totalPages'];
        // $currentPage = floor($offset / $limit) + 1;
        // $this->view("layout/masterlayout", ['viewName' => 'sinhvien/index', 'sinhviens' => $sinhviens, 'totalPages' => $totalPages, 'currentPage' => $currentPage, 'pageSize' => $limit, 'title' => 'Danh sách sinh viên']);
    
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging($limit, $offset, $search);
        $sinhviens = $result['sinhviens'];
        $totalPages = $result['totalPages'];
        $currentPage = floor($offset / $limit) + 1;
        $this->view("layout/masterlayout", [
            'viewName' => 'sinhvien/index',
            'sinhviens' => $sinhviens,
            'title' => 'Danh sách sinh viên',
            'totalPages' => $totalPages,
            'limit' => (int)$limit,
            'offset' => (int)$offset,
            'currentPage' => (int)$currentPage
        ]);
    }

    public function create()
    {
        $this->view("layout/masterlayout", ['viewName' => 'sinhvien/create', 'title' => 'Thêm sinh viên']);
    }

    public function store()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = $_POST['hoten'];
            $gioitinh = $_POST['gioitinh'];
            $mssv = $_POST['mssv'];
            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->create($hoten, $gioitinh, $mssv);
            if ($result) {
                header("Location: /sinhvien/index");
                exit();
            } else {
                echo "Thêm sinh viên thất bại";
                exit();
            }
        }
    }

    public function edit($id)
    {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getSinhVienById($id);
        if ($sinhvien) {
            $this->view("layout/masterlayout", ['viewName' => 'sinhvien/edit', 'sinhvien' => $sinhvien, 'title' => 'Sửa sinh viên']);
        } else {
            echo "Không tìm thấy sinh viên";
            exit();
        }
        $this->view("layout/masterlayout", ['viewName' => 'sinhvien/edit', 'sinhvien' => $sinhvien, 'title' => 'Sửa sinh viên']);
    }

    public function update($id)
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = $_POST['hoten'];
            $gioitinh = $_POST['gioitinh'];
            $mssv = $_POST['mssv'];
            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->update($id, $hoten, $gioitinh, $mssv);
            if ($result) {
                header("Location: /sinhvien/index");
                exit();
            } else {
                echo "Cập nhật sinh viên thất bại";
                exit();
            }
        }
    }

    public function delete($id)
    {
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->delete($id);
        if ($result) {
            header("Location: /sinhvien/index");
            exit();
        } else {
            echo "Xóa sinh viên thất bại";
            exit();
        }
    }
}
