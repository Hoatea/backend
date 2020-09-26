<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng sản phẩm</title>
    <!-- Chèn các file css -->
    <?php include_once(__DIR__ . '/../../layouts/styles.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/style_data.php'); ?>
    <style>
        #load {
            position: absolute;
            z-index: 100;
            background-color: white;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #load div{
            height: 3em;
            width: 3em;
        }
    </style>
</head>

<body>
    <div id="load">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- End header -->
    <div class="container-fluid my-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2">
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            </div>
            <!-- End sidebar -->
            <!-- Content -->
            <div class="col-md-10">
                <h1 class="text-center">Bảng ảnh sản phẩm</h1>
                <?php
                include_once(__DIR__ . '/../../../dbconnect.php');
                // 2. Chuẩn bị câu truy vấn $sql
                // Sử dụng HEREDOC của PHP để tạo câu truy vấn SQL với dạng dễ đọc, thân thiện với việc bảo trì code
                $sql = <<<EOT
                    SELECT *
                    FROM `hinhsanpham` hsp
                    JOIN `sanpham` sp on hsp.sp_ma = sp.sp_ma
EOT;
                // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                $result = mysqli_query($conn, $sql);
                // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                $data = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    // Sử dụng hàm sprintf() để chuẩn bị mẫu câu với các giá trị truyền vào tương ứng từng vị trí placeholder
                    $sp_tomtat = sprintf(
                        "Sản phẩm %s, giá: %s",
                        $row['sp_ten'],
                        number_format($row['sp_gia'], 2, ".", ",") . ' vnđ'
                    );
                    $data[] = array(
                        'hsp_ma' => $row['hsp_ma'],
                        'hsp_tentaptin' => $row['hsp_tentaptin'],
                        'sp_tomtat' => $sp_tomtat,
                    );
                }
                ?>
                <div class="text-center">
                    <a href="create.php" class="btn btn-dark m-3">Thêm mới</a>
                </div>
                <table class="mx-auto table table-hover table-striped text-center" id="tbl">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Mã Hình Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $value) : ?>
                            <tr>
                                <td class="align-middle"><?= $value['hsp_ma'] ?></td>
                                <td>
                                    <img src="/backend/assets/uploads/products/<?= $value['hsp_tentaptin'] ?>" alt="<?= $value['hsp_tentaptin'] ?>" class="img-fluid" width="100px">
                                </td>
                                <td class="align-middle"><?= $value['sp_tomtat'] ?></td>
                                <td class="align-middle">
                                    <button class="btn btn-danger btnDelete" data-hsp_ma="<?= $value['hsp_ma'] ?>">Xóa</button>
                                    <a class="btn btn-success" href="edit.php?hsp_ma=<?= $value['hsp_ma'] ?>">Sửa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- End content -->
        </div>
    </div>
    <!-- Footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->
    <!-- Chèn các file js -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <?php include_once(__DIR__ . '/../../layouts/script_data.php'); ?>
    <script src="/backend/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        $(window).on("load", function(){
            $("#load").fadeOut("slow");
        });
        $(document).ready(function() {
            $('.btnDelete').click(function() {
                swal({
                        title: "Bạn có chắc chắn muốn xóa?",
                        text: "dữ liệu sẽ không thể phục hồi sau khi xóa.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) { // Nếu đồng ý xóa

                            // 2. Lấy giá trị của thuộc tính (custom attribute HTML) 'sp_ma'
                            // var sp_ma = $(this).attr('data-sp_ma');
                            var hsp_ma = $(this).data('hsp_ma');
                            var url = "delete.php?hsp_ma=" + hsp_ma;

                            // Điều hướng qua trang xóa với REQUEST GET, có tham số sp_ma=...
                            location.href = url;
                        } else {
                            swal("Hủy hành động", "Hành động xóa đã bị hủy", "info")
                        }
                    });
            });
            $('#tbl').DataTable({
                dom: "<'row'<'col-md-12 text-center'B>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
</body>

</html>