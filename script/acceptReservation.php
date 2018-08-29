<?php
  require_once('dbcontroller.php');
  $id=$_REQUEST['id'];
  $db_handle = new DBController();

  $query = "SELECT * FROM reservation WHERE event_id = $id";
  $retEvent = $db_handle->runQuery($query);

  foreach($retEvent as $vi){
    $eventName = $vi['event_name'];
    $eventLocation = $vi['event_location'];
    $eventDateTime = $vi['event_date_time'];
    $clientName = $vi['client_name'];
    $clientEmail = $vi['client_email'];
    $clientMob = $vi['client_mob'];
    $reservationId = $vi['event_id'];

    $queryIns = "INSERT INTO event (event_id, event_name, event_location, event_date_time, client_name, client_email, client_mob, event_status, reservation_id)
     VALUES (DEFAULT,'$eventName',
      '$eventLocation',
      '$eventDateTime',
      '$clientName',
      '$clientEmail',
      '$clientMob',
      'added',
      '$reservationId')";
  }

  $ins = $db_handle->insertQuery($queryIns);

  $queryUpd = "UPDATE reservation SET active_ind = 'false' WHERE event_id = $id";
  $upd = $db_handle->executeUpdate($queryUpd);

  $db_handle->closeConn();
  header('Location: http://localhost/TRAPwebsite/review-reservation.php');
  exit;
 ?>
