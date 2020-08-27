<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <title>Thực thi SQL | FORM UPDATE</title>
</head>
<body>
    <h1>UPDATE</h1>
    <?php
        include_once(__DIR__ . '/../dbconnect.php');
        $httt_ma = $_GET['httt_ma'];
        $sql = <<<EOT
        SELECT httt_ma,httt_ten
        FROM hinhthucthanhtoan
        WHERE httt_ma = $httt_ma;
EOT;
        $result = mysqli_query($conn, $sql);
        $data = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data = array(
                'httt_ma' => $row['httt_ma'],
                'httt_ten' => $row['httt_ten'],
            );
        }
    ?>
    <form action="" method="POST" name="frm_insert" id="frm_insert">
        <table>
            <tr>
                <td>Tên phương thức thanh toán : </td>
                <td><input type="text" name="httt_ten" id="httt_ten" value="<?= $data['httt_ten'] ?>"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="Sửa" name="btn_sua"></td>
            </tr>
        </table>
    </form>
    <?php
        if(isset($_POST['btn_sua'])){
            $httt_ten=$_POST['httt_ten'];
            $sql = <<<EOT
            UPDATE hinhthucthanhtoan
            SET	httt_ten=N'$httt_ten'
            WHERE	httt_ma=$httt_ma;
EOT;
            mysqli_query($conn, $sql);
        }
    ?>
    <script src="../assets/vendor/jquery/jquery.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
</body>
</html>