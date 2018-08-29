<?php
require_once('script/dbcontroller.php');
$db_handle = new DBController();
$sql = "SELECT * from documents order by doc_id desc";
$faq = $db_handle->runQuery($sql);
$rowCount = $db_handle->numRows($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Upload Document</title>
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
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script>
    function showEdit(editableObj) {
      $(editableObj).css("background","#FFF");
    }

    function saveToDatabase(editableObj,column,doc_id) {
      console.log(column);
      console.log(doc_id);
      $(editableObj).css("background","#FFF url(images/admin-img/loaderIcon.gif) no-repeat right");
      $.ajax({
        url: "script/updateDocCaption.php",
        type: "POST",
        data:'column='+column+'&editval='+editableObj.innerHTML+'&doc_id='+doc_id,
        success: function(data){
          $(editableObj).css("background","#FDFDFD");
        }
       });
    }

    function deleteDoc(doc_location, doc_id){
       console.log(doc_location);
       console.log(doc_id);
      $.ajax({
        url: "script/deleteDoc.php",
        type: "POST",
        data: '&doc_location='+doc_location+'&doc_id='+doc_id,
        success: function(data){
          //$("#DocTable").load(window.location + "#DocTable");
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
    <a href="index2.html" class="logo">
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
      <!-- Navbar Right Menu -->
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
        Publish Documents
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Publish Documents</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Info boxes -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Add-Edit-Remove Document</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div align="right">
               <button type="button" name="add" id="add" class="btn btn-success" data-toggle="modal" data-target="#addDocModal">Add</button>
              </div>
              <!-- The Modal -->
              <div id="addDocModal" class="modal fade" role="dialog">
               <div class="modal-dialog">
                <div class="modal-content">
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Doc</h4>
                 </div>
                 <div class="modal-body">
                  <form id="doc_form" action="script/uploadDoc.php" method="post" enctype="multipart/form-data">
                   <p><label>Select pdf</label>
                   <input type="file" name="files[]" multiple="multiple"/></p><br />
                   <input type="submit" value="Insert" name="buttonSubmit" class="btn btn-info" />
                  </form>
                 </div>
                 <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
                </div>
               </div>
              </div>
              <table id="DocTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id#</th>
                    <th>Doc Preview</th>
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
                    <td>
                      <object width="400" height="200" data="<?php echo $faq[$k]["doc_location"]; ?>" type="<?php echo $faq[$k]["extension"];?>">
                    </td>
                    <td contenteditable="true" onBlur="saveToDatabase(this,'doc_comment','<?php echo $faq[$k]["doc_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["doc_comment"]; ?></td>
                    <td>
                    <a type='button' class="btn btn-danger" onClick="deleteDoc('<?php echo $faq[$k]["doc_location"]; ?>','<?php echo $faq[$k]["doc_id"]; ?>')">Delete</button>
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
  <?php include('inc/footer-admin.html'); ?>
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
    $('#DocTable').DataTable({
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
