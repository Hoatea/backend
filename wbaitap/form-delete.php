<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <title>Thực thi SQL | FORM DELETE</title>
</head>
<body>
    <h1>DELETE | UPDATE</h1>
    <?php
        include_once(__DIR__ . '/../dbconnect.php');

        $sql = <<<EOT
        SELECT httt_ma,httt_ten
        FROM hinhthucthanhtoan;
EOT;
        $result = mysqli_query($conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = array(
                'httt_ma' => $row['httt_ma'],
                'httt_ten' => $row['httt_ten'],
            );
        }

    ?>
    <table border="1">
    <thead>
        <tr>
            <th>Mã Hình thức Thanh toán</th>
            <th>Tên Hình thức Thanh toán</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $httt): ?>
        <tr>
            <td><?= $httt['httt_ma']; ?></td>
            <td><?= $httt['httt_ten']; ?></td>
            <td>
                <a href="xu_ly.php?httt_ma=<?= $httt['httt_ma']; ?>">Delete</a> | 
                <a href="form-update.php?httt_ma=<?= $httt['httt_ma']; ?>">Update</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <script src="../assets/vendor/jquery/jquery.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
</body>
</html>