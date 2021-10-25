<?php
session_start();
// Check user login or not
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
unset($_SESSION['message']);
include 'actions/login.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title> Dashboard </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
<div class="container center-container">
<form action="save.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-xs-12 col-sm-5 col-lg-8">
            <input type="text" class="form-control" name="search" id="search" value="" placeholder="Invoice Number" > 
        </div>
        <div class="col-xs-12 col-sm-3 col-lg-4">
            <input type="submit" value="Search" name="submit" class="btn btn-primary">
        </div>
    </div>
</form>

</div>
<div class="container-fluid">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-12">
        <h2>Invoice List</h2>
        <p style="color:red"><?php echo $_SESSION['message_']; ?></p>
        <table class="table table-striped">
            <tr>
                <th>Invoice Code</th>
                <th>Ordered Date</th>
                <th>Client Name</th>
                <th>Address</th>
                <th>Service Item</th>
                <th>Amount</th>
                <th>Created By</th>
                <th>Action</th>
            </tr>
            <?php 
                while($invoice=mysqli_fetch_assoc($invoice_result)) { 
            ?>
            <tr>
                <td> <?php echo $invoice['invoice-number']; ?></td>
                <td> <?php echo $invoice['order-date']; ?></td>
                <td> <?php echo $invoice['client-name']; ?></td>
                <td> <?php echo $invoice['client-address']; ?>  <?php echo $invoice['client-city']; ?> <?php echo $invoice['client-state']; ?></td>
                <td> <?php echo $invoice['service-item']; ?></td>
                <td> $ <?php echo $invoice['amount']; ?></td>
                <td> <?php echo $invoice['created_by']; ?></td>
                <td> <a target="_blank" title="Preview PDF" alt="Preview PDF" href="preview.php?id=<?php echo $invoice['id']; ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                <?php if($invoice['is_send'] == 1) {?>| <a title="Edit Invoice" alt="Edit Invoice" href="edit-invoice.php?id=<?php echo $invoice['id']; ?>"><i class="fa fa-edit"></i></a> <?php } ?></td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>
</div>
</body>

<?php 
$conn->close();
?>

</html>