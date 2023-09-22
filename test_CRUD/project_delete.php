<?php 
session_start() ;
if(isset($_GET['id'])){
    $id = $_GET['id'] ;
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
        foreach($cart as $key=>$value){
            if($value->id == $id){
                unset($cart[$key]);
                break;
            }
        }
        $_SESSION['cart'] = $cart;
    }
    header("location: project_cart.php");
    exit;
 }
?>