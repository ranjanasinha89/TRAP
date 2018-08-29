<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$doc_location = "/opt/lampp/htdocs/TRAPwebsite/".$_POST["doc_location"];

chown($doc_location, 666);

if (unlink($doc_location)) {
    echo 'success';
} else {
    echo 'fail';
}
$queryUpd = "DELETE FROM documents WHERE  doc_id=".$_POST["doc_id"];
// echo "$queryUpd";
//$result = $db_handle->executeUpdate("UPDATE event set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  event_id=".$_POST["event_id"]);
$result = $db_handle->executeUpdate($queryUpd);

//header('Location: uploadDocument.php');
?>
