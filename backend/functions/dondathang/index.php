<!-- Trang index của Bảng hình thức thanh toán -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Backend | Bảng đơn đặt hàng</title>
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
            <div class="col-md-3 col-lg-2">
                <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
            </div>
            <div class="col-md-9 col-lg-10">
                <h1 class="text-center">Đơn đặt hàng</h1>
                    <?php
                        include_once(__DIR__ . '/../../../dbconnect.php');

                        $sql =  $sql = <<<EOT
                        SELECT 
                            ddh.dh_ma, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, httt.httt_ten, kh.kh_ten, kh.kh_dienthoai
                            , SUM(spddh.sp_dh_soluong * spddh.sp_dh_dongia) AS TongThanhTien
                        FROM `dondathang` ddh
                        JOIN `sanpham_dondathang` spddh ON ddh.dh_ma = spddh.dh_ma
                        JOIN `khachhang` kh ON ddh.kh_tendangnhap = kh.kh_tendangnhap
                        JOIN `hinhthucthanhtoan` httt ON ddh.httt_ma = httt.httt_ma
                        GROUP BY ddh.dh_ma, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, httt.httt_ten, kh.kh_ten, kh.kh_dienthoai
EOT;
                    
                        $result = mysqli_query($conn, $sql);
                        $data = [];
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $data[] = array(
                                'dh_ma' => $row['dh_ma'],
                                'dh_ngaylap' => date('d/m/Y', strtotime($row['dh_ngaylap'])),
                                'dh_ngaygiao' => empty($row['dh_ngaygiao']) ? '' : date('d/m/Y', strtotime($row['dh_ngaygiao'])),
                                'dh_noigiao' => $row['dh_noigiao'],
                                'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
                                'httt_ten' => $row['httt_ten'],
                                'kh_ten' => $row['kh_ten'],
                                'kh_dienthoai' => $row['kh_dienthoai'],
                                'TongThanhTien' => number_format($row['TongThanhTien'], 2, ".", ",") . ' vnđ',
                            );
                        }

                    ?>
                    <div class="text-center">
                        <a href="create.php" class="btn btn-dark my-3"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
                    </div>
                    <table class="table table-hover table-striped text-center table-responsive-sm" name="tbl" id="tbl">
                        <thead class="thead-dark">
                            <tr>
                                <th>Mã Đơn đặt hàng</th>
                                <th>Khách hàng</th>
                                <th>Ngày lập</th>
                                <th>Ngày giao</th>
                                <th>Nơi giao</th>
                                <th>Hình thức thanh toán</th>
                                <th>Tổng thành tiền</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $dondathang): ?>
                            <tr>
                                <td><?= $dondathang['dh_ma'] ?></td>
                                <td><b><?= $dondathang['kh_ten'] ?></b><br />(<?= $dondathang['kh_dienthoai'] ?>)</td>
                                <td><?= $dondathang['dh_ngaylap'] ?></td>
                                <td><?= $dondathang['dh_ngaygiao'] ?></td>
                                <td><?= $dondathang['dh_noigiao'] ?></td>
                                <td><span class="badge badge-primary"><?= $dondathang['httt_ten'] ?></span></td>
                                <td><?= $dondathang['TongThanhTien'] ?></td>
                                <td>
                                    <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                                        <span class="badge badge-danger">Chưa xử lý</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Đã giao hàng</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Đơn hàng nào chưa thanh toán thì được phép phép Xóa, Sửa -->
                                    <?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
                                        <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `dh_ma` -->
                                        <a href="edit.php?dh_ma=<?= $dondathang['dh_ma'] ?>" class="btn btn-warning">
                                            Sửa
                                        </a>
                                        <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `dh_ma` -->
                                        <button type="button" class="btn btn-danger btnDelete" data-dh_ma="<?= $dondathang['dh_ma'] ?>">
                                            Xóa
                                        </button>
                                    <?php else : ?>
                                        <!-- Đơn hàng nào đã thanh toán rồi thì không cho phép Xóa, Sửa (không hiển thị 2 nút này ra giao diện) 
                                        - Cho phép IN ấn ra giấy
                                        -->
                                        <!-- Nút in, bấm vào sẽ hiển thị mẫu in thông tin dựa vào khóa chính `dh_ma` -->
                                        <a href="print.php?dh_ma=<?= $dondathang['dh_ma'] ?>" class="btn btn-success">
                                            In
                                        </a>
                                    <?php endif; ?>
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
                    title: "Bạn muốn xóa",
                    text: "dữ liệu sẽ không thể phục hồi sau khi xóa.",
                    icon: "warning",
                    buttons: ["Hủy","Xóa"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var dh_ma = $(this).data('dh_ma');
                        var url = "delete.php?dh_ma=" + dh_ma;
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
            $('#tbl').DataTable({
                dom: "<'row'<'col-md-12 text-center'B>><'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-md-6'i><'col-md-6'p>>",
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
</body>
</html>
