<?php
require_once "../App/Core/Controller.php";
class lop extends Controller
{
    public function index($limit = 5, $offset = 0, $search = "")
    {
        if (isset($_GET['search'])) {
            $search = trim($_GET['search']);
        }
        if (isset($_GET['limit'])) {
            $limit = (int)$_GET['limit'];
        }

        $lopModel = $this->model('lopModel');
        $result = $lopModel->paging($limit, $offset, $search);
        
        $lops = $result['lops'];
        $totalPages = $result['totalPages'];
        $totalRecords = $result['totalRecords']; // CẬP NHẬT: Lấy tổng số bản ghi
        $currentPage = floor($offset / $limit) + 1;
        
        $this->view("layout/masterlayout", [
            'viewName' => 'lop/index',
            'lops' => $lops,
            'title' => 'Danh sách lớp học',
            'totalPages' => $totalPages,
            'totalRecords' => $totalRecords, // CẬP NHẬT: Chuyển sang View hiển thị
            'limit' => (int)$limit,
            'offset' => (int)$offset,
            'currentPage' => (int)$currentPage,
            'search' => $search
        ]);
    }

    public function create()
    {
        $this->view("layout/masterlayout", ['viewName' => 'lop/create', 'title' => 'Thêm lớp học']);
    }

    public function store()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $malop = trim($_POST['malop']);
            $tenlop = trim($_POST['tenlop']);
            $ghichu = trim($_POST['ghichu']);
            
            $lopModel = $this->model('lopModel');
            if ($lopModel->getLopByMa($malop)) {
                echo "Mã lớp học này đã tồn tại trong hệ thống!";
                exit();
            }

            $result = $lopModel->create($malop, $tenlop, $ghichu);
            if ($result) {
                header("Location: /lop/index");
                exit();
            } else {
                echo "Thêm lớp học thất bại";
                exit();
            }
        }
    }

    public function edit($malop)
    {
        $lopModel = $this->model('lopModel');
        $lop = $lopModel->getLopByMa(urldecode($malop));
        if ($lop) {
            $this->view("layout/masterlayout", ['viewName' => 'lop/edit', 'lop' => $lop, 'title' => 'Sửa lớp học']);
        } else {
            echo "Không tìm thấy lớp học";
            exit();
        }
    }

    public function update($malop)
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenlop = trim($_POST['tenlop']);
            $ghichu = trim($_POST['ghichu']);
            
            $lopModel = $this->model('lopModel');
            $result = $lopModel->update(urldecode($malop), $tenlop, $ghichu);
            if ($result) {
                header("Location: /lop/index");
                exit();
            } else {
                echo "Cập nhật lớp học thất bại";
                exit();
            }
        }
    }

    public function delete($malop)
    {
        $lopModel = $this->model('lopModel');
        $result = $lopModel->delete(urldecode($malop));
        if ($result) {
            header("Location: /lop/index");
            exit();
        } else {
            echo "Xóa lớp học thất bại";
            exit();
        }
    }
}