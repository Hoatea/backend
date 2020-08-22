<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tìm Kiếm</title>
</head>
<body>
    <form action="" method="GET" name="frmTiemKiem" id="frmTiemKiem">
        Tên sản phẩm <br/>
        <input type="text" name="txtTenSP" id="txtTenSP"><br/>
        Loại sản phẩm <br/>
        <input type="checkbox" name="loaiSP[]" id="loaiSP_1" value="1"/>Máy tính bảng<br/>
        <input type="checkbox" name="loaiSP[]" id="loaiSP_2" value="2"/>Máy tính xách tay<br/>
        <input type="checkbox" name="loaiSP[]" id="loaiSP_3" value="3"/>Điện thoại<br/>
        <input type="checkbox" name="loaiSP[]" id="loaiSP_4" value="4"/>Linh phụ kiện<br/>
        Nhà sản xuất <br/>
        <input type="checkbox" name="nhaSX[]" id="nhaSX_1" value="1"/>Apple<br/>
        <input type="checkbox" name="nhaSX[]" id="nhaSX_2" value="2"/>Samsung <br/>
        <input type="checkbox" name="nhaSX[]" id="nhaSX_3" value="3"/>HTC<br/>
        <input type="checkbox" name="nhaSX[]" id="nhaSX_4" value="4"/>Nokia<br/>
        Khuyến mãi<br/>
        <input type="radio" name="khuyenMai" id="khuyenMai_1" value="1"> Trung Thu<br/>
        <input type="radio" name="khuyenMai" id="khuyenMai_2" value="2"> Sinh Nhật<br/>
        <input type="submit" value="Tìm Kiếm" name="y">
        
    </form>
    <?php
        if(isset($_GET['y'])){
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
        }
    ?>
</body>
</html>