<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toán Tử</title>
</head>
<body>
    <?php
    $a = 10;
    $b = 3;
    $tong = $a + $b;
    $hieu = $a - $b;
    $tich = $a * $b;
    $thuong = $a / $b;
    $mod = $a % $b;
    $div = (int)$thuong;
    $trungBinh = $tong / 2;
    
    echo '<ul>';
    echo '<li>Số a : '.$a.'</li>';
    echo '<li>Số b : '.$b.'</li>';
    echo '<li>Tổng : '.$tong.'</li>';
    echo '<li>Hiệu : '.$hieu.'</li>';
    echo '<li>Tích : '.$tich.'</li>';
    echo '<li>Thương : '.$thuong.'</li>';
    echo '<li>Chia dư : '.$mod.'</li>';
    echo '<li>Chia nguyên : '.$div.'</li>';
    echo '<li>Trung bình cộng : '.$trungBinh.'</li>';
    echo '</ul>';
    ?>
</body>
</html>