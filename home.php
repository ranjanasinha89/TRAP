<?php
require_once('script/dbcontroller.php');
function make_slide_indicators()
{
  $db_handle = new DBController();
  $sql = "SELECT * FROM gallery_image ORDER BY image_id ASC";
  $faq = $db_handle->runQuery($sql);
  $output = '';
  $count = 0;
  foreach($faq as $k=>$v) {
    if($count == 0)
    {
      $output .= '
      <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
      ';
    }
    else
    {
      $output .= '
      <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
      ';
    }
    $count = $count + 1;
  }
  return $output;
}

function make_slides()
{
  $db_handle1 = new DBController();
  $sql = "SELECT * FROM gallery_image ORDER BY image_id ASC";
  $data = $db_handle1->runQuery($sql);
  $output = '';
  $count = 0;
  foreach($data as $k=>$v) {
    if($count == 0)
    {
      $output .= '<div class="item active">';
    }
    else
    {
      $output .= '<div class="item">';
    }
    $PATH = str_replace('/var/www/html/src/','', $data[$k]["image_location"]);

    $output .= '
      <img src="'.$PATH.'" alt="'.$data[$k]["image_caption"].'" />
      <div class="carousel-caption">
      <h3>'.$data[$k]["image_caption"].'</h3>
      </div>
      </div>
      ';
    $count = $count + 1;
  }
  return $output;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/navbar-style.css">
  <link rel="stylesheet" href="css/home-style.css">
  <script src="js/home-script.js"></script>
  <title>home</title>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <?php include('inc/navbar.php'); ?>
  <!--Gallery-->
  <!-- Indicators -->
  <div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php echo make_slide_indicators(); ?>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
     <?php echo make_slides(); ?>
    </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
     <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
     <span class="sr-only">Next</span>
    </a>
  </div>

  <!--Band Info-->
<div id="band" class="container text-center">
 <h2><strong>T.R.A.P.</strong></h2>
 <p><strong>@theradicalarrayproject</strong></p>
 <p>The Radical Array Project - T.R.A.P is an experimental Band from Kolkata.
   As told by many, we are one of the most promising act in the city.
   We would love to perform at your prestigious event.</p>
  <br>
  <div class="row">
    <div class="col-sm-4">
      <p class="text-center"><strong>Swapnabha Papai Roy</strong></p>
      <a href="#demo1" data-toggle="collapse">
        <img src="images/groupInfo/BM1.jpg" class="img-circle person" alt="Johny" width="255" height="255">
      </a>
      <div id="demo1" class="collapse">
        <p>The Bassist</p>
        <p>Loves long walks on the beach</p>
        <p>Member since 2012</p>
      </br>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>Bhaswar Sen</strong></p>
      <a href="#demo2" data-toggle="collapse">
        <img src="images/groupInfo/BM2.jpg" class="img-circle person" alt="Bony" width="255" height="255">
      </a>
      <div id="demo2" class="collapse">
        <p>The Mad Violinist</p>
        <p>Enjoys a cup of tea now-and-then</p>
        <p>Member since 2012</p>
        </br>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>Anupam Pyne</strong></p>
      <a href="#demo3" data-toggle="collapse">
        <img src="images/groupInfo/BM3.jpg" class="img-circle person" alt="Pony" width="255" height="255">
      </a>
      <div id="demo3" class="collapse">
        <p>Keyboardist</p>
        <p>Crazy fan of Kolkata Knight Riders</p>
        <p>CMember since 2012</p>
        </br>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <p class="text-center"><strong>Suanjito Dutta</strong></p>
      <a href="#demo4" data-toggle="collapse">
        <img src="images/groupInfo/BM4.jpg" class="img-circle person" alt="Johny" width="255" height="255">
      </a>
      <div id="demo4" class="collapse">
        <p>The drummer</p>
        <p>Loves long walks on the beach</p>
        <p>Member since 1988</p>
        </br>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>Ronnie Chatterjee</strong></p>
      <a href="#demo5" data-toggle="collapse">
        <img src="images/groupInfo/BM5.jpg" class="img-circle person" alt="Bony" width="255" height="255">
      </a>
      <div id="demo5" class="collapse">
        <p>Guitarist and Lead Vocalist</p>
        <p>Loves long walks on the beach</p>
        <p>Member since 1988</p>
        </br>
      </div>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><strong>Arijit Paul</strong></p>
      <a href="#demo6" data-toggle="collapse">
        <img src="images/groupInfo/ArijitPaul.jpg" class="img-circle person" alt="Pony" width="255" height="255">
      </a>
      <div id="demo6" class="collapse">
        <p>Lead Vocalist</p>
        <p>Loves long walks on the beach</p>
        <p>Member since 1988</p>
        </br>
      </div>
    </div>
  </div>
</div>

<!--Contact Form-->
<div id="contact" class="container-fluid">
  <div class="row">
    <div class="col-md-8">
      <h3 class="text-center">Talk to us</h3>
      <p class="text-center"><em>We love our fans!</em></p>
      <div class="row test">
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <p class="pull-right">Fan? Drop a note.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="pull-right"><span class="glyphicon glyphicon-map-marker"></span>Kolkata, India</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="pull-right"><span class="glyphicon glyphicon-phone"></span>Phone: +91 98302-34838</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="pull-right"><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p class="pull-right">Follow us on</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <a class="pull-right" href="https://www.facebook.com/theradicalarrayproject/">
                <img title="Facebook" alt="Facebook" src="images/widgets/facebook.png" width="35" height="35" />
              </a>
              <a class="pull-right" href="https://www.instagram.com/trapindia_official/">
                <img title="Instagram" alt="Instagram" src="images/widgets/instagram.png" width="35" height="35" />
              </a>
              <a class="pull-right" href="https://www.youtube.com/channel/UC-wYklxb1kBxs90ZfXGs45w">
                <img title="Youtube" alt="Youtube" src="images/widgets/youtube.png" width="35" height="35" />
              </a>
              <a class="pull-right" href="https://soundcloud.com/the-radical-array-project">
                <img title="Soundcloud" alt="Soundcloud" src="images/widgets/soundcloud.png" width="35" height="35" />
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <form action="script/upload_fanmail.php" method="post" enctype="multipart/form-data" name="fan_uploads" id="fan_uploads">
            <div class="row">
              <div class="col-sm-6 form-group">
                <input class="form-control" id="name" name="name" placeholder="Name - What would you like us to call you" type="text" required>
              </div>
              <div class="col-sm-6 form-group">
                <input class="form-control" id="email" name="email" placeholder="email - so that we can contact you" type="email" required>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 form-group">
                <label for="exampleInputFile">Anything you want to share with us?</label>
                <input id="fileToUpload" name="fileToUpload" id="fileToUpload" type="file" class="file" data-show-preview="true">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 form-group">
                <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
                <input class="btn btn-info pull-right" type="submit" value="Send" name="submit">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <h2 class="text-center">Others have sent us their love!!</h2>
      <ul class="list-group pre-scrollable">
        <?php
        require_once('script/dbcontroller.php');
        $db_handle = new DBController();
        $sql = "SELECT * FROM fan_mail_repo where status = 'published' order by encounter_id desc ";
        $faq = $db_handle->runQuery($sql);
        foreach($faq as $k=>$v) {
        ?>
        <li class="list-group-item list-group-item-dark text-center"><span class="glyphicon glyphicon-heart"></span><?php echo $faq[$k]["fanName"];?> sent :</br>
          <?php echo $faq[$k]["comments"];?></br>
          <a href="<?php echo $faq[$k]["filename"];?>" download>
            <image src="<?php echo $faq[$k]["filename"];?>" width="255" height="255" >
          </a>
          </br>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p>Website created and maintained by RS</p>
</footer>

</body>
</html>
