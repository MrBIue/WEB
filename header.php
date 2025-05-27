<header>
    <div class="header-flex">
        <div class="logo">
            <img src="imagin/logo.webp" alt="Shop Logo">
        </div>
        <h1>Shop Thời Trang</h1>
    </div>
    <?php if (isset($_SESSION['visit_count']) && isset($last_visit)): ?>
    <div class="info" style="text-align:center; margin-top:10px; color:#555;">
        <p>Lần truy cập trang này trong phiên: <strong><?= $_SESSION['visit_count'] ?></strong></p>
        <p>Lần truy cập cuối: <strong><?= htmlspecialchars($last_visit) ?></strong></p>
    </div>
    <?php endif; ?>
</header>

<nav class="navbar">
        <ul class="menu">
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="san_pham.php">Sản phẩm</a></li>
            <li><a href="bo_suu_tap.php">Bộ sưu tập</a></li>
            <li><a href="khuyen_mai.php">Khuyến mãi</a></li>
            <li><a href="lien_he.php">Liên hệ</a></li>
            <li><a href="don_hang_da_mua.php">Đơn hàng đã mua </a></li>
            <li><form class="search-form" method="get" action="index.php">
                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." value="<?= htmlspecialchars($keyword) ?>">
                <button type="submit">🔍</button>
            </form>
            </li>
        </ul>
    </nav>

