<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng hình sản phẩm</title>
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
            <div class="col-md-10">
                <?php
                    include_once(__DIR__.'/../../../dbconnect.php');
                    $sql_sp = "SELECT * FROM sanpham";
                    $result_sp = mysqli_query($conn, $sql_sp);
                    $data_sp = [];
                    while($row_sp = mysqli_fetch_array($result_sp, MYSQLI_ASSOC)){
                        $sp_tomtat = sprintf(
                            "Sản phẩm %s, giá: %s",
                            $row_sp['sp_ten'],
                            number_format($row_sp['sp_gia'], 2, ".", ",") . ' vnđ'
                        );
                        $data_sp[] = array(
                            'sp_ma' => $row_sp['sp_ma'],
                            'sp_tomtat' => $sp_tomtat,
                        );
                    }
                ?>
                <h1 class="text-center">UPLOAD hình sản phẩm</h1>
                <form action="" method="post" id="frmUploadAnd" name="frmUploadAnd" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="sp_ma">Sản phẩm : </label>
                        <select name="sp_ma" id="sp_ma" class="form-control">
                        <?php foreach($data_sp as $sp):?>
                            <option value="<?= $sp['sp_ma']?>"><?=$sp['sp_tomtat']?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hsp_tentaptin">Tập tin ảnh</label>
                        <div class="preview-img-container">
                            <img src="/backend/assets/shared/img/img.png" id="preview-img" width="200px" />
                        </div>
                        <input type="file" class="form-control" id="hsp_tentaptin" name="hsp_tentaptin">
                    </div>
                    <button class="btn btn-primary" name="btnSave">Lưu</button>
                    <a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Quay về</a>
                </form>
                <?php
                    if (isset($_POST['btnSave'])) {
                        $sp_ma = $_POST['sp_ma'];
                        if (isset($_FILES['hsp_tentaptin'])) {
                            $upload_dir = __DIR__ . "/../../../assets/uploads/";
                            $subdir = 'products/';
                            if ($_FILES['hsp_tentaptin']['error'] > 0) {
                                echo 'File Upload Bị Lỗi'; die;
                            } else {
                                $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                                $tentaptin = date('YmdHis') . '_' . $hsp_tentaptin;
                                move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $subdir . $tentaptin);
                                $sql = "INSERT INTO `hinhsanpham` (hsp_tentaptin, sp_ma) VALUES ('$tentaptin', $sp_ma);"; 
                                mysqli_query($conn, $sql); 
                                mysqli_close($conn);
                                // echo '<script>location.href = "index.php";</script>';
                            }
                        }
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
    <script>
        CKEDITOR.replace("sp_mota_chitiet");
    </script>
    <!-- Kiểm tra dữ liệu -->
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
