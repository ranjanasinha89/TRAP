<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$event_name = $_POST["event_name"];
$event_location = $_POST["event_location"];
$event_date_time = $_POST["event_date_time"];
$client_name = $_POST["client_name"];
$client_email= $_POST["client_email"];
$client_mob = $_POST["client_mob"];
$queryUpd = "INSERT INTO event (event_id, event_name, event_location, event_date_time, client_name, client_email, client_mob, event_status)
VALUES (DEFAULT, '$event_name', '$event_location', '$event_date_time', '$client_name', '$client_email', $client_mob, 'added')";
echo "$queryUpd";
//$result = $db_handle->executeUpdate("UPDATE event set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  event_id=".$_POST["event_id"]);
$result = $db_handle->executeUpdate($queryUpd);
?>
  
