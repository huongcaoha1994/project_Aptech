<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,tr,th,td{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <!-- question 1 -->
     <form action="" method="POST">
        <h1>please input your information:</h1>
        <br>
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <input type="submit" name="question1" value="Submit">
     </form>
     <?php 
     if (isset($_POST['question1'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        echo "Helle ".$name."<br>" ;
        echo "Your email is : ".$email ;
     }
     ?>
    <br><br><br>
     <!-- question 2 -->
     <form action="" method="POST">
        <h1>Please input your information</h1>
        <br>
        <label for="full_name">Full Name</label>
        <input type="text" name="full_name" required>
        <br>
        <input type="submit" name="question2" value="Submit">
     </form>
    <?php 
   if (isset($_POST['question2'])) {
    $full_name = $_POST['full_name'];
    echo "Your fullname is: " . $full_name."<br>";

    $result = [];

    function get_result($string) {
        $words = explode(' ', $string);
        $name = end($words);
        $result[] = $name;
        $result[] = ".";
        array_pop($words);
        
        foreach ($words as $word) {
            $array = str_split($word);
            $result[] = reset($array);
        }

        foreach ($result as $value) {
            echo $value;
        }
    }

    get_result($full_name);
}
    ?>
   
    <!-- question 3 -->
    <form action="" method="POST">
        <h1>Days of the Week</h1>
        <h3>please enter a day of the week:</h3>
        <input type="text" name="day" required>
        <br>
        <input type="submit" name="question3" value="Go">
    </form>
    <?php 
    if(isset($_POST['question3'])){
        $day = strtolower($_POST['day']) ;

        function call_day($day){

            switch($day){
                case "monday":
                    echo "Laugh on Monday, laugh for danger.";
                    break;
                case "tuesday":
                    echo "Laugh on Tuesday, kiss a stranger.";
                    break;
                case "wednesday":
                    echo "Laugh on Wednesday, laugh for a letter.";
                    break;
                case "thursday":
                    echo "Laugh on Thursday, something better." ;
                    break;
                case "friday":
                    echo "Laugh on Friday, laugh for sorrow." ;
                    break;
                case "saturday":
                    echo "Laugh on Saturday, joy tomorrow.";
                    break;
                default :
                    echo "Nothing" ;
                    break;
            }

        }
        call_day($day);

    }
    ?>

    <!-- questtion 4 -->
    <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Dob</th>
                    <th>Update Detail</th>
                </tr>
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
    $select_student = "select * from student ;" ;
    $result_student = $connect->query($select_student);
    if($result_student->num_rows > 0){
        $stt = 1 ;
        while($row = $result_student->fetch_assoc()){
            ?>
           <tr>
            <td><?php echo $stt; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['dob']; ?></td>
            <td><a href="exam_demo_edit.php?id=<?php echo $row['id'] ; ?>">Edit info</a></td>
           </tr>
            <?php
        $stt++ ;
        }
    }
    ?>
     </table>

     <form action="" method="POST">
        <h1>Add information</h1>
        <br>
        <label for="Name:"></label>
        <br>
        <input type="text" name="name" required>
        <br>
        <label for="email">Email:</label>
        <br>
        <input type="email" name="email" required>
        <br>
        <label for="phone">Phone:</label>
        <br>
        <input type="number" name="phone" required>
        <br>
        <label for="dob">Dob:</label>
        <input type="date" name="dob">
        <br>
        <input type="submit" name="add_info" value="Save info">
     </form>

     <?php 
     if (isset($_POST['add_info'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $insert_student = "insert into student (name,email,phone,dob)
        values ('$name','$email','$phone','$dob');";
        $result_insert = $connect->query($insert_student);
        if($result_insert){
            $message_successfully = "Thêm thông tin thành công " ;
            echo "<script>alert ('$message_successfully')</script>";
            header("location: exam_demo.php");
            exit;
        }
        else {
            $message_error = "Thêm thông tin không thành công " ;
            echo "<script>alert ('$message_error')</script>";

        }
     }
     ?>

</body>
</html>