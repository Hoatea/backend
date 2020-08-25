<?php
    $userName = $_GET['txtUserName'];
    $pass = $_GET['txtPassword'];
    if($userName == 'admin' && $pass == '000000'){
        echo 'Đăng nhập thành công';
    }else{
        echo 'Đăng nhập thất bại';
    }
?>