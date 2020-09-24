<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Frontend</title>
    <?php include_once(__DIR__.'/../layouts/styles.php'); ?>
</head>
<body>
    <?php include_once(__DIR__.'/../layouts/partials/header.php'); ?>
    <main role="main" class="mb-2">
    <div id="thongbao"></div>
        <?php
            // Truy vấn database
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__ . '/../../dbconnect.php');

        /* --- 
        --- 2.Truy vấn dữ liệu Sản phẩm 
        --- Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
        --- 
        */
        $sp_ma = $_GET['sp_ma'];
        $sqlSelectSanPham = <<<EOT
            SELECT sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_mota_chitiet, sp.sp_soluong, lsp.lsp_ten
            FROM `sanpham` sp
            JOIN `loaisanpham` lsp ON sp.lsp_ma = lsp.lsp_ma
            WHERE sp.sp_ma = $sp_ma
EOT;

        // Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record 
        $resultSelectSanPham = mysqli_query($conn, $sqlSelectSanPham);

        // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
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
        /* --- End Truy vấn dữ liệu Sản phẩm --- */

        /* --- 
        --- 3.Truy vấn dữ liệu Hình ảnh Sản phẩm 
        --- 
        */
        $sqlSelect = <<<EOT
            SELECT hsp.hsp_ma, hsp.hsp_tentaptin
            FROM `hinhsanpham` hsp
            WHERE hsp.sp_ma = $sp_ma;
EOT;

        // Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record 
        $result = mysqli_query($conn, $sqlSelect);

        // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
        $danhsachhinhanh = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $danhsachhinhanh[] = array(
                'hsp_ma' => $row['hsp_ma'],
                'hsp_tentaptin' => $row['hsp_tentaptin']
            );
        }
        /* --- End Truy vấn dữ liệu Hình ảnh sản phẩm --- */

        // Hiệu chỉnh dữ liệu theo cấu trúc để tiện xử lý
        $sanphamRow['danhsachhinhanh'] = $danhsachhinhanh;
        ?>
        <form name="frmsanphamchitiet" id="frmsanphamchitiet" method="post" action="">
            <div class="container">
                <div class="row">
                <?php
                    $hinhsanphamdautien = empty($sanphamRow['danhsachhinhanh'][0]) ? '' : $sanphamRow['danhsachhinhanh'][0];
                ?>
                <input type="hidden" name="sp_ma" id="sp_ma" value="<?= $sanphamRow['sp_ma'] ?>" />
                <input type="hidden" name="sp_ten" id="sp_ten" value="<?= $sanphamRow['sp_ten'] ?>" />
                <input type="hidden" name="sp_gia" id="sp_gia" value="<?= $sanphamRow['sp_gia'] ?>" />
                <input type="hidden" name="hinhdaidien" id="hinhdaidien" value="<?= empty($hinhsanphamdautien) ? '' : $hinhsanphamdautien['hsp_tentaptin'] ?>" />
                    <div class="col-md-6">
                    <?php if(!empty($sanphamRow['danhsachhinhanh'])):?>
                        <?php foreach($sanphamRow['danhsachhinhanh'] as $hsp) : ?>
                            <div class="row">
                                <div class="col">
                                    <img src="/backend/assets/uploads/products/<?=$hsp['hsp_tentaptin']?>">
                                </div>
                            </div>
                        <?php endforeach;?>
                    <?php else: ?>
                        <img src="/backend/assets/shared/img/img.png"> 
                    <?php endif;?>
                    </div>
                    <div class="col-md-6">
                        Tên sản phẩm : <?= $sanphamRow['sp_ten'] ?> <br>
                        Giá sản phẩm : <?= $sanphamRow['sp_gia_formated'] ?> <br>
                        Giá cũ sản phẩm : <del><?= $sanphamRow['sp_giacu_formated'] ?></del> <br>
                        <div class="form-group">
                            <label for="soluong">Số lượng đặt mua:</label>
                            <input type="number" class="form-control" id="soluong" name="soluong">
                        </div>
                        <div class="action">
                            <a class="add-to-cart btn btn-default btn-success" id="btnThemVaoGioHang">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                    <div class="col-md-12"></div>
                </div>
            </div>
        </form>

    </main>
    <?php include_once(__DIR__.'/../layouts/partials/footer.php'); ?>
    <?php include_once(__DIR__.'/../layouts/scripts.php'); ?>
    <script>
        function addSanPhamVaoGioHang() {
            // Chuẩn bị dữ liệu gởi
            var dulieugoi = {
                sp_ma: $('#sp_ma').val(),
                sp_ten: $('#sp_ten').val(),
                sp_gia: $('#sp_gia').val(),
                hinhdaidien: $('#hinhdaidien').val(),
                soluong: $('#soluong').val(),
            };
            // console.log((dulieugoi));

            // Gọi AJAX đến API ở URL `/php/myhand/frontend/api/giohang-themsanpham.php`
            $.ajax({
                url: '/backend/frontend/api/giohang-themsanpham.php',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    console.log(data);
                    var htmlString =
                        `Sản phẩm đã được thêm vào Giỏ hàng. <a href="/php/myhand/frontend/thanhtoan/giohang.php">Xem Giỏ hàng</a>.`;
                    $('#thongbao').html(htmlString);
                    // Hiện thông báo
                    $('.alert').removeClass('d-none').addClass('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    var htmlString = `<h1>Không thể xử lý</h1>`;
                    $('#thongbao').html(htmlString);
                    // Hiện thông báo
                    $('.alert').removeClass('d-none').addClass('show');
                }
            });
        };

        // Đăng ký sự kiện cho nút Thêm vào giỏ hàng
        $('#btnThemVaoGioHang').click(function(event) {
            event.preventDefault();
            addSanPhamVaoGioHang();
        });
    </script>
</body>
</html>
