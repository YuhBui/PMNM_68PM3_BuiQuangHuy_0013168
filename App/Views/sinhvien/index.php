<?php
$pageSize = isset($limit) ? $limit : 10;
$search = isset($search) ? $search : "";
$selectedMalop = isset($selectedMalop) ? $selectedMalop : "";

$totalItems = isset($totalRecords) ? (int)$totalRecords : (isset($sinhviens) ? count($sinhviens) : 0);

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

if (!isset($totalPages) || $totalPages <= 0) {
    $totalPages = max(1, (int)ceil($totalItems / $pageSize));
}

$startRecord = $totalItems > 0 ? $offset + 1 : 0;
$endRecord = min($offset + $pageSize, $totalItems);
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
        max-width: 1100px;
        background: #ffffff;
        padding: 25px;
        border-radius: 8px;
        margin: 0 auto;
    }

    /* Khung chứa Tiêu đề và nút Thêm sinh viên cùng hàng */
    .page-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    h1 {
        font-size: 24px;
        color: #2c3e50;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
    }

    /* Huy hiệu đếm tổng số sinh viên nằm cạnh tiêu đề */
    .count-badge {
        background-color: #95a5a6;
        color: white;
        font-size: 14px;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: bold;
    }

    /* Thanh tìm kiếm và bộ lọc dữ liệu */
    .filter-bar {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 15px;
        width: 100%;
    }

    .filter-input {
        flex: 1;
        min-width: 220px;
        padding: 7px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        font-size: 14px;
        color: #333;
    }

    .filter-select {
        width: 200px;
        padding: 7px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        font-size: 14px;
        background-color: white;
        color: #555;
    }

    /* Thiết kế nút bấm chuẩn hệ thống */
    .btn {
        padding: 7px 14px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
        transition: background 0.2s;
    }

    .btn-success {
        background-color: #2ecc71;
        color: white;
    }

    .btn-success:hover {
        background-color: #27ae60;
    }

    .btn-primary {
        background-color: #4a90e2;
        color: white;
    }

    .btn-primary:hover {
        background-color: #357abd;
    }

    .btn-reset {
        background-color: #ffffff;
        color: #7f8c8d;
        border: 1px solid #cbd5e1;
    }

    .btn-reset:hover {
        background-color: #f8f9fa;
    }

    .limit-wrapper {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: #555;
    }

    .select-limit {
        padding: 5px 8px;
        border: 1px solid #cbd5e1;
        border-radius: 4px;
        background: #fff;
        font-size: 13px;
    }

    /* Thiết kế bảng hiển thị chuẩn */
    .table-responsive {
        overflow-x: auto;
        width: 100%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
        font-size: 14px;
    }

    th {
        background-color: #051525;
        /* YÊU CẦU 1: Đổi thành màu trùng với nền Header */
        color: #ffffff;
        padding: 12px 14px;
        font-weight: 600;
        text-align: left;
    }

    th.center,
    td.center {
        text-align: center;
    }

    td {
        padding: 12px 14px;
        border-bottom: 1px solid #eef2f5;
        color: #444;
        vertical-align: middle;
    }

    tr:nth-child(even) {
        background-color: #fcfdfe;
    }

    tr:hover {
        background-color: #f5f8fa;
    }

    /* Định dạng nhãn tên lớp màu xanh Cyan */
    .class-tag {
        background-color: #d9edf7;
        color: #31708f;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        display: inline-block;
    }

    .no-class {
        color: #bbb;
        font-style: italic;
    }

    /* Các nút Sửa/Xóa nhỏ nằm cạnh nhau */
    .btn-action {
        padding: 4px 8px;
        font-size: 12px;
        border-radius: 3px;
        color: white;
        text-decoration: none;
        margin-right: 3px;
        display: inline-block;
    }

    .btn-edit {
        background-color: #ffb822;
    }

    .btn-edit:hover {
        background-color: #e2a01b;
    }

    .btn-delete {
        background-color: #fd397a;
    }

    .btn-delete:hover {
        background-color: #e02663;
    }

    /* Footer chứa phân trang & thông tin dòng */
    .table-footer-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        font-size: 13px;
        color: #7f8c8d;
    }

    .pagination {
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .page-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 13px;
        color: #555;
        border: 1px solid #cbd5e1;
        background: #fff;
    }

    .page-link:hover {
        background-color: #f1f5f9;
    }

    .pagination .active {
        background-color: #4a90e2;
        color: white;
        border-color: #4a90e2;
        pointer-events: none;
    }

    .page-link.disabled {
        color: #cbd5e1;
        border-color: #e2e8f0;
        background-color: #f8f9fa;
        pointer-events: none;
    }

    /* Định dạng cho ký hiệu ba chấm (...) */
    .page-ellipsis {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        color: #7f8c8d;
        font-size: 13px;
    }
</style>

