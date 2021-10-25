<!DOCTYPE html>
<html>
<?php
session_start();
// Check user login or not
if(!isset($_SESSION['user'])){
    header('Location: index.php');
}
unset($_SESSION['message']);
include 'actions/login.php';
?>
<head>
    <title>JOE Portal</title>
    <link rel='shortcut icon' type='image/x-icon' href='../favicon.ico' />
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container ">
    <div class="row">
        <div class="col-xs-12 top-logo">
             <img src="../images/logo.png" />
        </div>
    </div>
    <div class="row bg-gray">
      
        <div class="col-xs-12 form-content">
            <form action="actions/register.php" method="post" class="portal-form">
            <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label>Name : </label> 
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" id="name" name="name" required /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label>Email : </label> 
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="email" id="email" name="email" required /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label>Username : </label> 
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" id="username" name="username" required /> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label>Password : </label>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="password" id="password" name="password" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label>Confirm Password : </label>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <input type="password" id="confirmPassword" name="confirmPassword" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <input type="submit" value="Save" class="button button-darker"/>
                    </div> 
                    <div class="col-xs-12 col-sm-6">
                       <a href="index.php">Login for existing user</a>
                    </div>       
                </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>