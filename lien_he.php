<?php
include "connect.php";

$thong_bao = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ho_ten = trim($_POST['ho_ten']);
    $email = trim($_POST['email']);
    $sdt = trim($_POST['sdt']);
    $noi_dung = trim($_POST['noi_dung']);
    $ngay_gui = date('Y-m-d H:i:s');

    // Kiểm tra email hợp lệ
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $thong_bao = "Email không hợp lệ.";
    } else {
        $sql = "INSERT INTO lien_he (lien_he_ho_ten, lien_he_email, lien_he_sdt, lien_he_noi_dung, lien_he_ngay_gui) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $ho_ten, $email, $sdt, $noi_dung, $ngay_gui);
            if ($stmt->execute()) {
                $thong_bao = "Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi trong thời gian sớm nhất.";
            } else {
                $thong_bao = "Có lỗi xảy ra khi lưu dữ liệu: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $thong_bao = "Có lỗi xảy ra: " . $conn->error;
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Liên hệ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Liên hệ với chúng tôi</h2>
    <?php if ($thong_bao): ?>
        <div class="error" style="color:green;text-align:center;"><?= htmlspecialchars($thong_bao) ?></div>
    <?php endif; ?>
    <form method="post" class="order-form" style="max-width:500px;margin:30px auto;">
        <label>Họ tên*</label>
        <input type="text" name="ho_ten" required>
        <label>Email*</label>
        <input type="email" name="email" required>
        <label>Số điện thoại</label>
        <input type="text" name="sdt">
        <label>Nội dung*</label>
        <textarea name="noi_dung" required></textarea>
        <button class="btn" type="submit">Gửi liên hệ</button>
    </form>
</body>
<a class="btn" href="index.php"><-- quay lại </a>
<!-- Footer -->
    <footer class="footer">
    <div class="footer-content">
        <div class="footer-info">
            <p><strong>Địa chỉ:</strong> 30/218, Trần Văn Ơn, TP.Quy Nhơn</p>
            <p><strong>Email:</strong> <a href="mailto:info@shopthoitrang.vn">info@shopthoitrang.vn</a></p>
            <p><strong>Điện thoại:</strong> <a href="tel:0123456789">0352 241 508</a></p>
            <p><strong>Mã số thuế:</strong> 0123456789 | <strong>Giấy phép KD:</strong> 1234/GP-TTĐT</p>
            <p><strong>Thời gian hoạt động:</strong> 7:00 - 22:00 (T2 - CN)</p>
            <p><strong>Hỗ trợ khách hàng:</strong> <a href="chinh_sach.php">Chính sách &amp; Điều khoản</a> | <a href="doi_tra.php">Đổi trả &amp; Bảo hành</a></p>
            <p>&copy; <?= date('Y') ?> Shop Thời Trang. All rights reserved.</p>
        </div>
        <div class="social-icons">
            <a href="https://www.facebook.com/minhthuan.le.923724"><img src="imagin/Facebook.webp" alt="Facebook"></a>
            <a href="https://www.instagram.com/minhthuan.le.923724"><img src="imagin/Insta.webp" alt="Instagram"></a>
            <a href="https://twitter.com/minhthuan_le"><img src="imagin/X.webp" alt="Twitter"></a>
        </div>
        <div class="certification" style="margin-top:10px;">
            <img src="imagin/bocongthuong.png" alt="Đã thông báo Bộ Công Thương" style="height:32px;">
            <span style="font-size:13px;color: white;">Đã thông báo với Bộ Công Thương</span>
        </div>
    </div>
</footer>
</html>