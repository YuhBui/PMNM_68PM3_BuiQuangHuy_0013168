<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
</head>
<body>
    <h1>Danh sách sinh viên</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Họ và Tên</th>
            <th>MSSV</th>
            <th>Giới Tính</th>
        </tr>
        
        <?php foreach ($sinhviens as $index => $sinhvien): ?>
            <tr>
                <td><?php echo $index + 1; ?></td>
                <td><?php echo $sinhvien['hoten']; ?></td>
                <td><?php echo $sinhvien['mssv']; ?></td>
                <td><?php echo $sinhvien['gioitinh']; ?></td>
            </tr>
        <?php endforeach; ?>
        ?>
    </table>
</body>
</html>