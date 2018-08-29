<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$queryUpd = "UPDATE media set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  media_id=".$_POST["media_id"];

$result = $db_handle->executeUpdate($queryUpd);
?>
