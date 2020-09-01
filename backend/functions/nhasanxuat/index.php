<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend | Bảng nhà sản xuất</title>
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
                <h1>Bảng nhà sản xuất</h1>
                <?php 
                    include_once(__DIR__ . '/../../../dbconnect.php'); 
                    $sql = " SELECT nsx_ma, nsx_ten FROM nhasanxuat; ";
                    $result = mysqli_query($conn, $sql);
                    $data = [];
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $data[] = array(
                            'nsx_ma' => $row['nsx_ma'],
                            'nsx_ten' => $row['nsx_ten'],
                        );
                    }
                ?>
                <a href="create.php" class="btn btn-dark m-3">Thêm nhà sản xuất</a>
                <table class="mx-auto table table-hover">
                    <thead>
                        <th>#</th>
                        <th>Mã nhà sản xuất</th>
                        <th>Tên nhà sản xuất</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php $i=1 ?>
                        <?php foreach($data as $value):?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?=$value['nsx_ma']?></td>
                                <td class="font-weight-bold"><?=$value['nsx_ten']?></td>
                                <td>
                                    <a href="delete.php?nsx_ma=<?=$value['nsx_ma']?>">Xóa</a> | 
                                    <a href="edit.php?nsx_ma=<?=$value['nsx_ma']?>">Sửa</a>
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