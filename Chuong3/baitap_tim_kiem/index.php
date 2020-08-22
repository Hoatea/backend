<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tìm Kiếm</title>
</head>
<body>
    <form action="xuly.php" method="GET" name="frmTiemKiem" id="frmTiemKiem">
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
        <input type="submit" value="Tìm Kiếm">
    </form>
</body>
</html>