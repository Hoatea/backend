<?php
    $txtTenSP=$_GET['txtTenSP'];
    $loaiSP = [];
    if(isset($_GET['loaiSP'])){
        $loaiSP = $_GET['loaiSP'];
    }
    $nhaSX = [];
    if(isset($_GET['nhaSX'])){
        $nhaSX = $_GET['nhaSX'];
    }
    $khuyenMai = null;
    if(isset($_GET['khuyenMai'])){
        $khuyenMai = $_GET['khuyenMai'];
    }


    echo "<ul>";
    echo "<li>Tên sản phẩm : {$txtTenSP}</li>";
    if(!empty($loaiSP)){
        $listLoaiSP = implode(',',$loaiSP);
        echo "<li>Loại sản phẩm : {$listLoaiSP}</li>";
    }
    if(!empty($nhaSX)){
        $listNhaSX = implode(',',$nhaSX);
        echo "<li>Nhà sản xuất : {$listNhaSX}</li>";
    }
    if(!empty($khuyenMai)){
        if($khuyenMai=="1"){
        echo "<li>Khuyến Mãi : Trung Thu</li>";
        }else{
            echo "<li>Khuyến Mãi : Sinh Nhật</li>";
        }
    }
    echo "</ul>";
?>