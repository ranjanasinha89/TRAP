<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

$queryUpd = "UPDATE fan_mail_repo SET status = 'published' WHERE  encounter_id=".$_POST["encounter_id"];
// echo "$queryUpd";
//$result = $db_handle->executeUpdate("UPDATE event set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  event_id=".$_POST["event_id"]);
$result = $db_handle->executeUpdate($queryUpd);
?>
