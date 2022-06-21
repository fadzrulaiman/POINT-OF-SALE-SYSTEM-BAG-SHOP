<?php
include_once 'database.php';

if (!isset($_SESSION['loggedin']))
    header("LOCATION: login.php");

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Create
if (isset($_POST['create'])) {
    if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
        try {
            $stmt = $conn->prepare("INSERT INTO tbl_staffs_a174485_pt2(fld_staff_num, fld_staff_name,
      fld_staff_gender, fld_staff_phone, fld_staff_email, fld_staff_role, fld_staff_pass) VALUES(:sid, :name, :gender,
      :phone, :email, :role, :pass)");
   
        $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $gender =  $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $pass = $_POST['pass'];

            $stmt->execute();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error while creating: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Sorry, but you don't have permission to create a new staff.";
    }

    header("LOCATION: {$_SERVER['REQUEST_URI']}");
    exit();
}

//Update
if (isset($_POST['update'])) {
    if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
        try {
             $stmt = $conn->prepare("UPDATE tbl_staffs_a174485_pt2 SET fld_staff_num = :sid,
                    fld_staff_name = :name, fld_staff_gender = :gender, fld_staff_phone = :phone, fld_staff_email = :email, fld_staff_role = :role, fld_staff_pass = :pass WHERE fld_staff_num = :oldsid");
   
            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
       
            $sid = $_POST['sid'];
            $name = $_POST['name'];
            $gender =  $_POST['gender'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $pass = $_POST['pass'];
            $oldsid = $_POST['oldsid'];

            $stmt->execute();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error while updating: " . $e->getMessage();
            header("LOCATION: {$_SERVER['REQUEST_URI']}");
            exit();
        }
    } else {
        $_SESSION['error'] = "Sorry, but you don't have permission to update customer.";
    }

    header("LOCATION: {$_SERVER['PHP_SELF']}");
    exit();
}


//Delete
if (isset($_GET['delete'])) {
    if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
        try {
             $stmt = $conn->prepare("DELETE FROM tbl_staffs_a174485_pt2 where fld_staff_num = :sid");
            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

            $sid = $_GET['delete'];

            $stmt->execute();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Sorry, but you don't have permission to delete staff.";
    }

    header("LOCATION: {$_SERVER['PHP_SELF']}");
    exit();
}

//Edit
if (isset($_GET['edit'])) {
    if (isset($_SESSION['user']) && $_SESSION['user']['fld_staff_role'] == 'Admin') {
        try {
            $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a174485_pt2 where fld_staff_num = :sid");
            $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

            $sid = $_GET['edit'];

            $stmt->execute();

            $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
            header("LOCATION: {$_SERVER['PHP_SELF']}");
            exit();
        }
    } else {
        $_SESSION['error'] = "Sorry, but you don't have permission to edit a staff.";
        header("LOCATION: {$_SERVER['PHP_SELF']}");
        exit();
    }
}
$conn = null;
