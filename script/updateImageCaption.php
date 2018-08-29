<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$queryUpd = "UPDATE gallery_image set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  image_id=".$_POST["image_id"];
$result = $db_handle->executeUpdate($queryUpd);
?>
