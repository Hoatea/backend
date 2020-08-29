<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
</head>
<body>
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>
    <div class="container m-5">
        <div class="row">
            <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
            <div class="col-md-10">
                <h1>DELETE | EDIT</h1>
                    <?php
                        include_once(__DIR__ . '/../../../dbconnect.php');

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
                    <a href="create.php" class="btn btn-success my-3">Thêm mới</a>
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
                                    <a href="delete.php?httt_ma=<?= $httt['httt_ma']; ?>">Delete</a> | 
                                    <a href="edit.php?httt_ma=<?= $httt['httt_ma']; ?>">Edit</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
        </div>
    </div>
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
</body>
</html>
