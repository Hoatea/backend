<!-- Trang index của Back-end -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Backend | Update bảng hình thức thanh toán</title>
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
                <h1>UPDATE</h1>
                <?php
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    $lsp_ma = $_GET['lsp_ma'];
                    $sql = " SELECT lsp_ma, lsp_ten, lsp_mota FROM loaisanpham WHERE lsp_ma = $lsp_ma;";
                    $result = mysqli_query($conn, $sql);
                    $data = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data = array(
                            'lsp_ma' => $row['lsp_ma'],
                            'lsp_ten' => $row['lsp_ten'],
                            'lsp_mota' => $row['lsp_mota'],
                        );
                    }
                ?>
                <form action="" method="POST" name="frm_insert" id="frm_insert">
                    <table class="mx-auto text-left">
                        <tr>
                            <td>Tên loại sản phẩm : </td>
                            <td><input type="text" name="lsp_ten" id="lsp_ten" value="<?= $data['lsp_ten'] ?>" autofocus /></td>
                        </tr>
                        <tr>
                            <td>Mô tả : </td>
                            <td><textarea name="lsp_mota" id="lsp_mota" cols="30" rows="10"><?= $data['lsp_mota'] ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center py-3">
                                <input class="btn btn-success" type="submit" value="Sửa" name="btn_sua">
                                <a class="btn btn-success" href="index.php">Quay về</a>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                    if(isset($_POST['btn_sua'])){
                        $lsp_ten=$_POST['lsp_ten']; 
                        $lsp_mota=$_POST['lsp_mota']; 
                        $sql = "UPDATE loaisanpham SET lsp_ten=N'$lsp_ten', lsp_mota=N'$lsp_mota'  WHERE lsp_ma=$lsp_ma;";
                        mysqli_query($conn, $sql);
                    }
                ?>
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
