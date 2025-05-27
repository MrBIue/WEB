<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
// san_pham.php: trang sản phẩm động với ảnh nhỏ hơn và căn chỉnh text
require_once 'connect.php';


// Lấy dữ liệu
$sql = "SELECT san_pham_id, gia_san_pham, san_pham, hinh_anh FROM san_pham ORDER BY san_pham_id";
$result = $conn->query($sql);

// Tổ chức theo nhóm
$groups = [
    'AO' => ['title' => '👕 Áo',       'id'=>'ao',         'items'=>[]],
    'QU' => ['title' => '👖 Quần',      'id'=>'quan',      'items'=>[]],
    'DA' => ['title' => '👗 Đầm - Váy', 'id'=>'dam_vay',   'items'=>[]],
    'GI' => ['title' => '👠 Giày',      'id'=>'giay',      'items'=>[]],
    'PK' => ['title' => '🎒 Phụ kiện',  'id'=>'phu_kien',  'items'=>[]],
    'TS' => ['title' => '⌚ Trang sức', 'id'=>'trang_suc', 'items'=>[]]
];
if ($result) {
    while ($r = $result->fetch_assoc()) {
        $pref = strtoupper(substr($r['san_pham_id'], 0, 2));
        if (isset($groups[$pref])) {
            $groups[$pref]['items'][] = $r;
        }
    }
}
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
    <title>Trang Sản Phẩm</title>
    <link rel="stylesheet" href="style.css">
    
    <div class="container">
        <main class="content">
            <h2>Danh sách sản phẩm</h2>
            <?php foreach ($groups as $g): ?>
                <?php if (count($g['items'])>0): ?>
                    <h3 id="<?= $g['id'] ?>"><?= $g['title'] ?></h3>
                    <div class="product-container">
                        <?php foreach ($g['items'] as $item): ?>
                            <div class="product-card">
                                <?php $img = $item['hinh_anh']?: 'imagin/default.jpg'; ?>
                                <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($item['san_pham']) ?>">
                                <h2><?= htmlspecialchars($item['san_pham']) ?></h2>
                                <p class="price"><?= number_format($item['gia_san_pham'],0,',','.') ?> VND</p>
                                <a class="btn" href="mua_ngay.php?id=<?= $item['san_pham_id'] ?>">Mua ngay</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </main>
    </div>
</body>
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
</html>
<?php $conn->close(); ?>
