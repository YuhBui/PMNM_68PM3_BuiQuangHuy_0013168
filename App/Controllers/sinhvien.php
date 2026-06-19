<?php
require_once "../App/Core/Controller.php";
class sinhvien extends Controller
{
    public function index($limit = 10, $offset = 0, $search = "")
    {
        $search = isset($_GET['search']) ? trim($_GET['search']) : "";
        $malop = isset($_GET['malop']) ? trim($_GET['malop']) : "";
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10; // Mặc định hiển thị 10 dòng theo ảnh mẫu

        $lopModel = $this->model('lopModel');
        $lops = $lopModel->getAllLop();

        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging($limit, $offset, $search, $malop);

        $sinhviens = $result['sinhviens'];
        $totalPages = $result['totalPages'];
        $totalRecords = $result['totalRecords'];
        $currentPage = floor($offset / $limit) + 1;

        $this->view("layout/masterlayout", [
            'viewName' => 'sinhvien/index',
            'sinhviens' => $sinhviens,
            'lops' => $lops,
            'title' => 'Danh sách sinh viên',
            'totalPages' => $totalPages,
            'totalRecords' => $totalRecords,
            'limit' => (int)$limit,
            'offset' => (int)$offset,
            'currentPage' => (int)$currentPage,
            'search' => $search,
            'selectedMalop' => $malop
        ]);
    }

    public function create()
    {
        $lopModel = $this->model('lopModel');
        $lops = $lopModel->getAllLop();

        $this->view("layout/masterlayout", [
            'viewName' => 'sinhvien/create',
            'title' => 'Thêm sinh viên',
            'lops' => $lops
        ]);
    }

    public function store()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = $_POST['hoten'];
            $gioitinh = $_POST['gioitinh'];
            $mssv = $_POST['mssv'];
            $malop = isset($_POST['malop']) ? trim($_POST['malop']) : ""; // Nhận mã lớp

            if (empty($malop)) {
                echo "Vui lòng chọn lớp học cho sinh viên!";
                exit();
            }

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->create($hoten, $gioitinh, $mssv, $malop);
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

        $lopModel = $this->model('lopModel');
        $lops = $lopModel->getAllLop();
        
        if ($sinhvien) {
            $this->view("layout/masterlayout", [
                'viewName' => 'sinhvien/edit',
                'sinhvien' => $sinhvien,
                'title' => 'Sửa sinh viên',
                'lops' => $lops
            ]);
        } else {
            echo "Không tìm thấy sinh viên";
            exit();
        }
    }

    public function update($id)
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = $_POST['hoten'];
            $gioitinh = $_POST['gioitinh'];
            $mssv = $_POST['mssv'];
            $malop = isset($_POST['malop']) ? trim($_POST['malop']) : "";

            if (empty($malop)) {
                echo "Vui lòng chọn lớp học cho sinh viên!";
                exit();
            }

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->update($id, $hoten, $gioitinh, $mssv, $malop);
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
