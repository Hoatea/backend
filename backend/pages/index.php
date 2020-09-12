<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <?php include_once(__DIR__.'/../layouts/styles.php'); ?>
</head>
<body>
    <?php include_once(__DIR__.'/../layouts/partials/header.php'); ?>
    <div class="container">
        <div class="row">
            <?php include_once(__DIR__.'/../layouts/partials/sidebar.php'); ?>
            <div class="col-md-10">
            <h1>Chào <?= $_SESSION['kh_tendangnhap_logged']; ?></h1>
            </div>
    </div>
    <?php include_once(__DIR__.'/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__.'/../layouts/scripts.php'); ?>
</body>
</html>
