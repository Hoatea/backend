<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .theme-light {
            background: #fff;
            color: #000;
        }
        .theme-dark {
            background: #000;
            color: #fff;
        }
    </style>
    <?php
    // Mặc định giao diện là Theme nền sáng
    $theme_class = 'theme-light';
    // Kiểm tra xem Người dùng có cấu hình giao diện theo ý thích không?
    if (isset($_COOKIE['theme_class'])) {
        // Lấy thông tin từ COOKIE từ Web Browser của client gởi đến
        $theme_class = isset($_COOKIE['theme_class']) ? $_COOKIE['theme_class'] : 'theme-light';
    }
    ?>
</head>
<body class="<?= $theme_class ?>">
    <?php
        echo '<a href="/backend/wbaitap" style="color:#555;">';
        print_r($_COOKIE['username_logged']);
        echo '</a>';
    ?>
    <p>
    <?php
        session_start();
        if (isset($_SESSION['counter'])) {
            $_SESSION['counter'] += 1;
        } else {
            $_SESSION['counter'] = 1;
        }
        $msg = '<p>Bạn đã truy cập vào trang này:' . $_SESSION['counter'] . '</p>';
        echo $msg;
    ?>
    </p>
</body>
</html>
