<!-- Trang index của Bảng hình thức thanh toán -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Backend | Chỉnh sửa bảng hình thức thanh toán</title>
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
    <?php include_once(__DIR__.'/../../layouts/style_data.php'); ?>
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
                <h1 class="text-center">DELETE | EDIT</h1>
                    <?php
                        include_once(__DIR__ . '/../../../dbconnect.php');

                        $sql = " SELECT httt_ma,httt_ten FROM hinhthucthanhtoan;";
                        $result = mysqli_query($conn, $sql);
                        $data = [];
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $data[] = array(
                                'httt_ma' => $row['httt_ma'],
                                'httt_ten' => $row['httt_ten'],
                            );
                        }

                    ?>
                    <div class="text-center">
                        <a href="create.php" class="btn btn-dark my-3">Add new</a>
                    </div>
                    <table class="mx-auto table table-hover table-striped" name="tbl" id="tbl">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Mã Hình thức Thanh toán</th>
                                <th>Tên Hình thức Thanh toán</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                            <?php foreach($data as $httt): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $httt['httt_ma']; ?></td>
                                <td class="font-weight-bold"><?= $httt['httt_ten']; ?></td>
                                <td>
                                    <button class="btn btn-danger btnDelete" data-httt_ma="<?= $httt['httt_ma'] ?>">Delete</button>
                                    <a class="btn btn-success" href="edit.php?httt_ma=<?= $httt['httt_ma']; ?>">Edit</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
        </div>
    </div>
    <!-- End container -->
    <!-- Footer -->
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->
    <?php include_once(__DIR__.'/../../layouts/scripts.php'); ?>
    <?php include_once(__DIR__.'/../../layouts/script_data.php'); ?>
    <script src="/backend/assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.btnDelete').click(function(){
                swal({
                    title: "Bạn có chắc chắn muốn xóa?",
                    text: "dữ liệu sẽ không thể phục hồi sau khi xóa.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        debugger;
                        var httt_ma = $(this).data('httt_ma');
                        var url = "delete.php?httt_ma=" + httt_ma;
                        location.href = url;
                    } else {
                    swal("Hủy hành động", "Hành động xóa đã bị hủy", "info")
                    }
                });
            });
            $('#tbl').DataTable({
                // dom: 'Blfrtip',

                dom: "<'row'<'col-md-12 text-center'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
</body>
</html>
