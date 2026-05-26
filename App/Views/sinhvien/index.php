<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <style>
        /* Reset và cấu hình font chữ chung */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            color: #333;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Container bọc toàn bộ nội dung */
        .container {
            width: 100%;
            max-width: 1000px;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
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
    </style>
</head>
<body>

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
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="no-data">Hiện tại chưa có sinh viên nào trong danh sách.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>