<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng sản phẩm</title>
    <!-- Chèn các file css -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
    <link rel="stylesheet" href="/backend/assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="/backend/assets/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css">

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
                <h1 class="text-center">Bảng sản phẩm</h1>
                <?php 
                    include_once(__DIR__ . '/../../../dbconnect.php'); 
                    $sql = <<<EOT
                        SELECT sp.*,
                            lsp.lsp_ten,
                            nsx.nsx_ten,
                            km.*
                        FROM sanpham AS sp
                        JOIN loaisanpham AS lsp ON sp.lsp_ma = lsp.lsp_ma
                        JOIN nhasanxuat AS nsx ON sp.nsx_ma = nsx.nsx_ma
                        LEFT JOIN khuyenmai AS km ON sp.km_ma = km.km_ma
                        ORDER BY sp.sp_ma DESC;
EOT;
                    $result = mysqli_query($conn, $sql);
                    $data = [];
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $km_ten = $row['km_ten'];
                        $kh_noidung = $row['kh_noidung'];
                        $kh_tungay = date('d/m/Y',strtotime($row['kh_tungay']));
                        $km_denngay = date('d/m/Y',strtotime($row['km_denngay']));
                        $km_tomtat = '';
                        if(!empty($km_ten)){
                            $km_tomtat = sprintf("Tên: %s | Nội dung: %s | %s - %s", $km_ten, $kh_noidung, $kh_tungay, $km_denngay);
                        }
                        $giacu = '';
                        if(!empty($row['sp_giacu'])){
                            $giacu = number_format($row['sp_giacu'],0,'.',',');
                        }
                        $data[] = array(
                            'sp_ma' => $row['sp_ma'],
                            'sp_ten' => $row['sp_ten'],
                            'sp_gia' => number_format($row['sp_gia'],0,'.',','),
                            'sp_giacu' => $giacu,
                            'lsp_ten' => $row['lsp_ten'],
                            'nsx_ten' => $row['nsx_ten'],
                            'km_tomtat' => $km_tomtat,
                        );
                    }
                ?>
                <div class="text-center">
                    <a href="create.php" class="btn btn-dark m-3">Thêm mới</a>
                </div>
                <table class="mx-auto table table-hover table-responsive table-striped" id="tbl">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Giá cũ</th>
                            <th>Loại sản phẩm</th>
                            <th>Nhà sản xuất</th>
                            <th>Khuyến mãi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data as $value):?>
                            <tr>
                                <td><?= $value['sp_ma'] ?></td>
                                <td><?= $value['sp_ten'] ?></td>
                                <td class="text-right"><?= $value['sp_gia'] ?></td>
                                <td class="text-right"><?= $value['sp_giacu'] ?></td>
                                <td><?= $value['lsp_ten'] ?></td>
                                <td><?= $value['nsx_ten'] ?></td>
                                <td><?= $value['km_tomtat'] ?></td>
                                <td>
                                    <button class="btn btn-danger btnDelete" data-sp_ma="<?= $value['sp_ma'] ?>">Xóa</button>
                                    <a class="btn btn-success" href="edit.php?sp_ma=<?=$value['sp_ma']?>">Sửa</a>
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
    <script src="/backend/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/backend/assets/vendor/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script src="/backend/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/backend/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
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
                    if (willDelete) { // Nếu đồng ý xóa
                    
                        // 2. Lấy giá trị của thuộc tính (custom attribute HTML) 'sp_ma'
                        // var sp_ma = $(this).attr('data-sp_ma');
                        var sp_ma = $(this).data('sp_ma');
                        var url = "delete.php?sp_ma=" + sp_ma;
                        
                        // Điều hướng qua trang xóa với REQUEST GET, có tham số sp_ma=...
                        location.href = url;
                    } else {
                    swal("Hủy hành động", "Hành động xóa đã bị hủy", "info")
                    }
                });
            });
            $('#tbl').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
</body>
</html>
