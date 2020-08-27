<?php
    include_once(__DIR__ . '/../dbconnect.php');
    $httt_ma = $_GET['httt_ma'];
    $sql = <<<EOT
    DELETE FROM hinhthucthanhtoan
    WHERE	httt_ma='$httt_ma';
EOT;
    mysqli_query($conn, $sql);
?>