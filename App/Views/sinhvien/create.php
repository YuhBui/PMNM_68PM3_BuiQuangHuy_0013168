<style>
    .form-container {
        width: 100%;
        max-width: 600px;
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
        background-color: #2ecc71;
        border-radius: 2px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    input[type="text"]:focus,
    select:focus {
        border-color: #2ecc71;
        outline: none;
        box-shadow: 0 0 5px rgba(46, 204, 113, 0.3);
    }

    .btn-submit {
        background-color: #2ecc71;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.2s;
        width: 100%;
        font-weight: bold;
    }

    .btn-submit:hover {
        background-color: #27ae60;
    }

    .btn-back {
        display: inline-block;
        margin-top: 15px;
        color: #7f8c8d;
        text-decoration: none;
    }

    .btn-back:hover {
        text-decoration: underline;
    }
</style>

<div class="form-container">
    <h1>Thêm sinh viên</h1>
    <form action="/sinhvien/store" method="POST">
        <div class="form-group">
            <label for="mssv">MSSV:</label>
            <input type="text" id="mssv" name="mssv" required placeholder="Nhập mã số sinh viên">
        </div>

        <div class="form-group">
            <label for="hoten">Họ tên:</label>
            <input type="text" id="hoten" name="hoten" required placeholder="Nhập họ và tên">
        </div>

        <div class="form-group">
            <label for="gioitinh">Giới tính:</label>
            <select id="gioitinh" name="gioitinh" required>
                <option value="0">Nam</option>
                <option value="1">Nữ</option>
            </select>
        </div>

        <button type="submit" class="btn-submit">Thêm sinh viên</button>
    </form>
    <a href="/sinhvien/index" class="btn-back">&larr; Quay lại danh sách</a>
</div>