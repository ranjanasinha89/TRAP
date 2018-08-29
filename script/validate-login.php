<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
$error = "username/password incorrect";

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$query = "SELECT username, password FROM admin WHERE username='$username'
AND password='$password'";

$result = $db_handle->validateLogin($query);

if($result == "TRUE") {
  $_SESSION['username'] = $username;
  header("Location: http://localhost/TRAPwebsite/admin.php");
  exit();
} else {
    $_SESSION["error"] = $error;
    header("location: http://localhost/TRAPwebsite/login.php");
    exit();
}
?>
