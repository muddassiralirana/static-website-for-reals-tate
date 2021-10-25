<?php 

include '../../connections/config.php';
session_start();
unset($_SESSION['message_']);

if($_GET['add']) {
    $product_id = $_GET['add'];
    $sql = "UPDATE products SET quantity = quantity + 1 WHERE id = ". $product_id;
    
    if ($conn->query($sql) !== TRUE) {
        $_SESSION['message_'] = "Error: " . $sql . "<br>" . $conn->error;
    } 

} else if ($_GET['sub']) {
    $product_id = $_GET['sub'];
    $sql = "UPDATE products SET quantity = quantity - 1 WHERE id = ". $product_id;
    
    if ($conn->query($sql) !== TRUE) {
        $_SESSION['message_'] = "Error: " . $sql . "<br>" . $conn->error;
    } 
} else if($_GET['del']) {
    $product_id = $_GET['del'];
    $sql = "UPDATE products SET  is_available = 0 WHERE id = ". $product_id;
 
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message_'] = "Product Delete Successfully..";
    } else {
        $_SESSION['message_'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}

header("location:../home.php");
?>