<?php
$pageSize = isset($limit) ? $limit : 5;

if (!isset($offset)) {
    $requestUri = $_SERVER['REQUEST_URI'];
    $uriParts = explode('/', trim($requestUri, '/'));
    $offset = 0;
    
    if (count($uriParts) >= 4 && is_numeric($uriParts[3])) {
        $offset = (int)$uriParts[3];
    }
}

if (!isset($currentPage)) {
    $currentPage = floor($offset / $pageSize) + 1;
}
?>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        width: 100%;
        max-width: 1000px;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin: 0 auto;
    }

    h1 {
        font-size: 28px;
        color: #2c3e50;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 10px;
    }

    h1::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 4px;
        background-color: #3498db;
        border-radius: 2px;
    }

    .btn {
        padding: 8px 14px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        display: inline-block;
        transition: all 0.2s ease;
    }
    .btn-success {
        background-color: #2ecc71;
        color: white;
    }
    .btn-success:hover {
        background-color: #27ae60;
    }
    .btn-primary {
        background-color: #3498db;
        color: white;
        margin-right: 5px;
    }
    .btn-primary:hover {
        background-color: #2980b9;
    }
    .btn-danger {
        background-color: #e74c3c;
        color: white;
    }
    .btn-danger:hover {
        background-color: #c0392b;
    }

    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 16px;
        text-align: left;
    }

    th {
        background-color: #2c3e50;
        color: #ffffff;
        padding: 14px 16px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 14px;
    }

    th:first-child { border-top-left-radius: 8px; }
    th:last-child { border-top-right-radius: 8px; }

    td {
        padding: 14px 16px;
        border-bottom: 1px solid #e0e0e0;
        color: #555;
    }

    tr:nth-child(even) { background-color: #f8f9fa; }
    tr:hover { background-color: #f1f7fc; transition: background-color 0.2s ease; }

    td:first-child, th:first-child {
        text-align: center;
        width: 80px;
    }

    .no-data {
        text-align: center;
        padding: 30px;
        color: #999;
        font-style: italic;
    }

    /* Phân trang */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
        gap: 5px;
    }

    .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 8px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-outline-primary {
        color: #3498db;
        background-color: transparent;
        border: 1px solid #3498db;
    }

    .btn-outline-primary:hover {
        background-color: #3498db;
        color: white;
    }

    .pagination .active {
        background-color: #2ecc71;
        color: white;
        border: 1px solid #2ecc71;
        pointer-events: none;
    }

    .page-ellipsis {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        color: #7f8c8d;
    }

    .page-link.disabled {
        color: #bdc3c7;
        border: 1px solid #d2d7d9;   
        background-color: #f8f9fa;   
        pointer-events: none;         
    }
</style>

<div class="container">
    <h1>Danh sách sinh viên</h1>

    <div style="margin-bottom: 15px;">
        <a href="/sinhvien/create" class="btn btn-success">+ Thêm sinh viên mới</a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>MSSV</th>
                    <th>Họ và Tên</th>
                    <th>Giới Tính</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sinhviens)): ?>
                    <?php foreach ($sinhviens as $index => $sinhvien): ?>
                        <tr>
                            <td><?php echo $offset + $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($sinhvien['mssv']); ?></td>
                            <td><strong><?php echo htmlspecialchars($sinhvien['hoten']); ?></strong></td>
                            <td><?php echo (isset($sinhvien['gioitinh']) && $sinhvien['gioitinh'] == 1) ? 'Nữ' : 'Nam'; ?></td>
                            <td>
                                <a href="/sinhvien/edit/<?php echo $sinhvien['id']; ?>" class="btn btn-primary">Sửa</a>
                                <a href="/sinhvien/delete/<?php echo $sinhvien['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="no-data">Hiện tại chưa có sinh viên nào trong danh sách.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <div class="pagination">
            <?php
                if (!isset($totalPages)) {
                    $totalItems = isset($totalRecords) ? (int)$totalRecords : (isset($sinhviens) ? count($sinhviens) : 0);
                    $totalPages = max(1, (int)ceil($totalItems / $pageSize));
                }

                if ($currentPage > 1) {
                    $prevOffset = ($currentPage - 2) * $pageSize;
                    echo "<a href='/sinhvien/index/$pageSize/$prevOffset' class='btn btn-outline-primary page-link'>&lt;</a>";
                } else {
                    echo "<span class='page-link disabled'>&lt;</span>";
                }

                $maxVisiblePages = 3;
                $startPage = max(1, $currentPage - floor($maxVisiblePages / 2));
                $endPage = min($totalPages, $startPage + $maxVisiblePages - 1);

                if ($endPage - $startPage + 1 < $maxVisiblePages) {
                    $startPage = max(1, $endPage - $maxVisiblePages + 1);
                }

                if ($startPage > 1) {
                    echo "<a href='/sinhvien/index/$pageSize/0' class='btn btn-outline-primary page-link'>1</a>";
                    if ($startPage > 2) {
                        echo "<span class='page-ellipsis'>...</span>";
                    }
                }

                for ($i = $startPage; $i <= $endPage; $i++) {
                    $offsetPage = ($i - 1) * $pageSize;
                    $activeClass = ($i == $currentPage) ? "active" : "btn-outline-primary";
                    echo "<a href='/sinhvien/index/$pageSize/$offsetPage' class='btn $activeClass page-link'>$i</a>";
                }

                if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) {
                        echo "<span class='page-ellipsis'>...</span>";
                    }
                    $lastOffset = ($totalPages - 1) * $pageSize;
                    echo "<a href='/sinhvien/index/$pageSize/$lastOffset' class='btn btn-outline-primary page-link'>$totalPages</a>";
                }

                if ($currentPage < $totalPages) {
                    $nextOffset = $currentPage * $pageSize;
                    echo "<a href='/sinhvien/index/$pageSize/$nextOffset' class='btn btn-outline-primary page-link'>&gt;</a>";
                } else {
                    echo "<span class='page-link disabled'>&gt;</span>";
                }
            ?>
        </div>
    </div>
</div>