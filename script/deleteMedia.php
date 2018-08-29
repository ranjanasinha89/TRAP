<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$media_id = $_POST["media_id"];
$media_location = "/opt/lampp/htdocs/TRAPwebsite/".$_POST["media_location"];
echo $media_id."</br>";
echo $media_location."</br>";
chown($media_location, 666);

if (unlink($media_location)) {
    echo 'success';
} else {
    echo 'fail';
}
$queryUpd = "DELETE FROM media WHERE  media_id=".$_POST["media_id"];
// echo "$queryUpd";
//$result = $db_handle->executeUpdate("UPDATE event set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  event_id=".$_POST["event_id"]);
$result = $db_handle->executeUpdate($queryUpd);
?>
