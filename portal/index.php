<!DOCTYPE html>
<html>
<?php 
  session_start();
  if(isset($_SESSION['user'])){
    header("location:home.php");
  } 
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
    <div class="container">
    <div class="row">
        <div class="col-xs-12 top-logo">
             <img src="../images/logo.png" />
        </div>
    </div>
    <div class="row bg-gray">
        <div class="col-xs-12 form-content">
            <form action="actions/authenticate.php" method="post" class="portal-form">
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
                        <input type="submit" value="Login" class="button button-darker"/>
                    </div> 
                         
                </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>