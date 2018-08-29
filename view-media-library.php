<!DOCTYPE html>
<html lang="en">
<head>
  <title>Music Library</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/lang/en-gb.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js"></script>
  <link rel="stylesheet" href="css/navbar-style.css">
  <link rel="stylesheet" href="css/view-media-library.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
  <?php include('inc/navbar.php'); ?>
<div class="container">
<div class="row text-center">
  <h2>Some fun and Music straight from our heart!!</h2>
</div>
<?php
require_once('script/dbcontroller.php');
$db_handle = new DBController();
$sql = "SELECT * from media order by media_id desc";
$faq = $db_handle->runQuery($sql);

foreach($faq as $k=>$v) {
?>
<div class="row">
  <div class="col-md-12 col">
    <?php if ($faq[$k]["media_type"] == 'audio'){ ?>
    </br>
      <audio width="100%" controls>
        <source src="<?php echo $faq[$k]["media_location"]; ?>" type="<?php echo $faq[$k]["extension"];?>">
         Your browser does not support the audio element.
      </audio>
      <?php
        } elseif ($faq[$k]["media_type"] == 'video'){
      ?>
        <video width="100%" height="620" controls>
         <source src="<?php echo $faq[$k]["media_location"]; ?>" type="<?php echo $faq[$k]["extension"];?>">
           Your browser does not support the video tag.
        </video>
      <?php
      }
      ?>
      <h3 id = "media Caption"><?php echo $faq[$k]["caption"]?></h3>
  </div>
</div>
<?php } ?>

</body>
</html>
