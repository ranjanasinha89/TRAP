<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$image_location = "/opt/lampp/htdocs/TRAPwebsite/".$_POST["filename"];
echo $image_location;

chown($image_location, 666);

if (unlink($image_location)) {
    echo 'success';
} else {
    echo 'fail';
}
$queryUpd = "UPDATE fan_mail_repo SET status = 'inactivate' WHERE  encounter_id=".$_POST["encounter_id"];
// echo "$queryUpd";
//$result = $db_handle->executeUpdate("UPDATE event set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  event_id=".$_POST["event_id"]);
$result = $db_handle->executeUpdate($queryUpd);
?>
