<!-- Trang index của bảng loaisanpham -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Backend | Bảng loại sản phẩm</title>
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>
    <!-- End header -->
    <!-- Container -->
    <div class="container-fluid my-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2">
                <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
            </div>
            <!-- End sidebar -->
            <div class="col-md-10 text-center">
                <h1>Bảng các loại sản phẩm</h1>
                    <?php
                        include_once(__DIR__ . '/../../../dbconnect.php');

                        $sql = " SELECT lsp_ma,lsp_ten,lsp_mota FROM loaisanpham;";
                        $result = mysqli_query($conn, $sql);
                        $data = [];
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $data[] = array(
                                'lsp_ma' => $row['lsp_ma'],
                                'lsp_ten' => $row['lsp_ten'],
                                'lsp_mota' => $row['lsp_mota'],
                            );
                        }

                    ?>
                    <a href="create.php" class="btn btn-success my-3">Add</a>
                    <table border="1" class="mx-auto">
                        <thead>
                            <tr>
                                <th>Mã loại sản phẩm</th>
                                <th>Tên loại sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $httt): ?>
                            <tr>
                                <td><?= $httt['lsp_ma']; ?></td>
                                <td><?= $httt['lsp_ten']; ?></td>
                                <td><?= $httt['lsp_mota']; ?></td>
                                <td>
                                    <a href="delete.php?lsp_ma=<?= $httt['lsp_ma']; ?>">Delete</a> | 
                                    <a href="edit.php?lsp_ma=<?= $httt['lsp_ma']; ?>">Edit</a>
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
