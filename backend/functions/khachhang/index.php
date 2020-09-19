<!-- Trang index của Bảng hình thức thanh toán -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Backend | Bảng khách hàng</title>
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
    <?php include_once(__DIR__.'/../../layouts/style_data.php'); ?>
</head>
<body>
    <!-- Header -->
    <?php include_once(__DIR__.'/../../layouts/partials/header.php'); ?>
    <!-- End header -->
    <!-- Container -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-3 p-0">
                <?php include_once(__DIR__.'/../../layouts/partials/sidebar.php'); ?>
            </div>
            <div class="col-lg-10 col-md-9 my-5">
                <h1 class="text-center">Khách hàng</h1>
                    <?php
                        include_once(__DIR__ . '/../../../dbconnect.php');

                        $sql = "SELECT kh_tendangnhap, kh_matkhau, kh_ten, kh_gioitinh, kh_diachi, kh_dienthoai, kh_email, kh_ngaysinh, kh_thangsinh, kh_namsinh, kh_cmnd, kh_makichhoat, kh_trangthai, kh_quantri FROM khachhang;";
                        $result = mysqli_query($conn, $sql);
                        $data = [];
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $kh_ngaysinh = $row['kh_ngaysinh'];
                            $kh_thangsinh = $row['kh_thangsinh'];
                            $kh_namsinh = $row['kh_namsinh'];
                            if(!empty($kh_thangsinh)){
                                $kh_DoB = $kh_namsinh;
                                if(!empty($kh_thangsinh)){
                                    if(strlen($kh_thangsinh)<2)
                                        $kh_thangsinh='0'.$kh_thangsinh;
                                    $kh_DoB = $kh_thangsinh.'/'.$kh_DoB;
                                    if(!empty($kh_ngaysinh)){
                                        if(strlen($kh_ngaysinh)<2)
                                            $kh_ngaysinh='0'.$kh_ngaysinh;
                                        $kh_DoB = $kh_ngaysinh.'/'.$kh_DoB;
                                    }
                                }
                            }
                            $data[] = array(
                                'kh_tendangnhap' => $row['kh_tendangnhap'],
                                'kh_matkhau' => $row['kh_matkhau'],
                                'kh_ten' => $row['kh_ten'],
                                'kh_gioitinh' => $row['kh_gioitinh'],
                                'kh_diachi' => $row['kh_diachi'],
                                'kh_dienthoai' => $row['kh_dienthoai'],
                                'kh_email' => $row['kh_email'],
                                'kh_ngaysinh' => $kh_DoB,
                                'kh_cmnd' => $row['kh_cmnd'],
                                'kh_makichhoat' => $row['kh_makichhoat'],
                                'kh_trangthai' => $row['kh_trangthai'],
                                'kh_quantri' => $row['kh_quantri'],
                            );
                        }

                    ?>
                    <div class="text-center">
                        <a href="create.php" class="btn btn-dark my-3"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới</a>
                    </div>
                    <table class="table table-hover table-striped text-center table-responsive" name="tbl" id="tbl">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Tên đăng nhập</th>
                                <th>Mật khẩu</th>
                                <th>Tên</th>
                                <th>Giới tính</th>
                                <th>Địa chỉ</th>
                                <th>SĐT</th>
                                <th>Email</th>
                                <th>Ngày sinh</th>
                                <th>Quản trị</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1 ?>
                            <?php foreach($data as $kh): ?>
                            <tr>
                                <td class="align-middle"><?= $i++ ?></td>
                                <td class="align-middle"><?= $kh['kh_tendangnhap']; ?></td>
                                <td class="align-middle"><?= $kh['kh_matkhau']; ?></td>
                                <td class="font-weight-bold align-middle"><?= $kh['kh_ten']; ?></td>
                                <td class="align-middle">
                                    <?php
                                        if($kh['kh_gioitinh']==0) echo 'Nam';
                                        else echo 'Nữ';
                                    ?>
                                </td>
                                <td class="align-middle"><?= $kh['kh_diachi']; ?></td>
                                <td class="align-middle"><?= $kh['kh_dienthoai']; ?></td>
                                <td class="align-middle"><?= $kh['kh_email']; ?></td>
                                <td class="align-middle"><?= $kh['kh_ngaysinh']; ?></td>
                                <td class="align-middle">
                                    <?php
                                        if($kh['kh_quantri']){
                                            echo '<i class="fa fa-check text-success" aria-hidden="true"></i>';
                                        }
                                    ?>
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-danger btnDelete" data-kh_tendangnhap="<?= $kh['kh_tendangnhap']; ?>" data-kh_ten="<?= $kh['kh_ten']; ?>" data-toggle="tooltip" data-placement="top" title="Xóa"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    <a class="btn btn-success" href="edit.php?kh_tendangnhap=<?= $kh['kh_tendangnhap']; ?>" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            $('.btnDelete').click(function(){
                var temp = $(this).data('httt_ten');
                swal({
                    title: "Bạn muốn xóa " + temp,
                    text: "dữ liệu sẽ không thể phục hồi sau khi xóa.",
                    icon: "warning",
                    buttons: ["Hủy","Xóa"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var httt_ma = $(this).data('httt_ma');
                        var url = "delete.php?httt_ma=" + httt_ma;
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
