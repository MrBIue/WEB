<?php
include "connect.php";
session_start();

if (!isset($_SESSION['phien_id'])) {
    $_SESSION['phien_id'] = uniqid();
}
$phien_id = $_SESSION['phien_id'];

$conn->query("INSERT IGNORE INTO gio_hang (phien_id) VALUES ('$phien_id')");
$getGio = $conn->query("SELECT gio_hang_id FROM gio_hang WHERE phien_id = '$phien_id'");
$gio_hang_id = $getGio->fetch_assoc()['gio_hang_id'];

$sql = "
    SELECT sp.san_pham_id, sp.san_pham, sp.gia, sp.hinh_anh, ct.so_luong
    FROM chi_tiet_gio_hang ct
    JOIN san_pham sp ON ct.san_pham_id = sp.san_pham_id
    WHERE ct.gio_hang_id = $gio_hang_id
";
$result = $conn->query($sql);
?>
<body>
    <h2 style="text-align:center;">Chi tiết giỏ hàng</h2>
    <?php
    if ($result && $result->num_rows > 0) {
        echo '<table class="cart-table">';
        echo '<tr>
                <th style="width:90px;">Hình ảnh</th>
                <th style="width:220px;">Sản phẩm</th>
                <th style="width:110px;">Giá</th>
                <th style="width:90px;">Số lượng</th>
                <th style="width:130px;">Thành tiền</th>
                <th style="width:60px;">Xoá</th>
              </tr>';
        $tong = 0;
        while ($row = $result->fetch_assoc()) {
            $thanh_tien = $row['gia'] * $row['so_luong'];
            $tong += $thanh_tien;
            $img = $row['hinh_anh'] ? htmlspecialchars($row['hinh_anh']) : 'imagin/default.jpg';
            echo '<tr>';
            echo '<td><div class="cart-img-box"><img src="duong_dan_toi_anh/' . $img . '" class="cart-img" alt="' . htmlspecialchars($row['san_pham']) . '"></div></td>';
            echo '<td>' . htmlspecialchars($row['san_pham']) . '</td>';
            echo '<td>' . number_format($row['gia'], 0, ',', '.') . ' đ</td>';
            echo '<td>' . $row['so_luong'] . '</td>';
            echo '<td>' . number_format($thanh_tien, 0, ',', '.') . ' đ</td>';
            echo '<td>
                    <form method="POST" action="xoa_san_pham.php" onsubmit="return confirm(\'Bạn có chắc muốn xoá sản phẩm này không?\');" style="display:inline;">
                        <input type="hidden" name="san_pham_id" value="' . htmlspecialchars($row['san_pham_id']) . '">
                        <button type="submit" class="btn delete">X</button>
                    </form>
                  </td>';
            echo '</tr>';
        }
        // Dòng tổng cộng
        echo '<tr class="cart-total-row"><td colspan="6">Tổng cộng: ' . number_format($tong, 0, ',', '.') . ' đ</td></tr>';
        echo '</table>';
    } else {
        echo '<p style="text-align: center;">Giỏ hàng của bạn đang trống.</p>';
    }
    ?>
</body>
</html>