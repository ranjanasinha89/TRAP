<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$queryUpd = "UPDATE event set event_status = 'upcoming', latitude=".$_POST["latitude"].",longitude=".$_POST["longitude"]." WHERE  event_id=".$_POST["event_id"];
$result = $db_handle->executeUpdate($queryUpd);
?>
