<?php
include 'config.php';
echo "inside";
$sql = "SELECT * FROM login _login WHERE  _login.username = '".$_POST['username']."' AND  _login.password = md5('".$_POST['password']."') ";
//$result = $conn->query($sql);
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
if($count == 1) {
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    session_start();
    $_SESSION['user'] = $row['id'];
    header("location:../home.php");
} else {
    session_start();
    $_SESSION['error'] = 'Username or Password is invalid';
    header("location:../index.php");
}
$conn->close();
?>