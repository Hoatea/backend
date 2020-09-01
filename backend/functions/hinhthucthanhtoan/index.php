<!-- Trang index của Back-end -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Backend | Chỉnh sửa bảng hình thức thanh toán</title>
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>
    <!-- End header -->
    <!-- Container -->
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-2">
                <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
            </div>
            <div class="col-md-10 text-center">
                <h1>DELETE | EDIT</h1>
                    <?php
                        include_once(__DIR__ . '/../../../dbconnect.php');

                        $sql = " SELECT httt_ma,httt_ten FROM hinhthucthanhtoan;";
                        $result = mysqli_query($conn, $sql);
                        $data = [];
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $data[] = array(
                                'httt_ma' => $row['httt_ma'],
                                'httt_ten' => $row['httt_ten'],
                            );
                        }

                    ?>
                    <a href="create.php" class="btn btn-success my-3">Add new</a>
                    <table class="mx-auto table table-hover">
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
    <!-- End container -->
    <!-- Footer -->
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
</body>
</html>
