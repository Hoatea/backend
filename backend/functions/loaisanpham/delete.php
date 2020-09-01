<?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $lsp_ma = $_GET['lsp_ma'];
    $sql = <<<EOT
    DELETE FROM loaisanpham
    WHERE lsp_ma = $lsp_ma;
EOT;
    mysqli_query($conn, $sql);
?>
Đã xóa <a href="index.php">Quay về</a>