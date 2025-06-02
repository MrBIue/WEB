<?php
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

// Xử lý xóa đơn hàng nếu có yêu cầu
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM don_hang WHERE id = $delete_id");
    // Sau khi xóa, chuyển hướng để tránh lặp lại thao tác khi refresh
    header("Location: don_hang_da_mua.php");
    exit;
}

// Lấy danh sách đơn hàng vừa mua từ bảng don_hang
$sql = "SELECT * FROM don_hang ORDER BY id DESC";
$result = $conn->query($sql);

include 'header.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng đã mua</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h2 style="text-align:center;margin:30px 0 10px 0;">Danh sách đơn hàng đã mua</h2>
        <table class="donhang">
            <tr>
                <th>ID</th>
                <th>Mã sản phẩm</th>
                <th>Họ tên</th>
                <th>Địa chỉ</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Ghi chú</th>
                <th>Ngày đặt</th>
                <th>Xoá</th>
            </tr>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['san_pham_id']) ?></td>
                    <td><?= htmlspecialchars($row['ho_ten']) ?></td>
                    <td><?= htmlspecialchars($row['dia_chi']) ?></td>
                    <td><?= htmlspecialchars($row['sdt']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['ghi_chu']) ?></td>
                    <td><?= isset($row['ngay_dat']) ? $row['ngay_dat'] : '' ?></td>
                    <td>
                        <a href="don_hang_da_mua.php?delete_id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá đơn hàng này?');" class="delete-btn">Xoá</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="9">Chưa có đơn hàng nào.</td></tr>
            <?php endif; ?>
        </table>
    </main>
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