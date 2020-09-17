<?php
    include_once(__DIR__ . '/../../../dbconnect.php');
    $dh_ma = $_GET['dh_ma'];
    // 3. Xóa các dòng con (chi tiết Đơn hàng) trước
    $sqlDeleteChiTietDonHang = "DELETE FROM `sanpham_dondathang` WHERE dh_ma=" . $dh_ma;
    // 3.1. Thực thi câu lệnh DELETE Chi tiết Đơn hàng
    $resultChiTietDonHang = mysqli_query($conn, $sqlDeleteChiTietDonHang);
    // 4. Xóa dòng Đơn hàng
    $sqlDeleteDonHang = "DELETE FROM `dondathang` WHERE dh_ma=" . $dh_ma;
    // 3.1. Thực thi câu lệnh DELETE Chi tiết Đơn hàng
    $resultDonHang = mysqli_query($conn, $sqlDeleteDonHang);
    // 4. Đóng kết nối
    mysqli_close($conn);
        
    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
    header('location:index.php');
?>