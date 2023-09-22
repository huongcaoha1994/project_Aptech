<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start() ;
    if(isset($_GET['id'])){
        $id = $_GET['id'] ;
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'] ;
            foreach($cart as $value){
                if($value->id == $id){
                    ?>
                       <div>
                        <img src="<?php echo $value->image ; ?>" alt="">
                        <h3><?php echo $value->product_name ; ?></h3>
                        <h4><?php echo $value->price ; ?></h4>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo $value->id ; ?>">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" value="<?php echo $value->quantity ; ?>" required>
                            <br>
                            <input type="submit" name="update" value="Update">
                        </form>
                       </div>
                    <?php
                }
            }
        } 
    }
    ?>
    <?php 
    if(isset($_POST['update'])){
        $id = $_POST['id'] ;
        $quantity = $_POST['quantity'] ;
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'] ;
            foreach($cart as $value){
                if($value->id == $id){
                    $value->quantity = $quantity ;
                    $value->total_money = $value->price * $value->quantity ;
                    header("location: project_cart.php");
                    exit;
                }
            }
        }
    }
    ?>
</body>
</html>