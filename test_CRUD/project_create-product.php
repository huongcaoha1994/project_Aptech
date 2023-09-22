<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Create Product</h1>
        <br>
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" required>
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>
        <br>
        <textarea name="description" id="" cols="30" rows="10">Description:</textarea>
        <br>
        <label for="status">Status</label>
        <input type="radio" name="status" value="1">
        <label for="status">sale</label>
        <input type="radio" name="status" value="0">
        <label for="status">coming soon</label>
        <br>
        <label for="image">Image:</label>
        <input type="file" name="image">
        <br>
        <input type="submit" name="create_product" value="Add">
    </form>

    <?php 
    include("project_database.php");
    if(isset($_POST['create_product'])){
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'] ;
        $description = $_POST['description'];
        $status = $_POST['status'] ;

        if(isset($_FILES['image'])){
            $file_save = "uploads/" ;
            $taget_file = $file_save.basename($_FILES['image']['name']);
            $upload_oke = true ;
            $style_file = strtolower(pathinfo($taget_file,PATHINFO_EXTENSION));

            if(file_exists($taget_file)){
                $i = 1 ;
                while(file_exists($taget_file)){
                    $taget_file = $file_save.$i.$_FILES['image']['name'];
                    $i++ ;
                }
            }
            if($style_file == "png" || $style_file == "jpeg" || $style_file == "gif" || $style_file == "jpg"){
                $upload_oke = true ;
            }
            else {
                $upload_oke = false ;
            }
            if($upload_oke = true){
                if( move_uploaded_file($_FILES['image']['tmp_name'],$taget_file)){
                    echo "upload thành công";
                    $insert_product = "insert into products (image,product_name,price,quantity,description,status)
                    values ('$taget_file','$product_name',$price,$quantity,'$description',$status);";
                    $result_insert = $connect->query($insert_product);
                    if($result_insert){
                        $message_success = "add product successfully" ;
                        echo "<script> alert ('$message_sucess') ;</script>" ;
                        header("location: project_product.php");
                        exit ;
                    }
                    else {
                        $message_error1 = "add product error" ;
                        echo "<script> alert ('$message_error1') ;</script>" ;
                    }
                }
                else {
                    echo "file ảnh bị lỗi" ;
                    return ;
                }
            }
            
        }
    }
    ?>
</body>
</html>