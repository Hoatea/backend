<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thực thi SQL | DELETE</title>
</head>
<body>
    <h1>Thực thi lệnh DELETE</h1>
    <?php
        include_once(__DIR__ . '/../dbconnect.php');
        $httt_ma = 9;
        $sql = <<<EOT
        DELETE FROM hinhthucthanhtoan
        WHERE	httt_ma='$httt_ma';
EOT;
        mysqli_query($conn, $sql);
    ?>
</body>
</html>