<?php
include 'config.php';
session_start();
$file_name = $_POST['title'] . "_" .basename($_FILES["fileToUpload"]["name"]);
$sql = "INSERT INTO 
`login`(
    `name`,
     `email`, 
     `username`, 
     `password`) 
     VALUES (
       '".$_POST['name']."'  ,
        '".$_POST['email']."' ,
         '".$_POST['username']."',
         md5('".$_POST['password']."'))";

if ($conn->query($sql) !== TRUE) {
    session_start();
    $_SESSION['error'] = 'Username or Password is invalid';
    header("location:../register.php");
}
header("location:../index.php");
$conn->close();
?>