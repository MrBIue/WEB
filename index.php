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

// PHÂN TRANG
$limit = 8; // Số sản phẩm mỗi trang
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Đếm tổng số sản phẩm phù hợp
if ($keyword !== '') {
    $count_stmt = $conn->prepare("SELECT COUNT(*) as total FROM san_pham WHERE san_pham LIKE ? OR san_pham_id LIKE ?");
    $like = "%$keyword%";
    $count_stmt->bind_param("ss", $like, $like);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $total = $count_result->fetch_assoc()['total'];
    $count_stmt->close();
} else {
    $count_result = $conn->query("SELECT COUNT(*) as total FROM san_pham");
    $total = $count_result->fetch_assoc()['total'];
}
$total_pages = ceil($total / $limit);

// Lấy sản phẩm cho trang hiện tại
if ($keyword !== '') {
    $stmt = $conn->prepare("SELECT * FROM san_pham WHERE san_pham LIKE ? OR san_pham_id LIKE ? ORDER BY san_pham_id LIMIT ? OFFSET ?");
    $stmt->bind_param("ssii", $like, $like, $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM san_pham ORDER BY san_pham_id LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);
}

include 'header.php';
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

            <!-- PHÂN TRANG -->
            <div style="text-align:center; margin: 30px 0;">
                <?php if ($total_pages > 1): ?>
                    <?php
                        // Giữ lại các tham số GET khác (như search)
                        $query = $_GET;
                    ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <?php
                            $query['page'] = $i;
                            $query_str = http_build_query($query);
                        ?>
                        <?php if ($i == $page): ?>
                            <span style="display:inline-block;min-width:32px;padding:8px 12px;margin:0 3px;background:#4FC3F7;color:#fff;border-radius:4px;font-weight:bold;"><?= $i ?></span>
                        <?php else: ?>
                            <a href="?<?= $query_str ?>" style="display:inline-block;min-width:32px;padding:8px 12px;margin:0 3px;background:#e3f6fd;color:#0277BD;border-radius:4px;text-decoration:none;"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php endif; ?>
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