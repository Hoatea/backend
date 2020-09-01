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
                <?php
                    include_once(__DIR__ . '/../../../dbconnect.php');
                    $nsx_ma = $_GET['nsx_ma'];
                    $sql = "SELECT nsx_ma, nsx_ten FROM nhasanxuat WHERE nsx_ma = {$nsx_ma};";
                    $result = mysqli_query($conn, $sql);
                    $data = [];
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        $data = array(
                            'nsx_ma' => $row['nsx_ma'],
                            'nsx_ten' => $row['nsx_ten'],
                        );
                    }
                ?>
                <h1>UPDATE bảng nhà sản xuất</h1>
                <form action="" method="POST" name="frm_capnhat" id="frm_capnhat">
                    <table class="mx-auto">
                        <tr>
                            <td>Tên nhà sản xuất : </td>
                            <td><input type="text" name="nsx_ten" id="nsx_ten" value="<?=$data['nsx_ten']?>"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="btn_update" id="btn_update" class="btn btn-success" value="Sửa"/>
                                <a href="index.php" class="btn btn-success">Trở về</a>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                    if(isset($_POST['btn_update'])){
                        $nsx_ten = $_POST['nsx_ten'];
                        $sql = "UPDATE nhasanxuat SET nsx_ten =N'$nsx_ten' WHERE nsx_ma = $nsx_ma;";
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