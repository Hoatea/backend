<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <title>Thực thi SQL | FORM INSERT</title>
</head>
<body>
    <h1>INSERT</h1>
    <form action="" method="POST" name="frm_insert" id="frm_insert">
        <table>
            <tr>
                <td>Tên phương thức thanh toán : </td>
                <td><input type="text" name="httt_ten" id="httt_ten"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Thêm" name="btn_them"></td>
            </tr>
        </table>
    </form>
    <?php
        if(isset($_POST['btn_them'])){
            include_once(__DIR__ . '/../dbconnect.php');
            $httt_ten=$_POST['httt_ten'];
            $sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES(N'{$httt_ten}');";
            mysqli_query($conn, $sql);
        }
    ?>
    <script src="../assets/vendor/jquery/jquery.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
</body>
</html>