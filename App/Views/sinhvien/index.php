<style>
    /* Reset và cấu hình font chữ chung */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Container bọc toàn bộ nội dung */
    .container {
        width: 100%;
        max-width: 1000px;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin: 0 auto; /* Căn giữa */
    }

    /* Tiêu đề trang */
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

    /* Khung bọc bảng để hỗ trợ responsive khi xem trên điện thoại */
    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    /* Thiết kế bảng hiện đại */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 16px;
        text-align: left;
    }

    /* Đầu bảng (Header) */
    th {
        background-color: #2c3e50;
        color: #ffffff;
        padding: 14px 16px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 14px;
    }

    th:first-child {
        border-top-left-radius: 8px;
    }

    th:last-child {
        border-top-right-radius: 8px;
    }

    /* Thân bảng (Body) */
    td {
        padding: 14px 16px;
        border-bottom: 1px solid #e0e0e0;
        color: #555;
    }

    /* Hiệu ứng dòng xen kẽ (Zebra striping) */
    tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    /* Hiệu ứng khi di chuột qua các dòng (Hover effect) */
    tr:hover {
        background-color: #f1f7fc;
        transition: background-color 0.2s ease;
    }

    /* Định dạng cột ID/STT nhỏ gọn lại */
    td:first-child, th:first-child {
        text-align: center;
        width: 80px;
    }

    /* Thẻ hiển thị khi không có dữ liệu */
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

    .btn-success.active {
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
</style>

<div class="container">
    <h1>Danh sách sinh viên</h1>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ và Tên</th>
                    <th>MSSV</th>
                    <th>Giới Tính</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sinhviens)): ?>
                    <?php foreach ($sinhviens as $index => $sinhvien): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><strong><?php echo htmlspecialchars($sinhvien['hoten']); ?></strong></td>
                            <td><?php echo htmlspecialchars($sinhvien['mssv']); ?></td>
                            <td><?php echo htmlspecialchars($sinhvien['gioitinh']); ?></td>
                            <td>
                                <a href="/sinhvien/edit/<?php echo $sinhvien['id']; ?>" class="btn btn-primary">Sửa</a>
                                <a href="/sinhvien/delete/<?php echo $sinhvien['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="no-data">Hiện tại chưa có sinh viên nào trong danh sách.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
                // Pagination logic
                $pageSize = isset($limit) ? $limit : 5;
                if (!isset($totalPages)) {
                    $totalItems = isset($totalRecords) ? (int)$totalRecords : (isset($sinhviens) ? count($sinhviens) : 0);
                    $totalPages = max(1, (int)ceil($totalItems / $pageSize));
                }

                // Attempt to determine the current page from the URI if not provided
                if (!isset($currentPage)) {
                    $requestUri = $_SERVER['REQUEST_URI'];
                    $uriParts = explode('/', trim($requestUri, '/'));
                    $offset = 0;
                    
                    // URI pattern: /sinhvien/index/limit/offset
                    if (count($uriParts) >= 4 && is_numeric($uriParts[3])) {
                        $offset = (int)$uriParts[3];
                    }
                    $currentPage = floor($offset / $pageSize) + 1;
                }

                // Previous Button
                if ($currentPage > 1) {
                    $prevOffset = ($currentPage - 2) * $pageSize;
                    echo "<a href='/sinhvien/index/$pageSize/$prevOffset' class='btn btn-outline-primary page-link'>&lt;</a>";
                }

                // Render page numbers with '...' logic
                $maxVisiblePages = 3;
                $startPage = max(1, $currentPage - floor($maxVisiblePages / 2));
                $endPage = min($totalPages, $startPage + $maxVisiblePages - 1);

                // Adjust startPage if we are near the end
                if ($endPage - $startPage + 1 < $maxVisiblePages) {
                    $startPage = max(1, $endPage - $maxVisiblePages + 1);
                }

                // Always show first page and ellipsis if needed
                if ($startPage > 1) {
                    echo "<a href='/sinhvien/index/$pageSize/0' class='btn btn-outline-primary page-link'>1</a>";
                    if ($startPage > 2) {
                        echo "<span class='page-ellipsis'>...</span>";
                    }
                }

                // Page numbers
                for ($i = $startPage; $i <= $endPage; $i++) {
                    $offset = ($i - 1) * $pageSize;
                    $activeClass = ($i == $currentPage) ? "btn-success active" : "btn-outline-primary";
                    echo "<a href='/sinhvien/index/$pageSize/$offset' class='btn $activeClass page-link'>$i</a>";
                }

                // Always show last page and ellipsis if needed
                if ($endPage < $totalPages) {
                    if ($endPage < $totalPages - 1) {
                        echo "<span class='page-ellipsis'>...</span>";
                    }
                    $lastOffset = ($totalPages - 1) * $pageSize;
                    echo "<a href='/sinhvien/index/$pageSize/$lastOffset' class='btn btn-outline-primary page-link'>$totalPages</a>";
                }

                // Next Button
                if ($currentPage < $totalPages) {
                    $nextOffset = $currentPage * $pageSize;
                    echo "<a href='/sinhvien/index/$pageSize/$nextOffset' class='btn btn-outline-primary page-link'>&gt;</a>";
                }
            ?>
        </div>
    </div>
</div>