<?php
include 'config.php';
session_start();

$sql = "INSERT INTO 
`invoice`(
    `invoice-number`,
     `client-name`, 
     `client-address`, 
     `client-city`, 
     `client-state`, 
     `client-zipcode`, 
     `client-country`, 
     `order-date`, 
     `client-contact-no`, 
     `service-item`, 
     `description`, 
     `amount`, 
     `is_available`, 
     `is_send`) VALUES(
         '".$_POST['invoice-number']."',
         '".$_POST['client-name']."',
         '".$_POST['client-address']."',
         '".$_POST['client-city']."',
         '".$_POST['client-state']."',
         '".$_POST['client-zipcode']."',
         '".$_POST['client-country']."',
         '".$_POST['order-date']."',
         '".$_POST['client-contact-no']."',
         '".$_POST['service-item']."',
         '".$_POST['description']."',
         '".$_POST['amount']."',
         1,
         1)";

if ($conn->query($sql) === TRUE) {
    
}
$conn->close();
?>