<?php
require 'database.php';

if (!isset($_SESSION['loggedin']))
    header("LOCATION: login.php");

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Bag Ordering System : Log Out</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background-image: url(https://wallpaperaccess.com/full/1668999.jpg);">
<?php include_once 'nav_bar.php'; ?>
<div class="container center-wrapper text-center">
    <?php
    unset($_SESSION);
    session_destroy();
    header( "refresh:10;url=login.php");
    ?>
    <div style="padding: 3rem;background: rgba(0, 0, 0, 0.2);border-radius: 5px;">
        <h1>Logged Out</h1>
        <p class="text-muted">Thank You</p>
        <a class="btn btn-primary" href="login.php" role="button">Log In Again</a>
    </div>

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
