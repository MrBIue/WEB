<?php
require_once 'connect.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$item = null;
$error = '';
$show_form = false;
$order_info = [];

if ($id !== '') {
    $stmt = $conn->prepare("SELECT * FROM san_pham WHERE san_pham_id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $item = $result->fetch_assoc();
    } else {
        $error = "Không tìm thấy sản phẩm!";
    }
    $stmt->close();
} else {
    $error = "Sản phẩm không hợp lệ!";
}

// Xử lý khi submit form đặt hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_submit'])) {
    $ho_ten = trim($_POST['ho_ten']);
    $dia_chi = trim($_POST['dia_chi']);
    $sdt = trim($_POST['sdt']);
    $email = trim($_POST['email']);
    $ghi_chu = trim($_POST['ghi_chu']);

    // Validate đơn giản
    if ($ho_ten === '' || $dia_chi === '' || $sdt === '') {
        $error = "Vui lòng nhập đầy đủ thông tin bắt buộc!";
    } else {
        // Lưu vào CSDL
        $stmt = $conn->prepare("INSERT INTO don_hang (san_pham_id, ho_ten, dia_chi, sdt, email, ghi_chu) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $id, $ho_ten, $dia_chi, $sdt, $email, $ghi_chu);
        if ($stmt->execute()) {
            $show_form = true;
            $order_info = [
                'ho_ten' => htmlspecialchars($ho_ten),
                'dia_chi' => htmlspecialchars($dia_chi),
                'sdt' => htmlspecialchars($sdt),
                'email' => htmlspecialchars($email),
                'ghi_chu' => htmlspecialchars($ghi_chu)
            ];
        } else {
            $error = "Đặt hàng thất bại. Vui lòng thử lại!";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Mua ngay<?= $item ? ' - ' . htmlspecialchars($item['san_pham']) : '' ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo"><img src="imagin/logo.webp" alt="Logo"></div>
        <h1>Shop Thời Trang</h1>
    </header>
    <div class="container">
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
            <div style="text-align:center;margin-top:20px;">
                <a href="san_pham.php">Quay lại danh sách sản phẩm</a>
            </div>
        <?php elseif ($show_form): ?>
            <div class="order-form">
                <h2>Đặt hàng thành công!</h2>
                <p><strong>Họ tên:</strong> <?= $order_info['ho_ten'] ?></p>
                <p><strong>Địa chỉ:</strong> <?= $order_info['dia_chi'] ?></p>
                <p><strong>SĐT:</strong> <?= $order_info['sdt'] ?></p>
                <p><strong>Email:</strong> <?= $order_info['email'] ?></p>
                <p><strong>Ghi chú:</strong> <?= $order_info['ghi_chu'] ?></p>
                <p>Cảm ơn bạn đã đặt hàng!</p>
                <a href="san_pham.php">Quay lại danh sách sản phẩm</a>
            </div>
        <?php else: ?>
        <div class="product-detail">
            <?php $img = $item['hinh_anh'] ?: 'imagin/default.jpg'; ?>
            <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($item['san_pham']) ?>">
            <h2><?= htmlspecialchars($item['san_pham']) ?></h2>
            <p class="price"><?= number_format($item['gia_san_pham'],0,',','.') ?> VND</p>
            <form method="post" class="order-form">
                <h3>Nhập thông tin đặt hàng</h3>
                <label>Họ tên*</label>
                <input type="text" name="ho_ten" required>
                <label>Địa chỉ*</label>
                <input type="text" name="dia_chi" required>
                <label>Số điện thoại*</label>
                <input type="text" name="sdt" required>
                <label>Email</label>
                <input type="email" name="email">
                <label>Ghi chú</label>
                <textarea name="ghi_chu"></textarea>
                <button class="btn" type="submit" name="order_submit">Xác nhận mua</button>
            </form>
            <br>
            <a class="btn" href="san_pham.php">Quay lại danh sách sản phẩm</a>
        </div>
        <?php endif; ?>
    </div>
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
<?php $conn->close(); ?>
</body>
</html>