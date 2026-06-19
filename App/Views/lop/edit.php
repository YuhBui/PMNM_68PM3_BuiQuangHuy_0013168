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
        background-color: #3498db;
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
    textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    input[type="text"]:focus,
    textarea:focus {
        border-color: #3498db;
        outline: none;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
    }

    .btn-submit {
        background-color: #f39c12;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        font-weight: bold;
    }

    .btn-submit:hover {
        background-color: #d68910;
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
    <h1>Sửa lớp học</h1>
    <form action="/lop/update/<?php echo isset($lop['malop']) ? urlencode($lop['malop']) : ''; ?>" method="POST">
        <div class="form-group">
            <label for="malop">Mã lớp:</label>
            <input type="text" id="malop" value="<?php echo htmlspecialchars($lop['malop'] ?? ''); ?>" disabled style="background-color: #e9ecef; cursor: not-allowed;">
        </div>
        <div class="form-group">
            <label for="tenlop">Tên lớp học:</label>
            <input type="text" id="tenlop" name="tenlop" value="<?php echo htmlspecialchars($lop['tenlop'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="ghichu">Ghi chú:</label>
            <textarea id="ghichu" name="ghichu" rows="3"><?php echo htmlspecialchars($lop['ghichu'] ?? ''); ?></textarea>
        </div>
        <button type="submit" class="btn-submit">Cập nhật lớp học</button>
    </form>
    <a href="/lop/index" class="btn-back">&larr; Quay lại danh sách</a>
</div>