<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NenTang.vn</title>

    <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
    <?php include_once(__DIR__ . '/../layouts/styles.php'); ?>

    <link href="/backend/assets/frontend/css/style.css" type="text/css" rel="stylesheet" />
</head>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
    <!-- end header -->

    <main role="main" class="mb-2">
        <!-- Block content -->
        <div class="container mt-2">
            <h1 class="text-center">Liên hệ với Nền tảng</h1>
            <div class="row">
                <div class="col col-md-6">
                    <img src="/backend/assets/frontend/imgs/unnamed.jpg" class="img-fluid" />
                </div>
                <div class="col col-md-6">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="email">Email của bạn</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email của bạn">
                        </div>
                        <div class="form-group">
                            <label for="title">Tiêu đề của bạn</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề của bạn">
                        </div>
                        <div class="form-group">
                            <label for="message">Lời nhắn của bạn</label>
                            <textarea name="message" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-primary" name="btnGoiLoiNhan">Gởi lời nhắn</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        // Load các thư viện (packages) do Composer quản lý vào chương trình
        require_once __DIR__.'/../../vendor/autoload.php';
        // Sử dụng thư viện PHP Mailer
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        if (isset($_POST['btnGoiLoiNhan'])) {
            // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
            $email = $_POST['email'];
            $title = $_POST['title'];
            $message = $_POST['message'];
            // Gởi mail kích hoạt tài khoản
            $mail = new PHPMailer(true);                                // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 2;                                   // Enable verbose debug output
                $mail->isSMTP();                                        // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username = 'tranvanhoa15042000@gmail.com'; // SMTP username
                $mail->Password = 'lzxarwsaiwqknucy';                   // SMTP password
                $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                      // TCP port to connect to
                $mail->CharSet = "UTF-8";
                // Bật chế bộ tự mình mã hóa SSL
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                //Recipients
                $mail->setFrom('tranvanhoa15042000@gmail.com', 'Mail Liên hệ');
                $mail->addAddress('tranvanhoa15042000@gmail.com');               // Add a recipient
                $mail->addReplyTo($email);
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');
                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');        // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name
                //Content
                $mail->isHTML(true);                                    // Set email format to HTML
                // Tiêu đề Mail
                $mail->Subject = "[Có người liên hệ] - $title";         
                // Nội dung Mail
                // Lưu ý khi thiết kế Mẫu gởi mail
                // - Chỉ nên sử dụng TABLE, TR, TD, và các định dạng cơ bản của CSS để thiết kế
                // - Các đường link/hình ảnh có sử dụng trong mẫu thiết kế MAIL phải là đường dẫn WEB có thật, ví dụ như logo,banner,...
                $body = <<<EOT
                <table border="0">
                    <tr>
                        <td colspan="2">
                            <img src="https://www.freelogodesign.org/Content/img/logo-samples/flooop.png" alt="logo">
                        </td>
                    </tr>
                    <tr>
                        <td>Có người liên hệ cần giúp đỡ.</td>
                        <td>
                            Email của khách: $email <br />
                            Nội dung: <br />
                            $message
                        </td>
                    </tr>
                </table>
EOT;
                $mail->Body    = $body;
                $mail->send();
            } catch (Exception $e) {
                echo 'Lỗi khi gởi mail: ', $mail->ErrorInfo;
            }
        }
        ?>
        <!-- End block content -->
        
    </main>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->

</body>

</html>