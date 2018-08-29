<?php
require_once('script/dbcontroller.php');
$db_handle = new DBController();
$sql = "SELECT * from media order by media_id desc";
$faq = $db_handle->runQuery($sql);
$rowCount = $db_handle->numRows($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Upload Media</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <style>
    #signout{
      color: black;
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script>
    function showEdit(editableObj) {
      $(editableObj).css("background","#FFF");
    }

    function saveToDatabase(editableObj,column,media_id) {
      $(editableObj).css("background","#FFF url(images/admin-img/loaderIcon.gif) no-repeat right");
      $.ajax({
        url: "script/updateMediaCaption.php",
        type: "POST",
        data:'column='+column+'&editval='+editableObj.innerHTML+'&media_id='+media_id,
        success: function(data){
          $(editableObj).css("background","#FDFDFD");
        }
       });
    }

    function deleteMedia(media_location, media_id){
      console.log(media_location);
      console.log(media_id);
      $.ajax({
        url: "script/deleteMedia.php",
        type: "POST",
        data: '&media_location='+media_location+'&media_id='+media_id,
        success: function(data){
          // $("#mediaTable").load(window.location + "#mediaTable");
          location.reload();
        }
      });
    }
  </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="admin.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">TRAP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>T.R.A.P.</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <?php include('inc/navbar-admin.html'); ?>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <?php include('inc/sidebar-admin.html'); ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Publish Media to the Library
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Publish media</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Info boxes -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add-Edit-Remove media</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div align="right">
               <button type="button" name="add" id="add" class="btn btn-success" data-toggle="modal" data-target="#addMediaModal">Add</button>
              </div>
              <!-- The Modal -->
              <div id="addMediaModal" class="modal fade" role="dialog">
               <div class="modal-dialog">
                <div class="modal-content">
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Media</h4>
                 </div>
                 <div class="modal-body">
                  <form id="media_form" action="script/uploadMediaTolibrary.php" method="post" enctype="multipart/form-data">
                   <p><label>Select Media</label>
                   <input type="file" name="files[]" multiple="multiple"/></p><br />
                   <input type="submit" value="Insert" name="btnSubmit" class="btn btn-info" />
                  </form>
                 </div>
                 <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
                </div>
               </div>
              </div>
              <table id="mediaTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id#</th>
                    <th>Media</th>
                    <th>Caption</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($rowCount > 0){
                    foreach($faq as $k=>$v) {
                  ?>
                  <tr>
                    <td><?php echo $k+1; ?></td>
                    <?php if ($faq[$k]["media_type"] == 'audio'){ ?>
                      <td>
                        <audio controls>
                          <source src="<?php echo $faq[$k]["media_location"]; ?>" type="<?php echo $faq[$k]["extension"];?>">
                           Your browser does not support the audio element.
                        </audio>
                      </td>
                    <?php
                  } elseif ($faq[$k]["media_type"] == 'video'){
                    ?>
                    <td>
                      <video width="320" height="240" controls>
                       <source src="<?php echo $faq[$k]["media_location"]; ?>" type="<?php echo $faq[$k]["extension"];?>">
                         Your browser does not support the video tag.
                      </video>
                    </td>
                    <?php
                    }
                    ?>
                    <td contenteditable="true" onBlur="saveToDatabase(this,'caption','<?php echo $faq[$k]["media_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["caption"]; ?></td>
                    <td>
                    <a type='button' class="btn btn-danger" onClick="deleteMedia('<?php echo $faq[$k]["media_location"]; ?>','<?php echo $faq[$k]["media_id"]; ?>')">Delete</button>
                    </td>
                  </tr>
                  <?php
                  }
                }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include('inc/footer-admin.html') ?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- ChartJS -->
<script src="bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
  $(function () {
    $('#mediaTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
