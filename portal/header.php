<header>
    <nav class="navbar navbar-expand-sm bg-gray navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="../images/logo.png" alt="logo" style="width:90px;" />
        </a>
        <ul class="navbar-nav">
            <li class="nav-item"><a  class="nav-link"  href="create-invoice.php" class="btn"> Create New Invoice</a></li>
            <li class="nav-item"><a  class="nav-link"  href="create-invoice.php" class="btn"> Create New Quote</a></li>
            <li class="nav-item"><a  class="nav-link" href="register.php" class="btn">Register New User</a></li>
            <li class="nav-item" ><a  class="nav-link" href="actions/logout.php" class="btn"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout <span class="user-info"><?php echo $row['name'] ?></span></a></li>
        </ul>
    </div>
    </nav>
</header> 
        
