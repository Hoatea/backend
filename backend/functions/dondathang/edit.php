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
            <div class="col-md-10">
                <h1 class="text-center">UPDATE</h1>
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
                    <div class="form-group row">
                        <label for="httt_ten" class="col-lg-2 col-md-6 col-form-label">Tên phương thức thanh toán : </label>
                        <div class="col-lg-10 col-md-6">
                            <input type="text" class="form-control" id="httt_ten" name="httt_ten" value="<?= $data['httt_ten'] ?>">
                        </div>
                    </div>
                    <div class="text-center">
                        <input class="btn btn-dark" type="submit" value="Sửa" name="btn_sua">
                        <a class="btn btn-dark" href="index.php">Quay về</a>
                    </div>
                </form>
                <?php
                    if(isset($_POST['btn_sua'])){
                        $httt_ten=$_POST['httt_ten'];
                        $errors = [];
                        //Kiểm tra rỗng
                        if(empty($httt_ten)){
                            $errors['httt_ten'][] = array(
                                'rule' => 'required',
                                'rule_value' => true,
                                'value' => $httt_ten,
                                'msg' => 'Tên hình thức thanh toán không được để trống'
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
                                    'msg' => 'Tên hình thức thanh toán phải chỉ chứa 50 ký tự'
                                );
                            }  
                        }
                    }
                ?>
                <?php if(isset($_POST['btn_sua'])&&!empty($errors)):?>
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
                <?php endif;?>
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
    <script>
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
                        minlength: "Tên hình thức thanh toán phải có ít nhất 3 ký tự.",
                        maxlength: "Tên hình thức thanh toán chỉ có nhiều nhất 50 ký tự.",
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
