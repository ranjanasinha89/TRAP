<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
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
        <!-- <div include-html-navbar="inc/navbar-admin.html"></div> -->
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
          T.R.A.P. at a glance!!
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Completed Shows</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="table-completed" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Event #</th>
                    <th>Event Name</th>
                    <th>Event Location</th>
                    <th>Event Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      require_once('script/dbcontroller.php');
                      $db_handle = new DBController();

                      $query = "SELECT event_id, event_name, event_location, event_date_time FROM event WHERE event_status = 'completed'";
                      $compEvent = $db_handle->runQuery($query);
                      foreach($compEvent as $v){
                        echo "<tr><td>";echo $v['event_id'];echo "</td>";
                        echo "<td>";echo $v['event_name'];echo "</td>";
                        echo "<td>";echo $v['event_location'];echo "</td>";
                        echo "<td>";echo $v['event_date_time'];echo "</td>";
                        echo "</tr>";
                      }
                      $conn = $db_handle->closeConn();
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Event #</th>
                    <th>Event Name</th>
                    <th>Event Location</th>
                    <th>Event Date</th>
                  </tr>
                  </tfoot>
                </table>
                <!-- /.row -->
              </div>
              <!-- ./box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Upcoming Shows</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="table-upcoming" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Event #</th>
                    <th>Event Name</th>
                    <th>Event Location</th>
                    <th>Event Date</th>
                    <th>Client Name</th>
                    <th>Client email</th>
                    <th>Client Mob</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    require_once('script/dbcontroller.php');
                    $db_handle = new DBController();

                    $query = "SELECT event_id, event_name, event_location, event_date_time, client_name, client_email, client_mob FROM event WHERE event_status = 'upcoming'";
                    $upcEvent = $db_handle->runQuery($query);
                    foreach($upcEvent as $vi){
                      echo "<tr><td>";echo $vi['event_id'];echo "</td>";
                      echo "<td>";echo $vi['event_name'];echo "</td>";
                      echo "<td>";echo $vi['event_location'];echo "</td>";
                      echo "<td>";echo $vi['event_date_time'];echo "</td>";
                      echo "<td>";echo $vi['client_name'];echo "</td>";
                      echo "<td>";echo $vi['client_email'];echo "</td>";
                      echo "<td>";echo $vi['client_mob'];echo "</td>";
                      echo "</tr>";
                    }
                    $conn = $db_handle->closeConn();
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Event #</th>
                    <th>Event Name</th>
                    <th>Event Location</th>
                    <th>Event Date</th>
                    <th>Client Name</th>
                    <th>Client email</th>
                    <th>Client Mob</th>
                  </tr>
                  </tfoot>
                </table>
                <!-- /.row -->
              </div>
              <!-- ./box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
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
  <!-- DataTables -->
  <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard2.js"></script>
  <script src="dist/js/demo.js"></script>
  <script>
    $(function () {
      $('#table-upcoming').DataTable()
      $('#table-completed').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      })
    })
  </script>
</body>
</html>
