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
    
    input[type="text"], input[type="number"], select {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }
    
    input[type="text"]:focus, input[type="number"]:focus, select:focus {
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
        transition: background-color 0.2s;
        width: 100%;
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
    <h1>Sửa sinh viên</h1>
    <form action="/sinhvien/update/<?php echo isset($sinhvien['id']) ? $sinhvien['id'] : ''; ?>" method="POST">
        <div class="form-group">
            <label for="hoten">Họ tên:</label>
            <input type="text" id="hoten" name="hoten" value="<?php echo htmlspecialchars($sinhvien['hoten'] ?? ''); ?>" required>
        </div>
        
        <div class="form-group">
            <label>Giới tính:</label>
            <div class="radio-group" style="padding: 10px 0;">
                <label style="display: inline; font-weight: normal; margin-right: 15px; cursor: pointer;">
                    <input type="radio" name="gioitinh" value="0" <?php echo (isset($sinhvien['gioitinh']) && $sinhvien['gioitinh'] == '0') ? 'checked' : ''; ?> required> Nam
                </label>
                <label style="display: inline; font-weight: normal; cursor: pointer;">
                    <input type="radio" name="gioitinh" value="1" <?php echo (isset($sinhvien['gioitinh']) && $sinhvien['gioitinh'] == '1') ? 'checked' : ''; ?> required> Nữ
                </label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="mssv">MSSV:</label>
            <input type="text" id="mssv" name="mssv" value="<?php echo htmlspecialchars($sinhvien['mssv'] ?? ''); ?>" required>
        </div>
        
        <button type="submit" class="btn-submit">Cập nhật sinh viên</button>
    </form>
    <a href="/sinhvien/index" class="btn-back">&larr; Quay lại danh sách</a>
</div>