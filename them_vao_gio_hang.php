<?php
include "connect.php";
session_start();

if (!isset($_SESSION['phien_id'])) {
    $_SESSION['phien_id'] = uniqid();
}
$phien_id = $_SESSION['phien_id'];

$san_pham_id = $_POST['san_pham_id'];
$so_luong = $_POST['so_luong'] ?? 1;

$conn->query("INSERT IGNORE INTO gio_hang (phien_id) VALUES ('$phien_id')");
$getGio = $conn->query("SELECT gio_hang_id FROM gio_hang WHERE phien_id = '$phien_id'");
$gio_hang_id = $getGio->fetch_assoc()['gio_hang_id'];

$check = $conn->query("SELECT * FROM chi_tiet_gio_hang WHERE gio_hang_id = $gio_hang_id AND san_pham_id = '$san_pham_id'");

if ($check->num_rows > 0) {
    $conn->query("UPDATE chi_tiet_gio_hang SET so_luong = so_luong + $so_luong WHERE gio_hang_id = $gio_hang_id AND san_pham_id = '$san_pham_id'");
} else {
    $conn->query("INSERT INTO chi_tiet_gio_hang (gio_hang_id, san_pham_id, so_luong) VALUES ($gio_hang_id, '$san_pham_id', $so_luong)");
}   

$redirect = $_POST['redirect'] ?? 'san_pham.php';
header("Location: $redirect");
exit;
?>