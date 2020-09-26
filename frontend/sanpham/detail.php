<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}
include_once(__DIR__ . '/../../dbconnect.php');
$sp_ma = $_GET['sp_ma'];
$sqlSelectSanPham = <<<EOT
            SELECT sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_mota_chitiet, sp.sp_soluong, lsp.lsp_ten
            FROM `sanpham` sp
            JOIN `loaisanpham` lsp ON sp.lsp_ma = lsp.lsp_ma
            WHERE sp.sp_ma = $sp_ma
EOT;
$resultSelectSanPham = mysqli_query($conn, $sqlSelectSanPham);
$sanphamRow;
while ($row = mysqli_fetch_array($resultSelectSanPham, MYSQLI_ASSOC)) {
    $sanphamRow = array(
        'sp_ma' => $row['sp_ma'],
        'sp_ten' => $row['sp_ten'],
        'sp_gia' => $row['sp_gia'],
        'sp_gia_formated' => number_format($row['sp_gia'], 2, ".", ",") . ' vnđ',
        'sp_giacu_formated' => number_format($row['sp_giacu'], 2, ".", ",") . ' vnđ',
        'sp_mota_ngan' => $row['sp_mota_ngan'],
        'sp_mota_chitiet' => $row['sp_mota_chitiet'],
        'sp_soluong' => $row['sp_soluong'],
        'lsp_ten' => $row['lsp_ten']
    );
}
$sqlSelect = <<<EOT
            SELECT hsp.hsp_ma, hsp.hsp_tentaptin
            FROM `hinhsanpham` hsp
            WHERE hsp.sp_ma = $sp_ma
EOT;
$result = mysqli_query($conn, $sqlSelect);
$danhsachhinhanh = [];
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $danhsachhinhanh[] = array(
        'hsp_ma' => $row['hsp_ma'],
        'hsp_tentaptin' => $row['hsp_tentaptin']
    );
}
$sanphamRow['danhsachhinhanh'] = $danhsachhinhanh;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Frontend | <?= $sanphamRow['sp_ten'] ?></title>
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>
</head>

<body>
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <div id="thongbao"></div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <?php
                if (count($sanphamRow['danhsachhinhanh']) > 0) {
                    $anh = $sanphamRow['danhsachhinhanh'][0]['hsp_tentaptin'];
                ?>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <img src="/backend/assets/uploads/products/<?= $anh ?>" alt="<?= $anh ?>" class="img-fluid">
                        </div>
                        <?php if (count($sanphamRow['danhsachhinhanh']) > 1) : ?>
                            <div class="col-md-12">
                                <div class="row row-cols-4">
                                    <?php for ($i = 1; $i < count($sanphamRow['danhsachhinhanh']); $i++) : ?>
                                        <div class="col">
                                            <img src="/backend/assets/uploads/products/<?= $sanphamRow['danhsachhinhanh'][$i]['hsp_tentaptin'] ?>" alt="<?= $sanphamRow['danhsachhinhanh'][$i]['hsp_tentaptin'] ?>" class="img-fluid">
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                } else { ?>
                    <img src="/backend/assets/shared/img/img.png" width="100%" alt="ảnh tạm">
                <?php } ?>
            </div>
            <div class="col-md-6">
                <h2 class="text-danger">Tên sản phẩm: <?= $sanphamRow['sp_ten'] ?></h2>
                <h3>Giá: <?= $sanphamRow['sp_gia_formated'] ?></h3>
                <h3>Giá: <s><?= $sanphamRow['sp_giacu_formated'] ?></s></h3>
                <p><?= $sanphamRow['sp_mota_ngan'] ?></p>
                <form name="frmsanphamchitiet" id="frmsanphamchitiet" method="post" action="">
                    <?php
                    $hinhsanphamdautien = empty($sanphamRow['danhsachhinhanh'][0]) ? '' : $sanphamRow['danhsachhinhanh'][0];
                    ?>
                    <input type="hidden" name="sp_ma" id="sp_ma" value="<?= $sanphamRow['sp_ma'] ?>" />
                    <input type="hidden" name="sp_ten" id="sp_ten" value="<?= $sanphamRow['sp_ten'] ?>" />
                    <input type="hidden" name="sp_gia" id="sp_gia" value="<?= $sanphamRow['sp_gia'] ?>" />
                    <input type="hidden" name="hinhdaidien" id="hinhdaidien" value="<?= empty($hinhsanphamdautien) ? '' : $hinhsanphamdautien['hsp_tentaptin'] ?>" />
                    <div class="form-group">
                        <label for="soluong">Số lượng đặt mua:</label>
                        <input type="number" class="form-control" id="soluong" name="soluong">
                    </div>
                    <div class="text-center">
                        <a class="btn btn-dark" id="btnThemVaoGioHang">Thêm vào giỏ hàng</a>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <h1>Mô tả</h1>
                <p><?= $sanphamRow['sp_mota_chitiet'] ?></p>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $('#btnThemVaoGioHang').click(function(event) {
            var dulieugoi = {
                sp_ma: $('#sp_ma').val(),
                sp_ten: $('#sp_ten').val(),
                sp_gia: $('#sp_gia').val(),
                hinhdaidien: $('#hinhdaidien').val(),
                soluong: $('#soluong').val(),
            };
            $.ajax({
                url: '/backend/frontend/api/giohang-themsanpham.php',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: false,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Đã thêm vào giỏ hàng'
                    })
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: false,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'error',
                        title: 'Không thể xử lý'
                    })
                }
            });
        });
    </script>
</body>

</html>
