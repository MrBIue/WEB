<?php
require_once 'connect.php';
$thong_bao = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($username === '' || $email === '' || $password === '') {
        $thong_bao = "Vui lòng nhập đầy đủ thông tin!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $thong_bao = "Email không hợp lệ!";
    } elseif ($password !== $password2) {
        $thong_bao = "Mật khẩu nhập lại không khớp!";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $thong_bao = "Tên đăng nhập hoặc email đã tồn tại!";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hash, $email);
            if ($stmt->execute()) {
                header("Location: login.php?success=1");
                exit;
            } else {
                $thong_bao = "Lỗi đăng ký: " . $conn->error;
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2 style="text-align:center;margin-top:30px;">Đăng ký tài khoản</h2>
    <?php if ($thong_bao): ?>
        <div class="error" style="text-align:center;"><?= htmlspecialchars($thong_bao) ?></div>
    <?php endif; ?>
    <form method="post" class="order-form" style="max-width:400px;margin:30px auto;">
        <label>Tên đăng nhập*</label>
        <input type="text" name="username" required>
        <label>Email*</label>
        <input type="email" name="email" required>
        <label>Mật khẩu*</label>
        <input type="password" name="password" required>
        <label>Nhập lại mật khẩu*</label>
        <input type="password" name="password2" required>
        <button class="btn" type="submit">Đăng ký</button>
    </form>
    <p style="text-align:center;">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    <div style="text-align:center;">
        <a class="btn" href="index.php">&larr; Quay lại</a>
    </div>
</body>
</html>