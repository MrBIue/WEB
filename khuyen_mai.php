<?php
// khuyen_mai.php: trang khuyến mãi động theo định dạng của san_pham.php
require_once 'connect.php';
// Xử lý tìm kiếm sản phẩm
$keyword = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($keyword !== '') {
    $stmt = $conn->prepare("SELECT * FROM san_pham WHERE san_pham LIKE ? OR san_pham_id LIKE ? ORDER BY san_pham_id");
    $like = "%$keyword%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM san_pham ORDER BY san_pham_id";
    $result = $conn->query($sql);
}
include 'header.php';

// Lấy dữ liệu khuyến mãi
$sql = "SELECT id, ten_san_pham, hinh_anh, gia_cu, gia_moi FROM khuyen_mai ORDER BY id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chương Trình Khuyến Mãi</title>
    <link rel="stylesheet" href="style.css">
</head>

    <div class="container">
        <main class="content">
            <h2>Chương Trình Khuyến Mãi</h2>
            <div class="product-container">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php $img = $row['hinh_anh'] ?: 'imagin/default.jpg'; ?>
                        <div class="product-card">
                            <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($row['ten_san_pham']) ?>">
                            <h2><?= htmlspecialchars($row['ten_san_pham']) ?></h2>
                            <p class="price">
                                <del><?= number_format($row['gia_cu'],0,',','.') ?> VND</del>
                                <?= number_format($row['gia_moi'],0,',','.') ?> VND
                            </p>
                            <a class="btn" href="mua_ngay.php?id=<?= $item['san_pham_id'] ?>">Mua ngay</a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Chưa có chương trình khuyến mãi nào.</p>
                <?php endif; ?>
                <?php $conn->close(); ?>
            </div>
        </main>
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
</body>
</html>
