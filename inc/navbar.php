<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php">T.R.A.P.</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="home.php">HOME</a></li>
        <li><a href="#band">BAND</a></li>
        <li><a href="view-upcoming-event.php">EVENT</a></li>
        <li><a href="home.php#contact">CONTACT</a></li>
        <li><a href="view-media-library.php">MEDIA GALLERY</a></li>
        <li><a href="reservation.php">RESERVATION</a></li>
        <li><a href="view-album-info.php">ALBUMS</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">EXTRA
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a tabindex="-1" href="login.php">Admin</a></li>
            <!-- <li><a href="#">Documents</a></li> -->
            <li class="dropdown-submenu">
              <a class="doc" tabindex="-1" href="#">Documents<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php
                require_once('script/dbcontroller.php');
                $db_handle = new DBController();
                $sql = "SELECT * FROM documents";
                $faq = $db_handle->runQuery($sql);
                foreach($faq as $k=>$v) {
                ?>
                <li><a tabindex="-1" href="<?php echo $faq[$k]["doc_location"];?>" download><?php echo $faq[$k]["doc_comment"];?></a></li>
                <!-- <li><a tabindex="-1" href="#">2nd level dropdown</a></li> -->
              <?php } ?>
              </ul>
            </li>
          </ul>
        </li>
        <!-- <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li> -->
      </ul>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('.dropdown-submenu a.doc').on("click", function(e){
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
      });
    });
  </script>
</nav>
