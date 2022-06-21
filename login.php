<?php
require_once 'database.php';

if (isset($_SESSION['loggedin']))
    header("LOCATION: index.php");

if (isset($_POST['userid'], $_POST['password'])) {
    $UserID = htmlspecialchars($_POST['userid']);
    $Pass = $_POST['password'];

    if (empty($UserID) || empty($Pass)) {
        $_SESSION['error'] = 'Please fill in the blanks.';
    } else {
        $stmt = $db->prepare("SELECT * FROM tbl_staffs_a174485_pt2 WHERE (fld_staff_num = :id OR fld_staff_email = :id) LIMIT 1");
        $stmt->bindParam(':id', $UserID);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($user['fld_staff_num'])) {
            if ($user['fld_staff_pass'] == $Pass) {
                unset($user['fld_staff_pass']);
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $user;

                header("LOCATION: index.php");
                exit();
            } else {
                $_SESSION['error'] = 'Invalid login credentials. Please try again.';
            }
        } else {
            $_SESSION['error'] = 'Account does not exist.';
        }
    }

    header("LOCATION: " . $_SERVER['REQUEST_URI']);
    exit();
}
?>
<html>
<head>
     <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-image: url(https://wallpaperaccess.com/full/1668999.jpg);">
<div class="container login-wrapper">
    <div class="panel panel-default" style="width: 100%">
        <div class="panel-body">
            <div class="text-center">
                <h2 class="text-center">TECHBAGS LOGIN</h2>
                Sign in to your account
            </div>
            <hr/>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                <div class="form-group">
                    <label for="inputUserID">Email address</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" id="inputUserID" name="userid"
                               placeholder="Email address">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputUserPass">Password</label>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" id="inputUserPass" name="password"
                               placeholder="Password">
                    </div>
                </div>

                <?php
                if (isset($_SESSION['error'])) {
                    echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
                    unset($_SESSION['error']);
                }
                ?>
                <button type="submit" class="btn btn-primary btn-block" style="border-radius: 20px;">Login</button>
            </form>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
