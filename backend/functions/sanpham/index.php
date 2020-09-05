<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng sản phẩm</title>
    <!-- Chèn các file css -->
    <?php include_once(__DIR__.'/../../layouts/styles.php'); ?>
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
            <div class="col-md-10 text-center">
                <h1>Bảng sản phẩm</h1>
                <?php 
                    include_once(__DIR__ . '/../../../dbconnect.php'); 
                    $sql = " SELECT sp_ma, sp_ten, sp_gia, sp_giacu, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, sp_soluong, lsp_ma, nsx_ma, km_ma FROM sanpham; ";
                    $result = mysqli_query($conn, $sql);
                    $data = [];
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $data[] = array(
                            'sp_ma' => $row['sp_ma'],
                            'sp_ten' => $row['sp_ten'],
                            'sp_gia' => $row['sp_gia'],
                            'sp_giacu' => $row['sp_giacu'],
                            'sp_mota_ngan' => $row['sp_mota_ngan'],
                            'sp_mota_chitiet' => $row['sp_mota_chitiet'],
                            'sp_ngaycapnhat' => $row['sp_ngaycapnhat'],
                            'sp_soluong' => $row['sp_soluong'],
                            'lsp_ma' => $row['lsp_ma'],
                            'nsx_ma' => $row['nsx_ma'],
                            'km_ma' => $row['km_ma'],
                        );
                    }
                    function getlsp($lsp_ma, $conn){
                        $sql = "SELECT lsp_ten FROM loaisanpham WHERE lsp_ma = $lsp_ma;";
                        $result = mysqli_query($conn, $sql);
                        $data = [];
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                            $data = array(
                                'lsp_ten' => $row['lsp_ten']
                            );
                        }
                        return $data['lsp_ten'];
                    }
                    function getnsx($nsx_ma, $conn){
                        $sql = "SELECT nsx_ten FROM nhasanxuat WHERE nsx_ma = $nsx_ma;";
                        $result = mysqli_query($conn, $sql);
                        $data = [];
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                            $data = array(
                                'nsx_ten' => $row['nsx_ten']
                            );
                        }
                        return $data['nsx_ten'];
                    }
                    function getkm($km_ma, $conn){
                        $sql = "SELECT km_ten FROM khuyenmai WHERE km_ma = $km_ma;";
                        $result = mysqli_query($conn, $sql);
                        $data = [];
                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                            $data = array(
                                'km_ten' => $row['km_ten']
                            );
                        }
                        return $data['km_ten'];
                    }
                ?>
                <a href="create.php" class="btn btn-dark m-3">Thêm mới</a>
                <table class="mx-auto table table-hover">
                    <thead class="thead-dark">
                        <th>#</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Giá cũ</th>
                        <th>Số lượng</th>
                        <th>Loại sản phẩm</th>
                        <th>Nhà sản xuất</th>
                        <th>Khuyến mãi</th>
                        <th>Ngày cập nhật</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        <?php foreach($data as $value):?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?=$value['sp_ma']?></td>
                                <td class="font-weight-bold text-left"><?=$value['sp_ten']?></td>
                                <td class="text-right"><?=number_format($value['sp_gia'])?></td>
                                <td class="text-right">
                                    <?php
                                        if(!empty($value['sp_giacu'])){
                                            echo number_format($value['sp_giacu']);
                                        }
                                    ?>
                                </td>
                                <td><?=$value['sp_soluong']?></td>
                                <td>
                                        <?= getlsp($value['lsp_ma'], $conn);?>
                                </td>
                                <td>
                                        <?= getnsx($value['nsx_ma'], $conn);?>
                                </td>
                                <td>
                                        <?php if(!empty($value['km_ma'])){getkm($value['km_ma'], $conn);}
                                        
                                        ?>
                                </td>
                                <td><?=$value['sp_ngaycapnhat']?></td>
                                <td>
                                    <a href="delete.php?sp_ma=<?=$value['sp_ma']?>">Xóa</a> | 
                                    <a href="edit.php?sp_ma=<?=$value['sp_ma']?>">Sửa</a> |
                                    Mô tả
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
</body>
</html>