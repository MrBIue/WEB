<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bộ Sưu Tập</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

    <?php
// bo_suu_tap.php: trang hiển thị các bộ sưu tập
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


// Lấy dữ liệu từ bảng bo_suu_tap
$sql = "SELECT bo_suu_tap_id, ten_bo_suu_tap, hinh_anh 
        FROM bo_suu_tap 
        ORDER BY bo_suu_tap_id";
$result = $conn->query($sql);

?>

<main>
    <section class="collection-section collection-container">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="collection-card">
                    <h3><?php echo htmlspecialchars($row['ten_bo_suu_tap']); ?></h3>
                    <img src="imagin/<?php echo htmlspecialchars($row['hinh_anh']); ?>" alt="<?php echo htmlspecialchars($row['ten_bo_suu_tap']); ?>">
                    <?php
                        // Chọn link theo ID
                        if ($row['bo_suu_tap_id'] == 1) {
                            $link = 'bo_suu_tap_mh.php';
                        } elseif ($row['bo_suu_tap_id'] == 2) {
                            $link = 'bo_suu_tap_md.php';
                        } elseif ($row['bo_suu_tap_id'] == 3) {
                            $link = 'bo_suu_tap_mx.php';
                        } elseif ($row['bo_suu_tap_id'] == 4) {
                            $link = 'bo_suu_tap_mt.php';
                        } else {
                            $link = '#';
                        }
                    ?>
                    <a href="<?php echo $link; ?>" class="btn">Xem chi tiết</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Chưa có bộ sưu tập nào.</p>
        <?php endif; ?>
    </section>
</main>

<?php $conn->close(); ?>


    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 Shop Thời Trang. All rights reserved.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/minhthuan.le.923724"><img src="imagin\Facebook.webp" alt="Facebook"></a>
                <a href="https://www.facebook.com/minhthuan.le.923724"><img src="imagin\Insta.webp" alt="Instagram"></a>
                <a href="https://www.facebook.com/minhthuan.le.923724"><img src="imagin\X.webp" alt="Twitter"></a>
            </div>
        </div>
    </footer>
</body>
</html>
