<?php
require_once 'connect.php';

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
    <style>
        table.donhang {
            border-collapse: collapse;
            margin: 30px auto;
            width: 98%;
            background: #fff;
            box-shadow: 0 2px 12px rgba(41,182,246,0.08);
        }
        table.donhang th, table.donhang td {
            border: 1px solid #b3e5fc;
            padding: 10px 8px;
            text-align: center;
        }
        table.donhang th {
            background: #4FC3F7;
            color: #fff;
        }
        table.donhang tr:nth-child(even) {
            background: #e3f6fd;
        }
        .delete-btn {
            background: #e74c3c;
            color: #fff;
            border: none;
            padding: 6px 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .delete-btn:hover {
            background: #c0392b;
        }
    </style>
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
    <footer class="footer">
        <p>&copy; <?= date('Y') ?> Shop Thời Trang. All rights reserved.</p>
    </footer>
<?php $conn->close(); ?>
</body>
</html>