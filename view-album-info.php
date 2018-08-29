<!DOCTYPE html>
<html lang="en">
<head>
  <title>Released Albums</title>
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
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
  <?php include('inc/navbar.php'); ?>
<div class="container">
</br>
</br>
</br>
  <div class="row">
      <?php
      require_once('script/dbcontroller.php');
      $db_handle = new DBController();
      $sql = "SELECT * FROM album";
      $faq = $db_handle->runQuery($sql);
      $rowNum = $db_handle->numRows($sql);
      $count = 1;

      foreach($faq as $k=>$v) {
        if ($count % 2 == 1){
      ?>
          <div class="row">
      <?php }?>
        <div class="col-sm-6">
            <div class="card bg-light text-dark">
              <div class="cardheader">
                <img class="card-img-top" src="<?php echo $faq[$k]["album_image_location"]; ?>" alt="Card image" height="400px" width="400px">
              </div>
              <div class="card-body">
                <h4 class="card-title"><?php echo $faq[$k]["album_name"]?></h4>
                <p class="card-text" style="width:400px"><?php echo $faq[$k]["album_info"]?></p>
                <a href="<?php echo $faq[$k]["link_to_buy"];?>" class="btn btn-primary">Buy Album</a>
                </br>
              </div>
            </div>
            </br>
          </div>
        <?php
        if($count % 2 == 0){ ?>
          </div>
        <?php
        }
        $count++;
} ?>
</div>
</body>
</html>
