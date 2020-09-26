<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Thêm ảnh sản phẩm</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
</head>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-0">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <!-- End sidebar -->
            <!-- Content -->
            <div class="col-md-9 col-lg-10 my-5">
                <h1 class="text-center">Thêm ảnh sản phẩm</h1>
                <div class="container py-sm-0">
                    <div class="row">
                        <div class="col-md-12 shadow-lg py-3">
                            <?php
                            include_once(__DIR__ . '/../../../dbconnect.php');
                            $sqlSP = "select * from `sanpham`";
                            $resultSP = mysqli_query($conn, $sqlSP);
                            $dataSP = [];
                            while ($rowSP = mysqli_fetch_array($resultSP, MYSQLI_ASSOC)) {
                                $sp_tomtat = sprintf(
                                    "Sản phẩm %s, giá: %s",
                                    $rowSP['sp_ten'],
                                    number_format($rowSP['sp_gia'], 2, ".", ",") . ' vnđ'
                                );

                                $dataSP[] = array(
                                    'sp_ma' => $rowSP['sp_ma'],
                                    'sp_tomtat' => $sp_tomtat
                                );
                            }
                            ?>
                            <form action="" name="frm_insert" id="frm_insert" method="post" enctype="multipart/form-data">
                                <div class="form-group form-row">
                                    <label for="sp_ma" class="col-form-label col-lg-2">Chọn sản phẩm : </label>
                                    <select name="sp_ma" id="sp_ma" class="form-control col-lg-10">
                                        <option value=""></option>
                                        <?php foreach ($dataSP as $sp) : ?>
                                            <option value="<?= $sp['sp_ma'] ?>"><?= $sp['sp_tomtat'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="hsp_tentaptin">Tập tin ảnh : </label>
                                    <div class="py-3">
                                        <img src="/backend/assets/shared/img/img.png" alt="ảnh mẫu" height="200" id="preview-img">
                                    </div>
                                    <input type="file" class="form-control" id="hsp_tentaptin" name="hsp_tentaptin">
                                </div>
                                <div class="form-group text-center">
                                    <input id="btn_insert" type="submit" value="Thêm mới" name="btn_insert" class="btn btn-dark">
                                    <a href="index.php" class="btn btn-dark">Trở về</a>
                                </div>
                            </form>
                            <?php
                            if (isset($_POST['btn_insert'])) {
                                $sp_ma = $_POST['sp_ma'];
                                if (isset($_FILES['hsp_tentaptin'])) {
                                    $upload_dir = "./../../../assets/uploads/products/";
                                    if ($_FILES['hsp_tentaptin']['error'] > 0) {
                                        echo 'File Upload Bị Lỗi';
                                        die;
                                    } else {
                                        $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                                        $tentaptin = date('YmdHis') . '_' . $hsp_tentaptin;
                                        move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $tentaptin);
                                    }
                                    $sql = "INSERT INTO `hinhsanpham` (hsp_tentaptin, sp_ma) VALUES ('$tentaptin', $sp_ma);";
                                    mysqli_query($conn, $sql);
                                    mysqli_close($conn);
                                    echo "<script>window.location='index.php'</script>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End content -->
        </div>
    </div>
    <!-- Footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script src="/backend/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
        const reader = new FileReader();
        const fileInput = document.getElementById("hsp_tentaptin");
        const img = document.getElementById("preview-img");
        reader.onload = e => {
            img.src = e.target.result;
        }
        fileInput.addEventListener('change', e => {
            const f = e.target.files[0];
            reader.readAsDataURL(f);
        })
    </script>
</body>

</html>