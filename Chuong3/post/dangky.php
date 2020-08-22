<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Đăng Nhập</h1>
    <form action="xulydangky.php" method="POST" name="frmDangNhap" id="frmDangNhap">
        <table>
            <tr>
                <td>Tên đăng nhập : </td>
                <td><input type="text" name="txtUserName" id="txtUserName"/></td>
            </tr>
            <tr>
                <td>Mật khâu : </td>
                <td><input type="password" name="txtPassword" id="txtPassword"/></td>
            </tr>
            <tr>
                <td>Tên đầy đủ : </td>
                <td><input type="text" name="txtFullName" id="txtFullName"/></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Đăng Nhập" name="btnDangNhap" id="btnDangNhap"></td>
            </tr>
        
        <br/>
        
        </table>
    </form>
</body>
</html>