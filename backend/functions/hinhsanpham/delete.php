<?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $hsp_ma = $_GET['hsp_ma'];

    $sqlSelect = "SELECT * FROM `hinhsanpham` WHERE hsp_ma=$hsp_ma;";
    $resultSelect = mysqli_query($conn, $sqlSelect);
    $hinhsanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);
    $upload_dir = __DIR__ . "/../../../assets/uploads/";
    $subdir = 'products/';
    $old_file = $upload_dir . $subdir . $hinhsanphamRow['hsp_tentaptin'];
    if (file_exists($old_file)) {
        unlink($old_file);
    }

    $sql = "DELETE FROM hinhsanpham WHERE hsp_ma = {$hsp_ma};";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    header('location:index.php');
?>
