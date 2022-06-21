<?php
session_start();

$servername = "lrgs.ftsm.ukm.my";
$username = "a174485";
$password = "giantbluehamster";
$dbname = "a174485";

$db = null;
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
