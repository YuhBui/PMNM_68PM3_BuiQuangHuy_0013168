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
    textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    input[type="text"]:focus,
    textarea:focus {
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
    <h1>Thêm lớp học mới</h1>
    <form action="/lop/store" method="POST">
        <div class="form-group">
            <label for="malop">Mã lớp:</label>
            <input type="text" id="malop" name="malop" required placeholder="Ví dụ: 68PM3, 68IT4...">
        </div>
        <div class="form-group">
            <label for="tenlop">Tên lớp học:</label>
            <input type="text" id="tenlop" name="tenlop" required placeholder="Nhập tên đầy đủ của lớp">
        </div>
        <div class="form-group">
            <label for="ghichu">Ghi chú:</label>
            <textarea id="ghichu" name="ghichu" rows="3" placeholder="Nhập ghi chú thêm (nếu có)"></textarea>
        </div>
        <button type="submit" class="btn-submit">Thêm lớp học</button>
    </form>
    <a href="/lop/index" class="btn-back">&larr; Quay lại danh sách</a>
</div>