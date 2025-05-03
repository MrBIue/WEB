<?php
    $sever = 'localhost';
    $user = 'root';
    $pass = '';
    $database = 'shop_thoitrang';

    $conn = new mysqLi($sever, $user, $pass, $database);

    if($conn){
        mysqli_query($conn, "SET NAME 'utf8'");
        echo 'da ket noi thanh cong';
    }
    else{
        echo 'that bai';
    }
?>