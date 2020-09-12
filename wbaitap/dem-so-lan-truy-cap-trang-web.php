<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Session trong PHP</h1>
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
</body>
</html>