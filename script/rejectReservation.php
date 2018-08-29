<?php
  require_once('dbcontroller.php');
  $id=$_REQUEST['id'];

  $db_handle = new DBController();

  $queryUpd = "UPDATE reservation SET active_ind = 'false' WHERE event_id = $id";

  $upd = $db_handle->executeUpdate($queryUpd);

  $db_handle->closeConn();
  header('Location: http://localhost/TRAPwebsite/review-reservation.php');
  exit;
 ?>
