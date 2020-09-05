<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng nhà sản xuất</title>
    <!-- Chèn các file css -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>
    <!-- End header -->
    <div class="container-fluid my-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2">
                <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
            </div>
            <!-- End sidebar -->
            <!-- Content -->
            <div class="col-md-10 text-center">
                <h1>Thêm nhà sản xuất</h1>
                <form action="" method="POST" name="frm_them" id="frm_them">
                    <table class="mx-auto">
                        <tr>
                            <td>Tên nhà sản xuất : </td>
                            <td><input type="text" name="nsx_ten" id="nsx_ten" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="btn_them" id="btn_them" class="btn btn-success" value="Thêm"/>
                                <a href="index.php" class="btn btn-success">Trở về</a>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                    if(isset($_POST['btn_them'])){
                        include_once(__DIR__ . '/../../../dbconnect.php');
                        $nsx_ten = $_POST['nsx_ten'];
                        $sql="INSERT INTO nhasanxuat(nsx_ten) VALUES (N'{$nsx_ten}');";
                        mysqli_query($conn, $sql);
                    }
                ?>
            </div>
            <!-- End content -->
        </div>
    </div>
    <!-- Footer -->
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->
    <!-- Chèn các file js -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
</body>
</html>