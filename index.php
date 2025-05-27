<?php
require_once 'connect.php';

// Thiết lập múi giờ cho chính xác (Asia/Ho_Chi_Minh)
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Bắt đầu phiên làm việc
session_start();

// Đếm số lần truy cập trang trong phiên hiện tại
if (!isset($_SESSION['visit_count'])) {
    $_SESSION['visit_count'] = 1;
} else {
    $_SESSION['visit_count']++;
}

// Lấy thông tin lần truy cập trước từ cookie
$last_visit = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : 'Chưa có dữ liệu';

// Cập nhật cookie lần truy cập hiện tại (lưu trữ 30 ngày)
setcookie(
    'last_visit',
    date('d-m-Y H:i:s'),
    time() + 30*24*60*60,
    '/'
);

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
include 'header.php'
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Thời Trang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Danh Mục Sản Phẩm</h2>
            <ul>
                <li><a href="san_pham.php#ao">👕 Áo</a></li>
                <li><a href="san_pham.php#quan">👖 Quần</a></li>
                <li><a href="san_pham.php#dam_vay">👗 Đầm - Váy</a></li>
                <li><a href="san_pham.php#giay">👠 Giày</a></li>
                <li><a href="san_pham.php#trang_suc">⌚ Trang sức</a></li>
            </ul>
        </aside>

        <!-- Nội dung chính -->
        <main class="content">
            <h2 style="text-align:center;">Tất cả sản phẩm</h2>
            
            <!-- Thanh tìm kiếm sản phẩm -->
            

            <div class="product-container">
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($item = $result->fetch_assoc()): ?>
                        <?php $img = $item['hinh_anh'] ?: 'imagin/default.jpg'; ?>
                        <div class="product-card">
                            <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($item['san_pham']) ?>">
                            <h3><?= htmlspecialchars($item['san_pham']) ?></h3>
                            <p class="price"><?= number_format($item['gia_san_pham'],0,',','.') ?> VND</p>
                            <a class="btn" href="mua_ngay.php?id=<?= urlencode($item['san_pham_id']) ?>">Mua ngay</a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p style="width:100%;text-align:center;">Không tìm thấy sản phẩm phù hợp.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; <?= date('Y') ?> Shop Thời Trang. All rights reserved.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/minhthuan.le.923724"><img src="imagin/Facebook.webp" alt="Facebook"></a>
                <a href="https://www.instagram.com/minhthuan.le.923724"><img src="imagin/Insta.webp" alt="Instagram"></a>
                <a href="https://twitter.com/minhthuan_le"><img src="imagin/X.webp" alt="Twitter"></a>
            </div>
        </div>
    </footer>

    <!-- Cookie Consent Banner -->
    <div id="cookie-consent" style="
        position: fixed;
        bottom: 0; left: 0; right: 0;
        background: rgba(0,0,0,0.8);
        color: #fff;
        padding: 15px;
        text-align: center;
        font-size: 14px;
        z-index: 1000;
        display: none;
    ">
        Chúng tôi sử dụng cookie để cải thiện trải nghiệm của bạn.
        <button id="accept-cookies" style="
            margin: 0 10px;
            padding: 8px 12px;
            background: #2ecc71;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
        ">Chấp nhận</button>
        <button id="decline-cookies" style="
            margin: 0 10px;
            padding: 8px 12px;
            background: #e74c3c;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
        ">Từ chối</button>
    </div>

    <script>
    // Hàm đặt cookie
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var d = new Date();
            d.setTime(d.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + d.toUTCString();
        }
        document.cookie = name + "=" + (value||"")  + expires + "; path=/";
    }
    // Hàm lấy cookie theo tên
    function getCookie(name) {
        var parts = document.cookie.split(';');
        for(var i=0; i<parts.length; i++) {
            var c = parts[i].trim();
            if (c.indexOf(name + "=") == 0) {
                return c.substring(name.length+1);
            }
        }
        return null;
    }
    // Cookie consent logic (ẩn/hiện banner)
    window.onload = function() {
        if (!getCookie('cookie_consent')) {
            document.getElementById('cookie-consent').style.display = 'block';
        }
        document.getElementById('accept-cookies').onclick = function() {
            setCookie('cookie_consent', 'accepted', 365);
            document.getElementById('cookie-consent').style.display = 'none';
        };
        document.getElementById('decline-cookies').onclick = function() {
            setCookie('cookie_consent', 'declined', 365);
            document.getElementById('cookie-consent').style.display = 'none';
        };
    };
    </script>

</body>
</html>