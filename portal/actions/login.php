<?php
include 'config.php';
$sql = "SELECT * FROM login _login WHERE  _login.id = '".$_SESSION['user']."' ";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

if($count == 1) {    
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $invoice_sql = "SELECT * FROM invoice _invoice WHERE  _invoice.is_available = 1 ";
    $invoice_result =   mysqli_query($conn,$invoice_sql);    
} else {
    $_SESSION['error'] = 'Session Expired';
    header("location:index.php");
}
?>