<?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $nsx_ma = $_GET['nsx_ma'];
    $sql = "DELETE FROM nhasanxuat WHERE nsx_ma = {$nsx_ma};";
    mysqli_query($conn, $sql);
?>
Đã xóa <a href="index.php">Quay về</a>
