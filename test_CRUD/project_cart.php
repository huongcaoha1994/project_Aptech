<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    session_start();
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'] ;
        foreach($cart as $value){
            ?>
                <div>
                    <img src="<?php echo $value->image ; ?>" alt="" width="200" height="200">
                    <h3><?php echo $value->product_name ; ?></h3>
                    <h4><?php echo $value->price ; ?></h4>
                    <h4><?php echo $value->quantity ; ?></h4>
                    <h4><?php echo $value->total_money ; ?></h4>
                   <button><a href="project_delete.php?id=<?php echo $value->id ;?>">delete</a></button>
                   <button><a href="project_update.php?id=<?php echo $value->id ;?>">update</a></button>
                </div>
            <?php
        }
    }
    ?>
    <br><br><br>
    <button><a href="project_product.php">Go to Product</a></button>
</body>
</html>
