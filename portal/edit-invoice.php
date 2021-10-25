<?php
session_start();
// Check user login or not
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
unset($_SESSION['message']);
include 'actions/login.php';

$inv_sql = "SELECT * FROM invoice _invoice WHERE  _invoice.id = '".$_GET['id']."' ";
$inv = mysqli_query($conn,$inv_sql);
$invoice = mysqli_fetch_array($inv,MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
<head> 
    <title>JOE Portal | Edit Invoice</title>
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container">

    <h2>Create New Invoice</h2>
    <hr/>
    <form action="save.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="invoice-number">Invoice Number</label>
            <input type="text" class="form-control" name="invoice-number" id="invoice-number" value="<?php echo $invoice['invoice-number'];?>" readonly> 
        </div>

        <h4>Client Information</h4>
        <hr/>
        <div class="form-group">
            <label for="client-name">Client Name</label>
            <input type="text" class="form-control" name="client-name" id="client-name" value="<?php echo $invoice['client-name'];?>">
        </div>
    
        <div class="form-group">
            <label for="client-address">Address</label>
            <input type="text" class="form-control" name="client-address" id="client-address" value="<?php echo $invoice['client-address'];?>">
        </div>
        <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="client-city">City</label>
                <input type="text" class="form-control" name="client-city" id="client-city" value="<?php echo $invoice['client-city'];?>">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="client-state">State</label>
                <input type="text" class="form-control" name="client-state" id="client-state" value="<?php echo $invoice['client-state'];?>">
            </div>
        </div>
        </div>

        <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="client-zipcode">Zipcode</label>
                <input type="text" class="form-control" name="client-zipcode" id="client-zipcode" value="<?php echo $invoice['client-zipcode'];?>">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="client-country">Country</label>
                <input type="text" class="form-control" name="client-country" id="client-country" value="<?php echo $invoice['client-country'];?>" readonly>
            </div>
        </div>
        </div>

        <div class="form-group">
            <label for="client-contact-no">Contact Nummber</label>
            <input type="phone" class="form-control" name="client-contact-no" id="client-contact-no" value="<?php echo $invoice['client-contact-no'];?>">
        </div>

        <h4>Order Information</h4>
        <hr/>
        <div class="form-group">
            <label for="order-date">Order Date</label>
            <input type="text" class="form-control" name="order-date" id="order-date" value="<?php echo $invoice['order-date'];?>" readonly>
        </div>

        <div class="content-detail"> 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="description">Service Item</label>
                        <textarea class="form-control" name="service-item" id="service-item"><?php echo $invoice['service-item'];?></textarea>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description"><?php echo $invoice['description'];?></textarea>
                    </div>
                </div>
                
                <div class="col">
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" name="amount" id="amount" value="<?php echo $invoice['amount'];?>">
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="total-services" name="total-services" value="0"/>
        <input type="hidden" class="form-control" name="created_by" id="created_by" value="<?php echo $row['username'] ?>">
        <div class="add-more-servie">
            <a class="btn btn-link add-more">Add Service</a>
        </div>

        <div class="form-bottom-button">
            <input type="submit" value="Save" name="submit" class="btn btn-primary">
            <a class="btn btn-primary">Save & Send</a>
        </div>
    </form>
</div>
</body>

<script>
$(document).ready(function() {
  var count="0";
  // add row
  $('body').on('click', '.add-more', function() {
    count++;
    var contentBody = $('.content-detail');
    contentBody.append('' +
            '<div class="row"> <span class="remove remove-row">x</span>' +
                '<div class="col">' +
                    '<div class="form-group">' +
                        '<label for="service-item">Service Item</label>' +
                        '<textarea class="form-control" name="service-item'+count+'" id="service-item'+count+'"></textarea>'+
                    '</div> </div>' +
                '<div class="col">' +
                    '<div class="form-group">' +
                        '<label for="description">Description</label>' +
                        '<textarea class="form-control" name="description'+count+'" id="description'+count+'"></textarea>'+
                    '</div> </div>' +
                '<div class="col">' +
                    '<div class="form-group">' +
                        '<label for="amount">Amount</label> ' +
                        '<input type="text" class="form-control" name="amount'+count+'" id="amount'+count+'">' +
                    '</div></div></div>');
    $("#total-services").val(count);
  });

  // delete row
  $('body').on('click', '.remove-row', function() {
      console.log("click");
    $(this).parents('.row').remove();
  });

});
</script>
<?php 
$conn->close();
?>

</html>