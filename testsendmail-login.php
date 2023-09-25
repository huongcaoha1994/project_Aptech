<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST" id="register">
        <h1>Login</h1>
        <br>
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" name="login" value="Register">
    </form>
    <?php 
    include("testsendmail-database.php");
        if(isset($_POST['login'])){
            $username1 = $_POST['username'] ;
            $password1 = $_POST['password'] ;
            $check_user = "select * from account where username = '$username1' and password = '$password1' ;" ;
            $result_check = $connect->query($check_user);
            if($result_check->num_rows > 0) {
                $message_success1 = "Đăng nhập thành công" ;
                echo "<script> alert ('$message_success1')</script>" ;
                header("location: testsendmail-home.php");
                exit;
            }
            else {
                $message_error1 = "sai username hoặc password" ;
                echo "<script> alert ('$message_error1')</script>" ;
            }
        }
    ?>
</body>
</html>