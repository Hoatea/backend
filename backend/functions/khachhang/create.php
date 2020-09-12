<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng khách hàng</title>
    <!-- Chèn các file css -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>
    <!-- End header -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 p-0">
                <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
            </div>
            <!-- End sidebar -->
            <!-- Content -->
            <div class="col-md-10 my-5">
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
                <h1 class="text-center">Thêm mới khách hàng</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 shadow-lg py-3">
                            <form action="" name="frm_insert" id="frm_insert" method="post">
                                <!-- Tên đăng nhập -->
                                <div class="form-group">
                                    <label for="kh_tendangnhap">Tên đăng nhập : </label>
                                    <input type="text" class="form-control" id="kh_tendangnhap" name="kh_tendangnhap">
                                </div>
                                <!-- Mật khẩu -->
                                <div class="form-group">
                                    <label for="kh_matkhau">Mật khẩu : </label>
                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control" id="kh_matkhau" name="kh_matkhau">
                                        <div class="input-group-prepend" id="eye_pass" style="cursor:pointer;">
                                            <div class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Nhập lại mật khẩu -->
                                <div class="form-group">
                                    <label for="kh_matkhau_re">Nhập lại mật khẩu : </label>
                                    <div class="input-group mb-2">
                                        <input type="password" class="form-control" id="kh_matkhau_re" name="kh_matkhau_re">
                                        <div class="input-group-prepend" id="eye_pass_re" style="cursor:pointer;">
                                            <div class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tên -->
                                <div class="form-group">
                                    <label for="kh_ten">Tên : </label>
                                    <input type="text" class="form-control" id="kh_ten" name="kh_ten">
                                </div>
                                <!-- Giới tính -->
                                <div class="form-group row">
                                    <label class="col-lg-2">Giới tính : </label>
                                    <div class="col-lg-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kh_gioitinh" id="kh_gioitinh_nam" value="0" checked>
                                            <label class="form-check-label" for="kh_gioitinh_nam">
                                                Nam
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kh_gioitinh" id="kh_gioitinh_nu" value="1">
                                            <label class="form-check-label" for="kh_gioitinh_nu">
                                                Nữ
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- Địa chỉ -->
                                <div class="form-group">
                                    <label for="kh_diachi">Địa chỉ : </label>
                                    <input type="text" class="form-control" id="kh_diachi" name="kh_diachi">
                                </div>
                                <!-- Điện thoại -->
                                <div class="form-group">
                                    <label for="kh_dienthoai">Số điện thoại : </label>
                                    <input type="tel" class="form-control" id="kh_dienthoai" name="kh_dienthoai">
                                </div>
                                <!-- Email -->
                                <div class="form-group">
                                    <label for="kh_email">Email : </label>
                                    <input type="email" class="form-control" id="kh_email" name="kh_email">
                                </div>
                                <!-- Ngày sinh -->
                                <div class="form-group">
                                    <label for="kh_ngaysinh">Ngày sinh : </label>
                                    <input type="date" class="form-control" id="kh_ngaysinh" name="kh_ngaysinh">
                                </div>
                                <!-- CMND -->
                                <div class="form-group">
                                    <label for="kh_cmnd">CMND/CCCD/Số ĐDCD : </label>
                                    <input type="number" class="form-control" id="kh_cmnd" name="kh_cmnd">
                                </div>
                                <!-- Quản trị viên -->
                                <div class="form-group row">
                                    <label class="col-lg-2">Cấp quyền quản trị viên : </label>
                                    <div class="col-lg-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kh_quantri" id="kh_quantri_khong" value="0" checked>
                                            <label class="form-check-label" for="kh_quantri_khong">
                                                Không
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kh_quantri" id="kh_quantri_co" value="1">
                                            <label class="form-check-label" for="kh_quantri_co">
                                                Có
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <input id="btn_insert" type="submit" value="Thêm mới" name="btn_insert" class="btn btn-dark">
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
    <script src="/backend/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#eye_pass').click(function(){
                var temp = document.getElementById("eye_pass").innerHTML;
                if(temp.indexOf('slash')!=-1){
                    $('#kh_matkhau').attr('type','password');
                    document.getElementById("eye_pass").innerHTML='<div class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></div>';
                }
                else{
                    $('#kh_matkhau').attr('type','text');
                    document.getElementById("eye_pass").innerHTML='<div class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></div>';
                }
            });
            $('#eye_pass_re').click(function(){
                var temp = document.getElementById("eye_pass_re").innerHTML;
                if(temp.indexOf('slash')!=-1){
                    $('#kh_matkhau_re').attr('type','password');
                    document.getElementById("eye_pass_re").innerHTML='<div class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></div>';
                }
                else{
                    $('#kh_matkhau_re').attr('type','text');
                    document.getElementById("eye_pass_re").innerHTML='<div class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></div>';
                }
            });
            $('#frm_insert').validate({
                rules: {
                    kh_tendangnhap: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    kh_matkhau: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                    kh_matkhau_re: {
                        required: true,
                        equalTo: '#kh_matkhau',
                    },
                    kh_ten: {
                        required: true,
                    },
                    kh_diachi: {
                        required: true,
                    },
                    kh_dienthoai: {
                        required: true,
                    },
                    kh_email: {
                        required: true,
                    },
                    kh_ngaysinh: {
                        required: true,
                    },
                    kh_cmnd: {
                        required: true,
                    },
                },
                messages: {
                    kh_tendangnhap: {
                        required: 'Không được bỏ trống phần này',
                        minlength: 'Tên đăng nhập quá ngắn, tối thiểu phải 3 ký tự',
                        maxlength: 'Tên đăng nhập quá dài, tối đa chỉ 50 ký tự.',
                    },
                    kh_matkhau: {
                        required: 'Không được bỏ trống phần này',
                        minlength: 'Mật khẩu quá ngắn, tối thiểu phải 3 ký tự',
                        maxlength: 'Mật khẩu nhập quá dài, tối đa chỉ 50 ký tự.',
                    },
                    kh_matkhau_re: {
                        required: 'Không được bỏ trống phần này',
                        equalTo: 'Không khớp với mật khẩu',
                    },
                    kh_ten: {
                        required: 'Không được bỏ trống phần này',
                    },
                    kh_diachi: {
                        required: 'Không được bỏ trống phần này',
                    },
                    kh_dienthoai: {
                        required: 'Không được bỏ trống phần này',
                    },
                    kh_email: {
                        required: 'Không được bỏ trống phần này',
                    },
                    kh_ngaysinh: {
                        required: 'Không được bỏ trống phần này',
                    },
                    kh_cmnd: {
                        required: 'Không được bỏ trống phần này',
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
    </script>
</body>
</html>
