<?php
include "connect.php";
session_start();

if (!isset($_SESSION['phien_id'])) {
    header("Location: gio_hang.php");
    exit;
}

$phien_id = $_SESSION['phien_id'];

// Lấy ID giỏ hàng theo phiên
$getGio = $conn->query("SELECT gio_hang_id FROM gio_hang WHERE phien_id = '$phien_id'");
if ($getGio->num_rows > 0) {
    $gio_hang_id = $getGio->fetch_assoc()['gio_hang_id'];

    // Xoá toàn bộ sản phẩm khỏi chi tiết giỏ hàng
    $conn->query("DELETE FROM chi_tiet_gio_hang WHERE gio_hang_id = $gio_hang_id");
}

header("Location: gio_hang.php");
exit;
?>
