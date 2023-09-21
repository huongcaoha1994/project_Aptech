<?php 
 $servername = "localhost:3307" ;
 $username = "root" ;
 $password = "12345678" ;
 $dbname = "students" ;
 $connect = new mysqli($servername,$username,$password,$dbname);
 if(!$connect){
     $message_error = "Kết nối database thất bại !" ;
     echo "<script>alert ('$message_error')</script>";
 }
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $select_info = "select * from student where id = $id ;";
    $result = $connect->query($select_info);
    if($result->num_rows > 0){
       $info = $result->fetch_assoc();
       ?>
        <form action="" method="POST">
            <h1>Edit Information</h1>
            <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
            <br>
            <label for="name">Name:</label>
            <br>
            <input type="text" name="name" value="<?php echo $info['name']; ?>">
            <br>
            <label for="email">Email:</label>
            <br>
            <input type="email" name="email" value="<?php echo $info['email']; ?>">
            <br>
            <label for="phone">Phone</label>
            <br>
            <input type="number" name="phone" value="<?php echo $info['phone']; ?>">
            <br>
            <label for="dob">DOB:</label>
            <br>
            <input type="date" name="dob" value="<?php echo $info['dob']; ?>">
            <br>
            <input type="submit" name="edit_info" value="update">
        </form>
       <?php

       
       
    }
}

?>
<?php
if(isset($_POST['edit_info'])){
    $id = $_POST['id'] ;
    $name = $_POST['name'] ;
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $update_info = "update student set name = '$name',
    email = '$email',
    phone = '$phone',
    dob = '$dob' where id = $id ;";
    $result_update = $connect->query($update_info);
    if($result_update){
        $message_success = "Update thành công " ;
        echo "<script>alert ('$message_success')</script>";
        header("location: exam_demo.php");
        exit;
    }
    else {
        $message_error = "Update không thành công " ;
        echo "<script>alert ('$message_error')</script>";
    }
}

?>