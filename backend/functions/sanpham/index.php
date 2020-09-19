<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng sản phẩm</title>
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
                <h1 class="text-center">Sản phẩm</h1>
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
                    <a href="create.php" class="btn btn-dark my-3"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
                </div>
                <table class="table table-hover table-striped text-center table-responsive-sm" id="tbl">
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
                                <td class="align-middle">
                                    <button class="btn btn-danger btnDelete" data-sp_ma="<?= $value['sp_ma'] ?>" data-sp_ten="<?= $value['sp_ten'] ?>" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    <a class="btn btn-success" href="edit.php?sp_ma=<?= $value['sp_ma']; ?>" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            $('.btnDelete').click(function(){
                var temp = $(this).data('sp_ten');
                swal({
                    title: "Bạn muốn xóa " + temp,
                    text: "dữ liệu sẽ không thể phục hồi sau khi xóa.",
                    icon: "warning",
                    buttons: ["Hủy","Xóa"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var sp_ma = $(this).data('sp_ma');
                        var url = "delete.php?sp_ma=" + sp_ma;
                        location.href = url;
                    } else {
                        swal({
                            title: "Đã hủy hành động xóa",
                            button: 'Đã hiểu',
                            icon: 'info',
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