<div class="container">

    <div class="page-header-row">
        <h1>Danh sách sinh viên <span class="count-badge"><?php echo $totalItems; ?></span></h1>
        <a href="/sinhvien/create" class="btn btn-success">+ Thêm sinh viên</a>
    </div>

    <form method="GET" action="/sinhvien/index" class="filter-bar">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" class="filter-input" placeholder="Tìm theo tên hoặc MSSV...">

        <select name="malop" class="filter-select" onchange="this.form.submit()">
            <option value="">Tất cả lớp</option>
            <?php if (!empty($lops)): ?>
                <?php foreach ($lops as $lop): ?>
                    <option value="<?php echo htmlspecialchars($lop['malop']); ?>" <?php echo ($selectedMalop === $lop['malop']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($lop['tenlop']); ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>

        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        <a href="/sinhvien/index" class="btn btn-reset">Đặt lại</a>

        <div class="limit-wrapper">
            <label for="limit">Hiển thị:</label>
            <select name="limit" id="limit" onchange="this.form.submit()" class="select-limit">
                <option value="5" <?php echo ($pageSize == 5) ? 'selected' : ''; ?>>5 / trang</option>
                <option value="10" <?php echo ($pageSize == 10) ? 'selected' : ''; ?>>10 / trang</option>
                <option value="20" <?php echo ($pageSize == 20) ? 'selected' : ''; ?>>20 / trang</option>
                <option value="50" <?php echo ($pageSize == 50) ? 'selected' : ''; ?>>50 / trang</option>
            </select>
        </div>
    </form>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th class="center" style="width: 60px;">STT</th>
                    <th style="width: 140px;">MSSV</th>
                    <th>Họ tên</th>
                    <th style="width: 120px;">Giới tính</th>
                    <th>Lớp học</th>
                    <th class="center" style="width: 120px;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sinhviens)): ?>
                    <?php foreach ($sinhviens as $index => $sinhvien): ?>
                        <tr>
                            <td class="center"><?php echo $offset + $index + 1; ?></td>
                            <td style="color: #555; font-weight: 500;"><?php echo htmlspecialchars($sinhvien['mssv']); ?></td>
                            <td><strong><?php echo htmlspecialchars($sinhvien['hoten']); ?></strong></td>
                            <td><?php echo (isset($sinhvien['gioitinh']) && $sinhvien['gioitinh'] == 1) ? 'Nữ' : 'Nam'; ?></td>
                            <td>
                                <?php if (!empty($sinhvien['tenlop'])): ?>
                                    <span class="class-tag"><?php echo htmlspecialchars($sinhvien['tenlop']); ?></span>
                                <?php else: ?>
                                    <span class="no-class">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="center">
                                <a href="/sinhvien/edit/<?php echo $sinhvien['id']; ?>" class="btn-action btn-edit">Sửa</a>
                                <a href="/sinhvien/delete/<?php echo $sinhvien['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="no-data">Không tìm thấy dữ liệu sinh viên phù hợp.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="table-footer-row">
            <div>
                Hiển thị <?php echo $startRecord; ?>-<?php echo $endRecord; ?> trong <?php echo $totalItems; ?> bản ghi
            </div>

            <div class="pagination">
                <?php
                $searchQuery = !empty($search) ? "&search=" . urlencode($search) : "";
                $classQuery = !empty($selectedMalop) ? "&malop=" . urlencode($selectedMalop) : "";
                $filterParams = "?limit=$pageSize" . $searchQuery . $classQuery;

                if ($currentPage > 1) {
                    $prevOffset = ($currentPage - 2) * $pageSize;
                    echo "<a href='/sinhvien/index/$pageSize/$prevOffset$filterParams' class='page-link'>&lt;</a>";
                } else {
                    echo "<span class='page-link disabled'>&lt;</span>";
                }

                if ($totalPages <= 5) {
                    for ($i = 1; $i <= $totalPages; $i++) {
                        $offsetPage = ($i - 1) * $pageSize;
                        $activeClass = ($i == $currentPage) ? "active" : "";
                        echo "<a href='/sinhvien/index/$pageSize/$offsetPage$filterParams' class='page-link $activeClass'>$i</a>";
                    }
                } else {
                    if ($currentPage <= 3) {
                        for ($i = 1; $i <= 3; $i++) {
                            $offsetPage = ($i - 1) * $pageSize;
                            $activeClass = ($i == $currentPage) ? "active" : "";
                            echo "<a href='/sinhvien/index/$pageSize/$offsetPage$filterParams' class='page-link $activeClass'>$i</a>";
                        }
                        echo "<span class='page-ellipsis'>...</span>";
                        $lastOffset = ($totalPages - 1) * $pageSize;
                        echo "<a href='/sinhvien/index/$pageSize/$lastOffset$filterParams' class='page-link'>$totalPages</a>";
                    } elseif ($currentPage >= $totalPages - 2) {
                        echo "<a href='/sinhvien/index/$pageSize/0$filterParams' class='page-link'>1</a>";
                        echo "<span class='page-ellipsis'>...</span>";
                        for ($i = $totalPages - 2; $i <= $totalPages; $i++) {
                            $offsetPage = ($i - 1) * $pageSize;
                            $activeClass = ($i == $currentPage) ? "active" : "";
                            echo "<a href='/sinhvien/index/$pageSize/$offsetPage$filterParams' class='page-link $activeClass'>$i</a>";
                        }
                    } else {
                        echo "<a href='/sinhvien/index/$pageSize/0$filterParams' class='page-link'>1</a>";
                        echo "<span class='page-ellipsis'>...</span>";

                        $offsetPage = ($currentPage - 1) * $pageSize;
                        echo "<a href='/sinhvien/index/$pageSize/$offsetPage$filterParams' class='page-link active'>$currentPage</a>";

                        echo "<span class='page-ellipsis'>...</span>";
                        $lastOffset = ($totalPages - 1) * $pageSize;
                        echo "<a href='/sinhvien/index/$pageSize/$lastOffset$filterParams' class='page-link'>$totalPages</a>";
                    }
                }

                if ($currentPage < $totalPages) {
                    $nextOffset = $currentPage * $pageSize;
                    echo "<a href='/sinhvien/index/$pageSize/$nextOffset$filterParams' class='page-link'>&gt;</a>";
                } else {
                    echo "<span class='page-link disabled'>&gt;</span>";
                }
                ?>
            </div>
        </div>
    </div>
</div>