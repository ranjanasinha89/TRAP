<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
$newline = "</br>";
require_once('dbcontroller.php');
$db_handle = new DBController();
$clientName = $db_handle->removeEscChar($_POST["clientName"]);
$clientEmail = $_POST["clientEmail"];
$clientMob = $_POST["clientMob"];
$eventName = $db_handle->removeEscChar($_POST["eventName"]);
$eventLocation = $db_handle->removeEscChar($_POST["eventLocation"]);
$description = $db_handle->removeEscChar($_POST["description"]);
$eventDateTime = date("Y-m-d G:i:s", strtotime($_POST["eventDateTime"]));

$sql = "INSERT INTO reservation VALUES (DEFAULT, '$clientName', '$clientEmail',
    '$clientMob', '$eventName', '$eventLocation',
		'$description', '$eventDateTime', true)";

$faq = $db_handle->insertQuery($sql);

header('Content-Type: application/json');
try {
    if ($faq) {
        throw new Exception('DB_INSERT error', 500);
    }
    echo json_encode(array(
        'result' => 'success',
    ));
} catch (Exception $e) {
    echo json_encode(array(
        'error' => array(
            'msg' => 'Something went wrong',
            'code' => '500',
        ),
    ));
}
?>
