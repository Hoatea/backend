<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng khuyến mãi</title>
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
                ?>
                <h1 class="text-center">INSERT bảng khuyến mãi</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 shadow-lg py-3">
                            <form action="" name="frm_insert" id="frm_insert" method="post">
                                <div class="form-group">
                                    <label for="km_ma">Mã khuyến mãi : </label>
                                    <input type="number" class="form-control" id="km_ma" name="km_ma" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="km_ten">Tên khuyến mãi : </label>
                                    <input type="text" class="form-control" id="km_ten" name="km_ten">
                                </div>
                                <div class="form-group">
                                    <label for="kh_noidung">Nội dung khuyến mãi : </label>
                                    <textarea name="kh_noidung" id="kh_noidung" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="kh_tungay">Ngày bắt đầu : </label>
                                        <input type="date" name="kh_tungay" id="kh_tungay" class="form-control" min="0">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="km_denngay">Ngày kết thúc : </label>
                                        <input type="date" name="km_denngay" id="km_denngay" class="form-control" min="0">
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <input id="btn_insert" type="submit" value="Thêm mới" name="btn_insert" class="btn btn-dark">
                                    <a href="index.php" class="btn btn-dark">Trở về</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    if(isset($_POST['btn_insert'])){
                        include_once(__DIR__ . '/../../../dbconnect.php');
                        $km_ma = $_POST['km_ma'];
                        $km_ten = $_POST['km_ten'];
                        $kh_noidung = $_POST['kh_noidung'];
                        $kh_tungay = $_POST['kh_tungay'];
                        $km_denngay = $_POST['km_denngay'];
                        $errors = [];
                        // Kiểm tra mã khuyến mãi
                        // Kiểm tra rỗng
                        if(empty($km_ma)){
                            $errors['km_ma'][] = array(
                                'rule' => 'required',
                                'rule_value' => true,
                                'value' => $km_ma,
                                'msg' => 'Vui lòng nhập mã khuyến mãi',
                            );
                        } else {
                            //Kiểm tra maxLength
                            if(strlen($km_ma)>11){
                                $errors['km_ma'][] = array(
                                    'rule' => 'maxlength',
                                    'rule_value' => 11,
                                    'value' => $km_ma,
                                    'msg' => 'Mã khuyến mãi chỉ chứa tối đa 11 chữ số',
                                ); 
                            }
                            //Kiểm tra nhỏ hơn 1
                            if($km_ma < 1){
                                $errors['km_ma'][] = array(
                                    'rule' => 'min',
                                    'rule_value' => 1,
                                    'value' => $km_ma,
                                    'msg' => 'Mã khuyến mãi phải bắt đầu từ 1',
                                );
                            }
                        }
                        //Kiểm tra tên khuyến mãi
                        //kiểm tra rỗng
                        if(empty($km_ten)){
                            $errors['km_ten'][] = array(
                                'rule' => 'required',
                                'rule_value' => true,
                                'value' => $km_ten,
                                'msg' => 'Vui lòng nhập tên khuyến mãi',
                            );
                        } else {
                            if(strlen($km_ten)<3){
                                $errors['km_ten'][] = array(
                                    'rule' => 'minlength',
                                    'rule_value' => 3,
                                    'value' => $km_ten,
                                    'msg' => 'Tên khuyến mãi phải có ít nhất 3 ký tự',
                                );
                            }
                            if(strlen($km_ten)>255){
                                $errors['km_ten'][] = array(
                                    'rule' => 'maxlength',
                                    'rule_value' => 255,
                                    'value' => $km_ten,
                                    'msg' => 'Tên khuyến mãi chỉ chứ tối đa 255 ký tự',
                                );
                            }
                        }
                        //Kiểm tra nội dung khuyến mãi
                        //kiểm tra rỗng
                        if(empty($kh_noidung)){
                            $errors['kh_noidung'][] = array(
                                'rule' => 'required',
                                'rule_value' => true,
                                'value' => $km_ten,
                                'msg' => 'Vui lòng nhập nội dung khuyến mãi',
                            );
                        }
                        //Kiểm tra nội dung khuyến mãi
                        //kiểm tra rỗng
                        if(empty($kh_tungay)){
                            $errors['kh_tungay'][] = array(
                                'rule' => 'required',
                                'rule_value' => true,
                                'value' => $kh_tungay,
                                'msg' => 'Vui lòng nhập ngày bắt đầu',
                            );
                        }
                        //Kiểm tra nội dung khuyến mãi
                        //kiểm tra rỗng
                        if(empty($km_denngay)){
                            $errors['km_denngay'][] = array(
                                'rule' => 'required',
                                'rule_value' => true,
                                'value' => $km_denngay,
                                'msg' => 'Vui lòng nhập ngày kết thúc',
                            );
                        }
                        if(strtotime($km_denngay)<strtotime($kh_tungay)){
                            $errors['ngay'][] = array(
                                'rule' => 'date',
                                'rule_value' => true,
                                'value' => $km_ten,
                                'msg' => 'Ngày kết thúc phải sau ngày bắt đầu',
                            );
                        }
                    }
                ?>
                <?php if(isset($_POST['btn_insert'])&&!empty($errors)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-3 shadow-lg" role="alert">
                        <ul>
                            <?php foreach($errors as $field) : ?>
                                <?php foreach($field as $rules) : ?>
                                    <li><?= $rules['msg']?></li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php
                    if(isset($_POST['btn_insert']) && (!isset($errors) || (empty($errors)))){
                        $sql = "INSERT INTO khuyenmai(km_ma, km_ten, kh_noidung, kh_tungay, km_denngay) VALUES ($km_ma, N'$km_ten', N'$kh_noidung', '$kh_tungay', '$km_denngay');";
                        mysqli_query($conn, $sql);
                        mysqli_close($conn);
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
    <!-- Kiểm tra dữ liệu -->
    <script src="/backend/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#frm_insert').validate({
                rules: {
                    km_ma: {
                        required: true,
                        maxlength: 11,
                        min: 1,
                    },
                    km_ten: {
                        required: true,
                        minlength: 3,
                        maxlength: 255,
                    },
                    kh_noidung: {
                        required: true,
                    },
                    kh_tungay: {
                        required: true,
                    },
                    km_denngay: {
                        required: true,
                    },
                },
                messages: {
                    km_ma: {
                        required: "Bạn phải nhập vào trường này",
                        maxlength: "Chỉ nhập tối đa 11 ký tự",
                        min: "Mã khuyến mãi phải lớn hơn 0",
                    },
                    km_ten: {
                        required: "Bạn phải nhập vào trường này",
                        minlength: "Nhập tối thiểu 3 ký tự",
                        maxlength: "Nhập tối đa 255 ký tự",
                    },
                    kh_noidung: {
                        required: "Bạn phải nhập vào trường này",
                    },
                    kh_tungay: {
                        required: "Bạn phải nhập vào trường này",
                    },
                    km_denngay: {
                        required: "Bạn phải nhập vào trường này",
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
