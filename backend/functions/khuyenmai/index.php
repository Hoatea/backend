<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng khuyến mãi</title>
    <!-- Chèn các file css -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
    <?php include_once(__DIR__.'/../../layouts/style_data.php'); ?>
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
                <h1 class="text-center">Bảng khuyến mãi</h1>
                <?php 
                    include_once(__DIR__ . '/../../../dbconnect.php'); 
                    $sql = <<<EOT
                        SELECT km_ma, km_ten, kh_noidung, kh_tungay, km_denngay
                        FROM khuyenmai;
EOT;
                    $result = mysqli_query($conn, $sql);
                    $data = [];
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $data[] = array(
                            'km_ma' => $row['km_ma'],
                            'km_ten' => $row['km_ten'],
                            'kh_noidung' => $row['kh_noidung'],
                            'kh_tungay' => date('d/m/Y',strtotime($row['kh_tungay'])),
                            'km_denngay' => date('d/m/Y',strtotime($row['km_denngay'])),
                        );
                    }
                ?>
                <div class="text-center">
                    <a href="create.php" class="btn btn-dark m-3">Thêm mới</a>
                </div>
                <table class="mx-auto table table-hover table-striped text-center" id="tbl">
                    <thead class="thead-dark">
                        <tr>
                            <th>Mã khuyến mãi</th>
                            <th>Tên khuyến mãi</th>
                            <th>Nội dung khuyến mãi</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $value):?>
                            <tr>
                                <td><?= $value['km_ma'] ?></td>
                                <td><?= $value['km_ten'] ?></td>
                                <td><?= $value['kh_noidung'] ?></td>
                                <td><?= $value['kh_tungay'] ?></td>
                                <td><?= $value['km_denngay'] ?></td>
                                <td>
                                    <button class="btn btn-danger btnDelete" data-km_ma="<?= $value['km_ma'] ?>">Xóa</button>
                                    <a class="btn btn-success" href="edit.php?km_ma=<?=$value['km_ma']?>">Sửa</a>
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
    <?php include_once(__DIR__.'/../../layouts/partials/footer.php'); ?>
    <!-- End footer -->
    <!-- Chèn các file js -->
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
                    buttons: ["Hủy", "Xóa"],
                    dangerMode: true,
                    
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var km_ma = $(this).data('km_ma');
                        var url = "delete.php?km_ma=" + km_ma;
                        location.href = url;
                    } else {
                        swal({
                            title: "Hủy hành động",
                            text: "Hành động xóa đã bị hủy",
                            icon: "info",
                            button: "Xong"
                        });
                    }
                });
            });
            var table = $('#tbl').DataTable({
                dom: "<'row'<'col-md-12 text-center'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [
                    'copy', 'excel', 'pdf'
                ],
                language: {
                    "url": "../../../assets/vendor/DataTables/Vietnamese.json",
                    buttons: {
                        "copy": "Sao chép",
                        "excel": "Xuất ra file Excel",
                        "pdf": "Xuất ra file PDF",
                    }
                }
            });
        });
    </script>
</body>
</html>
