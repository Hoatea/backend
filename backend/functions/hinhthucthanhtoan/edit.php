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
                    $httt_ma = $_GET['httt_ma'];
                    $sql = " SELECT httt_ma,httt_ten FROM hinhthucthanhtoan WHERE httt_ma = $httt_ma;";
                    $result = mysqli_query($conn, $sql);
                    $data = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $data = array(
                            'httt_ma' => $row['httt_ma'],
                            'httt_ten' => $row['httt_ten'],
                        );
                    }
                ?>
                <form action="" method="POST" name="frm_insert" id="frm_insert">
                    <table class="mx-auto">
                        <tr>
                            <td>Tên phương thức thanh toán : </td>
                            <td><input type="text" name="httt_ten" id="httt_ten" value="<?= $data['httt_ten'] ?>" autofocus /></td>
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
                        $httt_ten=$_POST['httt_ten'];
                        $sql = "UPDATE hinhthucthanhtoan SET httt_ten=N'$httt_ten' WHERE httt_ma=$httt_ma;";
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
