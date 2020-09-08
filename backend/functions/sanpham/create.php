<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng sản phẩm</title>
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
                    // Tim loai san pham
                    $sql_lsp = "SELECT lsp_ma, lsp_ten FROM loaisanpham";
                    $result_lsp = mysqli_query($conn, $sql_lsp);
                    $data_lsp = [];
                    while($row_lsp = mysqli_fetch_array($result_lsp, MYSQLI_ASSOC)){
                        $data_lsp[] = array(
                            'lsp_ma' => $row_lsp['lsp_ma'],
                            'lsp_ten' => $row_lsp['lsp_ten'],
                        );
                    }
                    // Tim nha san xuat
                    $sql_nsx = "SELECT nsx_ma, nsx_ten FROM nhasanxuat";
                    $result_nsx = mysqli_query($conn, $sql_nsx);
                    $data_nsx = [];
                    while($row_nsx = mysqli_fetch_array($result_nsx, MYSQLI_ASSOC)){
                        $data_nsx[] = array(
                            'nsx_ma' => $row_nsx['nsx_ma'],
                            'nsx_ten' => $row_nsx['nsx_ten'],
                        );
                    }
                    // Tim khuyen mai
                    $sql_km = "SELECT km_ma, km_ten FROM khuyenmai";
                    $result_km = mysqli_query($conn, $sql_km);
                    $data_km = [];
                    while($row_km = mysqli_fetch_array($result_km, MYSQLI_ASSOC)){
                        $data_km[] = array(
                            'km_ma' => $row_km['km_ma'],
                            'km_ten' => $row_km['km_ten'],
                        );
                    }
                ?>
                <h1 class="text-center">INSERT bảng sản phẩm</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 shadow-lg py-3">
                            <form action="" name="frm_insert" id="frm_insert" method="post">
                                <div class="form-group">
                                    <label for="sp_ten">Tên sản phẩm : </label>
                                    <input type="text" class="form-control" id="sp_ten" name="sp_ten">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sp_gia">Giá sản phẩm : </label>
                                        <input type="number" class="form-control" name="sp_gia" id="sp_gia">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sp_giacu">Giá cũ sản phẩm : </label>
                                        <input type="number" class="form-control" name="sp_giacu" id="sp_giacu">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sp_mota_ngan">Mô tả ngắn : </label>
                                    <input type="text" class="form-control" id="sp_mota_ngan" name="sp_mota_ngan">
                                </div>
                                <div class="form-group">
                                    <label for="sp_mota_chitiet">Mô tả chi tiết sản phẩm : </label>
                                    <textarea name="sp_mota_chitiet" id="sp_mota_chitiet" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="sp_soluong">Số lượng : </label>
                                        <input type="number" name="sp_soluong" id="sp_soluong" class="form-control" min="0">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="lsp_ma">Mã loại sản phẩm : </label>
                                        <select name="lsp_ma" id="lsp_ma" class="form-control">
                                            <?php foreach($data_lsp as $lsp): ?>
                                                <option value="<?= $lsp['lsp_ma'] ?>"><?= $lsp['lsp_ten'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="nsx_ma">Mã nhà sản xuất : </label>
                                        <select name="nsx_ma" id="nsx_ma" class="form-control">
                                            <?php foreach($data_nsx as $nsx): ?>
                                                <option value="<?= $nsx['nsx_ma'] ?>"><?= $nsx['nsx_ten'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="km_ma">Mã khuyến mãi : </label>
                                        <select name="km_ma" id="km_ma" class="form-control">
                                            <option value="" selected>Không áp dụng</option>
                                            <?php foreach($data_km as $km): ?>
                                                <option value="<?= $km['km_ma'] ?>"><?= $km['km_ten'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" value="Thêm mới" name="btn_insert" class="btn btn-dark">
                                    <a href="index.php" class="btn btn-dark">Trở về</a>
                                </div>
                            </form>
                            <?php
                                if(isset($_POST['btn_insert'])){
                                    include_once(__DIR__ . '/../../../dbconnect.php'); 
                                    $sp_ten = $_POST['sp_ten'];
                                    $sp_gia = $_POST['sp_gia'];
                                    $sp_giacu = $_POST['sp_giacu'];
                                    $sp_mota_ngan = $_POST['sp_mota_ngan'];
                                    $sp_mota_chitiet = $_POST['sp_mota_chitiet'];
                                    $sp_soluong = $_POST['sp_soluong'];
                                    $lsp_ma = $_POST['lsp_ma'];
                                    $nsx_ma = $_POST['nsx_ma'];
                                    $km_ma = $_POST['km_ma'];
                                    if(empty($km_ma)){
                                        $km_ma = 'NULL';
                                    }
                                    if(empty($sp_giacu)){
                                        $sp_giacu = 'NULL';
                                    }
                                    $sql = "INSERT INTO sanpham (sp_ten, sp_gia, sp_giacu, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, sp_soluong, lsp_ma, nsx_ma, km_ma) VALUES (N'$sp_ten', $sp_gia, $sp_giacu, N'$sp_mota_ngan', N'$sp_mota_chitiet', NOW(), $sp_soluong, $lsp_ma, $nsx_ma, $km_ma);";
                                    mysqli_query($conn,$sql) or die("Thông báo");
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
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->
    <!-- Chèn các file js -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
    <script>
        CKEDITOR.replace("sp_mota_chitiet");
    </script>
    <!-- Kiểm tra dữ liệu -->
    <!-- <script>
        $(document).ready(function () {
            $('#frm_insert').validate({
                rules: {
                    sp_ten: {
                        required: true,
                        minlength: 3,
                        maxlength: 100,
                    },
                    sp_gia: {
                        required: true,
                        min: 0,
                    },
                    sp_giacu: {
                        min: 0,
                    },
                    sp_soluong: {
                        required: true,
                        min: 0,
                    },
                },
                messages: {
                    sp_ten: {
                        required: 'Tên sản phẩm không được để trống',
                        minlength: 'Tên sản phẩm phải có tối thiểu 3 ký tự',
                        maxlength: 'Tên sản phẩm không được có quá 100 ký tự',
                    },
                    sp_gia: {
                        required: 'Giá sản phẩm không được để trống',
                        min: 'Giá của sản phẩm không được âm',
                    },
                    sp_giacu: {
                        min: 'Giá cũ của sản phẩm không được âm',
                    },
                    sp_soluong: {
                        required: 'Số lượng sản phẩm không được để trống',
                        min: 'Số lượng của sản phẩm không được âm',
                    },
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                success: function(label, element) {},
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid"); 
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script> -->
</body>
</html>