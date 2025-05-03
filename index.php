<?php
// index.php
  include "connect.php";


?><!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Thời Trang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo"><img src="imagin/logo.webp" alt="Shop Logo"></div>
        <h1>Shop Thời Trang</h1>
    </header>
    <nav class="navbar">
        <ul class="menu">
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="index.php">Sản phẩm</a></li>
            <li><a href="bo_suu_tap.php">Bộ sưu tập</a></li>
            <li><a href="khuyen_mai.php">Khuyến mãi</a></li>
            <li><a href="lien_he.php">Liên hệ</a></li>
        </ul>
    </nav>

    <main class="content">
        <h2>Danh sách sản phẩm</h2>
        <?php include 'san_pham.php'; ?>
    </main>

    <footer class="footer">
        <p>&copy; <?= date('Y') ?> Shop Thời Trang. All rights reserved.</p>
    </footer>
</body>
</html>
