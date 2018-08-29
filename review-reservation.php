<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Review Reservation</title>
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
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <style>
    #signout{
      color: black;
    }
  </style>
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
      <!-- Navbar Right Menu -->
      <?php
        include('inc/navbar-admin.html');
      ?>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <?php
        include('inc/sidebar-admin.html');
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        T.R.A.P. Reservation!!
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Review Reservation</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Info boxes -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Reservation Requests!!</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="form">
                <table id="reviewTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Event#</th>
                      <th>Client Name</th>
                      <th>Client Email</th>
                      <th>Client Mob</th>
                      <th>Event Name</th>
                      <th>Event Location</th>
                      <th>Event Description</th>
                      <th>Event Date</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    require_once('script/dbcontroller.php');
                    $db_handle = new DBController();

                    $query = "SELECT * FROM reservation WHERE active_ind = 1";
                    $ret = $db_handle->runQuery($query);
                    $ind = 0;

                    foreach($ret as $vi){
                      $idx = "accordian".$ind;
                      echo "<tr data-toggle=\"collapse\" data-target=\"#$idx\" class=\"clickable\">";
                      echo "<td>";echo $vi['event_id'];echo "</td>";
                      echo "<td>";echo $vi['client_name'];echo "</td>";
                      echo "<td>";echo $vi['client_email'];echo "</td>";
                      echo "<td>";echo $vi['client_mob'];echo "</td>";
                      echo "<td>";echo $vi['event_name'];echo "</td>";
                      echo "<td>";echo $vi['event_location'];echo "</td>";
                      echo "<td>";echo $vi['event_description'];echo "</td>";
                      echo "<td>";echo $vi['event_date_time'];echo "</td>";
                      echo "</tr>";
                      echo "<tr>";
                      echo "<td colspan=\"12\">";
                      echo "<div id=\"$idx\" class=\"collapse\">";?>
                    <a type="button" class="btn btn-danger pull-right" href="script/rejectReservation.php?id=<?php echo $vi['event_id']; ?>">Reject</button>
                    <a type="button" class="btn btn-success pull-right" href="script/acceptReservation.php?id=<?php echo $vi['event_id']; ?>">Accept</button>
                    <?php
                      echo "</div>";
                      echo "</td>";
                      echo "</tr>";
                      $ind++;}
                      $conn = $db_handle->closeConn();
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Event#</th>
                      <th>Client Name</th>
                      <th>Client Email</th>
                      <th>Client Mob</th>
                      <th>Event Name</th>
                      <th>Event Location</th>
                      <th>Event Description</th>
                      <th>Event Date</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    include('inc/footer-admin.html');
  ?>
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
  <script src="dist/js/demo.js"></script>
  <script>
    $(function () {
      $('#reviewTable').DataTable({
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
