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
            <div class="col-md-10">
                <h1>INSERT</h1>
                <form action="" method="POST" name="frm_insert" id="frm_insert">
                    <div class="form-group">
                        <label for="httt_ten">Tên phương thức thanh toán : </label>
                        <input type="text" class="form-control" id="httt_ten" name="httt_ten">
                    </div>
                    <input class="btn btn-success" type="submit" value="Thêm" name="btn_them">
                    <a class="btn btn-success" href="index.php">Quay về</a>
                </form>
                <?php
                    if(isset($_POST['btn_them'])){
                        include_once(__DIR__ . '/../../../dbconnect.php');
                        $httt_ten=$_POST['httt_ten'];
                        $errors = [];
                        //kiem tra rong
                        if(empty($httt_ten)){
                            $errors['httt_ten'][] = array(
                                'rule' => 'required',
                                'rule_value' => true,
                                'value' => $httt_ten,
                                'msg' => 'Vui lòng nhập tên hình thức thanh toán'
                            );
                        } else {
                            if(strlen($httt_ten)<3){
                                $errors['httt_ten'][] = array(
                                    'rule' => 'minlength',
                                    'rule_value' => 3,
                                    'value' => $httt_ten,
                                    'msg' => 'Tên hình thức thanh toán phải có ít nhất 3 ký tự'
                                );
                            }
                            if(strlen($httt_ten)>50){
                                $errors['httt_ten'][] = array(
                                    'rule' => 'maxlength',
                                    'rule_value' => 50,
                                    'value' => $httt_ten,
                                    'msg' => 'Tên hình thức thanh toán không được vượt quá 50 ký tự'
                                );
                            }
                        }
                    }
                ?>
                <?php if(isset($_POST['btn_them'])&&!empty($errors)) : ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
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
                    if(isset($_POST['btn_them']) && (!isset($errors) || (empty($errors)))){
                        $sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES(N'{$httt_ten}');";
                        mysqli_query($conn, $sql);
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
    <!-- <script>
        $(document).ready(function(){
            $('#frm_insert').validate({
                rules: {
                    httt_ten: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                },
                messages: {
                    httt_ten: {
                        required: "Nhập tên hình thức thanh toán.",
                        minlength: "Tên hình thức thanh toán phải có ít nhất 3 ký tự",
                        maxlength: "Tên hình thức thanh toán chỉ có nhiều nhất 50 ký tự",
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
