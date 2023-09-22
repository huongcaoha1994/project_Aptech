<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRoduct</title>
    <style>
        .container {
  display: flex;
}

.box {
  width: 20%;
  height: 200px;
  background-color: #f1f1f1;
  border: 1px solid #ccc;
}
  </style>
</head>
<body>
    <h1>Danh sách sản phẩm</h1>
    <div class="container">

    <?php 
    include("project_database.php");
    $productPerPage = 5 ;
    $count_product = "select count(*) as total from products ;";
    $result_count = $connect->query($count_product);
    if($result_count->num_rows > 0){
        $row = $result_count->fetch_assoc();
        $total_product = $row['total'];
        $total_page = ceil($total_product / $productPerPage);
        $current_page = (isset($_GET['page'])) ? $_GET['page'] : 1 ;
        $current_page = max(1,min($current_page,$total_page));
        $start = ($current_page - 1 ) * $productPerPage + 1 ;
        $select_product = "select * from products limit $start,$productPerPage ;";
        $result_product = $connect->query($select_product);
        if($result_product->num_rows > 0) {
            while($row = $result_product->fetch_assoc()){
                ?>
                    <div class="box">
                        <img src="<?php echo $row['image'] ?>" alt="" width="200" height="200">
                        <h3><?php echo $row['product_name'] ?></h3>
                        <h4><?php echo $row['price'] ?></h4>
                        <form action="" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" required>
                            <input type="submit" name="addtocart" value="Add">
                        </form>
                        <br>
                    </div>
                <?php

            }

           
        }
        else {
            echo "Không có sản phẩm nào cả .";
        }
    }
      

    ?>
    </div>

    <?php 
    session_start();

    if(isset($_POST['addtocart'])){
        $id = $_POST['id'] ;
        $quantity = $_POST['quantity'];
        if($_SESSION['cart']){
            $cart = $_SESSION['cart'] ;
            foreach($cart as $value){
                if ($value->id == $id){
                    $value->quantity += $quantity ;
                    $value->total_money = $value->price * $value->quantity ;
                    $message_success = "Thêm sản phẩm thành công" ;
                    echo "<script> alert ('$message_success')</script>" ;
                    return ;
                }
               
            }
        }
        else {
            $_SESSION['cart'] = [] ;
        }
        $select_product = "select * from products where id = $id ;" ;
        $result_product = $connect->query($select_product);
        if($result_product->num_rows > 0) {
            $row = $result_product->fetch_assoc();
            $product = new stdClass() ;
            $product->id = $row['id'] ;
            $product->image = $row['image'] ;
            $product->product_name = $row['product_name'] ;
            $product->price = $row['price'] ;
            $product->quantity = $quantity ;
            $product->total_money = $product->price * $product->quantity ;
            $_SESSION['cart'][] = $product ;
            $message_success = "Thêm sản phẩm thành công" ;
            echo "<script> alert ('$message_success')</script>" ;
        }
        else {
            $message_error = "Thêm sản phẩm thất bại" ;
            echo "<script> alert ('$message_error')</script>" ;
        }
    }
   
    ?>
     <br><br><br>
    <button style="margin-top:200px"><a href="project_create-product.php" style="margin-top:200px">Go to Create</a></button>
    <button><a href="project_cart.php">Go to Cart</a></button>
    <br>
    
    <?php 
     for($i = 1 ; $i <= $total_page ; $i++){
        ?>
            <a href="project_product.php?page=<?php echo $i ; ?>"><?php echo $i ; ?></a>
        <?php
    }
    ?>
</body>
</html>