<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Backend | Thêm mới bảng hình thức thanh toán</title>
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
</head>
<body>
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-2">
                <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
            </div>
            <div class="col-md-10 text-center">
                <h1>INSERT</h1>
                <form action="" method="POST" name="frm_insert" id="frm_insert">
                    <table class="mx-auto">
                        <tr>
                            <td>Tên phương thức thanh toán : </td>
                            <td><input type="text" name="httt_ten" id="httt_ten" autofocus></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center py-3">
                                <input class="btn btn-success" type="submit" value="Thêm" name="btn_them">
                                <a class="btn btn-success" href="index.php">Quay về</a>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                    if(isset($_POST['btn_them'])){
                        include_once(__DIR__ . '/../../../dbconnect.php');
                        $httt_ten=$_POST['httt_ten'];
                        $sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES(N'{$httt_ten}');";
                        mysqli_query($conn, $sql);
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
</body>
</html>
