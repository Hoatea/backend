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
                <h1 class=" text-center">INSERT</h1>
                <form action="" method="POST" name="frm_insert" id="frm_insert">
                    <div class="form-group">
                        <label for="lsp_ten">Tên loại sản phẩm : </label>
                        <input class="form-control" type="text" name="lsp_ten" id="lsp_ten">
                    </div>
                    <div class="form-group">
                        <label for="lsp_mota">Mô tả : </label>
                        <textarea class="form-control" name="lsp_mota" id="lsp_mota" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <input class="btn btn-dark" type="submit" value="Thêm" name="btn_them">
                        <a class="btn btn-dark" href="index.php">Quay về</a>
                    </div>
                </form>
                <?php
                    if(isset($_POST['btn_them'])){
                        include_once(__DIR__ . '/../../../dbconnect.php');
                        $lsp_ten=$_POST['lsp_ten'];
                        $lsp_mota=$_POST['lsp_mota'];
                        $sql = "INSERT INTO `loaisanpham`(lsp_ten, lsp_mota) VALUES(N'{$lsp_ten}', N'{$lsp_mota}');";
                        mysqli_query($conn, $sql);
                    }
                ?>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
    <script>
        CKEDITOR.replace( 'lsp_mota' );
    </script>
    <script>
        $(document).ready(function(){
            $('#frm_insert').validate({
                rules: {
                    lsp_ten: {
                        required: true,
                        minlength: 3,
                        maxlength: 50,
                    },
                }, 
                messages: {
                    lsp_ten: {
                        required: "Nhập tên loại sản phẩm",
                        minlenght: "Tên loại sản phẩm phải có ít nhất 3 ký tự",
                        maxlenght: "Tên loại sản phẩm chỉ có tối đa 50 ký tự",
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
