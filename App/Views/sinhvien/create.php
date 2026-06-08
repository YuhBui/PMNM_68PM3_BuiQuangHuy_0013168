<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Thêm sinh viên</h1>
    <form action="/sinhvien/create" method="POST">
        <label for="hoten">Họ tên:</label>
        <input type="text" id="hoten" name="hoten" required>
        <label for="tuoi">Giới tính:</label>
        <input type="number" id="gioitinh" name="gioitinh" required>
        <label for="mssv">MSSV:</label>
        <input type="text" id="mssv" name="mssv" required>
        <button type="submit">Thêm sinh viên</button>
    </form>
</body>
</html>