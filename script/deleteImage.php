<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$image_id = $_POST["image_id"];
$image_location = "/opt/lampp/htdocs/TRAPwebsite/".$_POST["image_location"];

echo $image_id."</br>";
echo $image_location."</br>";
chown($image_location, 666);

if (unlink($image_location)) {
    echo 'success';
} else {
    echo 'fail';
}
$queryUpd = "DELETE FROM gallery_image WHERE  image_id=".$_POST["image_id"];
$result = $db_handle->executeUpdate($queryUpd);
?>
