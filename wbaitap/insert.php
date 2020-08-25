<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thực thi SQL | INSERT</title>
</head>
<body>
    <h1>Thực thi lệnh INSERT</h1>
    <?php
        include_once(__DIR__ . '/../dbconnect.php');
        $ten = 'ZaloPay';
        $sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES(N'{$ten}');";
        mysqli_query($conn, $sql);
    ?>
</body>
</html>