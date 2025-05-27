<?php
// bo_suu_tap_mt.php
require_once 'connect.php';
$conn->set_charset('utf8');
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

// Truy vấn dữ liệu
$sql    = "SELECT san_pham_id, anh, gia_san_pham_mt FROM bo_suu_tap_mt ORDER BY san_pham_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bộ Sưu Tập Mùa Thu</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imagin/logo.webp">
    <style>
        .product-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 100%;
            padding-bottom: 10px;
        }
        .product-card img {
            width:100% ;
            height: 180px;
            object-fit: cover;
            display: block;
        }
        .product-card h4 {
            margin: 10px 0 5px;
            font-size: 1em;
        }
        .product-card p {
            margin: 5px 0;
            font-weight: bold;
            color: #e74c3c;
        }
        .buy-btn {
            margin-top: 10px;
            display: inline-block;
            padding: 6px 12px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .buy-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <!-- Nội dung chính -->
    <main>
        <h1 style="text-align:center; padding-top:20px;">Bộ Sưu Tập Mùa Thu</h1>
        <section class="product-section">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php 
                        // Sửa đường dẫn ảnh cho đúng dấu /
                        $img = $row['anh'] ? str_replace('\\', '/', $row['anh']) : 'imagin/default.jpg';
                        $gia = number_format($row['gia_san_pham_mt'], 0, ',', '.');
                    ?>
                    <div class="product-card">
                        <img src="<?php echo htmlspecialchars($img); ?>" alt="<?php echo htmlspecialchars($row['san_pham_id']); ?>">
                        <h4><?php echo htmlspecialchars($row['san_pham_id']); ?></h4>
                        <p><?php echo $gia; ?>₫</p>
                        <a class="buy-btn" href="mua_ngay.php?id=<?php echo urlencode($row['san_pham_id']); ?>">Mua ngay</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align:center;">Chưa có sản phẩm nào trong bộ sưu tập này.</p>
            <?php endif; ?>

            <?php $conn->close(); ?>
        </section>
        <a class="buy-btn" href="bo_suu_tap.php"><-- quay lại </a>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 Shop Thời Trang. All rights reserved.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/minhthuan.le.923724"><img src="imagin/Facebook.webp" alt="Facebook"></a>
                <a href="https://www.facebook.com/minhthuan.le.923724"><img src="imagin/Insta.webp" alt="Instagram"></a>
                <a href="https://www.facebook.com/minhthuan.le.923724"><img src="imagin/X.webp" alt="Twitter"></a>
            </div>
        </div>
    </footer>

</body>
</html>