<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .header {
      height: 80px;
      width: 100%;
      background-color: #051525;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 30px;
      box-sizing: border-box;
      color: white;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .header .logo {
      font-size: 18px;
      font-weight: bold;
      letter-spacing: 0.5px;
    }

    .header .nav-menu {
      display: flex;
      gap: 15px;
      list-style: none;
      align-items: center;
    }

    .header .nav-menu a {
      color: #ffffff;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      padding: 8px 12px;
      border-radius: 4px;
      transition: all 0.2s ease;
    }

    .header .nav-menu a:hover {
      color: #3498db;
      background-color: rgba(255, 255, 255, 0.08);
    }

    .header .nav-menu a.logout-btn {
      background-color: #e74c3c;
      color: white;
    }

    .header .nav-menu a.logout-btn:hover {
      background-color: #c0392b;
    }
  </style>

  <div class="header">
    <div class="logo">QUẢN LÝ SINH VIÊN</div>
    <ul class="nav-menu">
      <?php if (isset($_SESSION['username'])): ?>
        <li><a href="/sinhvien/index">Quản lý sinh viên</a></li>
        <li><a href="/lop/index">Quản lý lớp học</a></li>
        <li style="color: #95a5a6; font-size: 13px; margin: 0 10px;">
          <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
        </li>
        <li><a href="/auth/logout" class="logout-btn">Đăng xuất</a></li>
      <?php endif; ?>
    </ul>
  </div>
</head>

</html>