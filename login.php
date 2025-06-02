<?php
require_once 'connect.php';
session_start();
$thong_bao = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($uid, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $uid;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $thong_bao = "Sai mật khẩu!";
        }
    } else {
        $thong_bao = "Tài khoản không tồn tại!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2 style="text-align:center;margin-top:30px;">Đăng nhập</h2>
    <?php if (isset($_GET['success'])): ?>
        <div style="color:green;text-align:center;">Đăng ký thành công! Vui lòng đăng nhập.</div>
    <?php endif; ?>
    <?php if ($thong_bao): ?>
        <div class="error" style="text-align:center;"><?= htmlspecialchars($thong_bao) ?></div>
    <?php endif; ?>
    <form method="post" class="order-form" style="max-width:400px;margin:30px auto;">
        <label>Tên đăng nhập</label>
        <input type="text" name="username" required>
        <label>Mật khẩu</label>
        <input type="password" name="password" required>
        <button class="btn" type="submit">Đăng nhập</button>
    </form>
    <p style="text-align:center;">Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    <div style="text-align:center;">
        <a class="btn" href="index.php">&larr; Quay lại</a>
    </div>
</body>
</html>