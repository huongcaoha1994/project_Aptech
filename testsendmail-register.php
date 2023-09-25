<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>
    <form action="" method="POST" id="register">
        <h1>Register</h1>
        <br>
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <input type="submit" name="register" value="Register">
    </form>
   <?php
   session_start();
    include "./PHPMailer/src/PHPMailer.php";
    include "./PHPMailer/src/Exception.php";
    include "./PHPMailer/src/OAuthTokenProvider.php";
    include "./PHPMailer/src/POP3.php";
    include "./PHPMailer/src/SMTP.php";
     
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    $mail = new PHPMailer(true); 
    if(isset($_POST['register'])){
        echo " <style>
        #register {
            display: none;
        }
    </style>";
    echo ' <form action="" method="POST">
    <label for="code">enter code from your email:</label>
    <input type="number" name="code" required>
    <br>
    <input type="submit" name="send_code" value="sent">
</form>';
    
    $_SESSION['username'] = $_POST['username'] ;
    $_SESSION['password'] = $_POST['password'] ;
    $_SESSION['email'] = $_POST['email'];
    global $randomNumber;
    $randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $_SESSION['randomNumber'] = $randomNumber ;
    
    }
    try {
        //Server settings
        $username = $_SESSION['username'] ;
        $email1 = $_SESSION['email'] ;
        $randomNumber = $_SESSION['randomNumber'] ;
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'huongcaoha1994@gmail.com';                 // SMTP username
        $mail->Password = 'oswagpbkvswuqwgj';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
     
        //Recipients
        $mail->setFrom('huongcaoha1994@gmail.com', 'Mailer');
        $mail->addAddress($email1, $username);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('huongcaoha1994@gmail.com');
        // $mail->addBCC('bcc@example.com');
     
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
     
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'facebook code';
        $mail->Body    = $randomNumber;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
     
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
       
    }
  
   ?>
   <?php 
   
   include("testsendmail-database.php");
   if(isset($_POST['send_code'])){
    $randomNumber = $_SESSION['randomNumber'] ;
    $code = $_POST['code'] ;
    $username1 = $_SESSION['username'];
    $password1 = $_SESSION['password'] ;
    $email1 = $_SESSION['email'] ;
    if($code === $randomNumber){
        $insert_user = "insert into account (username,password,email)
        values('$username1','$password1','$email');";
        $result_insert = $connect->query($insert_user);
        if($result_insert){
            $message_register = "Đăng ký thành công" ;
            echo "<script>alert ('$message_register')</script>" ;
            header("location: testsendmail-login.php");
            exit;
        }
        else {
            $message_register2 = "tài khoản đã tồn tại" ;
            echo "<script>alert ('$message_register2')</script>" ;
        }
    }
    else {
        $message_error = "mã code không trùng khớp" ;
        echo "<script> alert ('$message_error')</script>" ;
    }
   }
   ?>
   
</body>
</html>
<!-- $insert_user = "insert into account (username,password,email)
                values('$username1','$password1',$email);";
                $result_insert = $connect->query($insert_user);
                if($result_insert){
                    $message_register = "Đăng ký thành công" ;
                    echo "<script>alert ('$message_register')</script>" ;
                    header("location: testsendmail-login.php");
                    exit;
                }
                else {
                    $message_register2 = "Đăng ký không thành công" ;
                    echo "<script>alert ('$message_register2')</script>" ;
                } -->