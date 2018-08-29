<?php
require_once('script/dbcontroller.php');
$db_handle = new DBController();
$sql = "SELECT * from event where event_status = 'added'";
$faq = $db_handle->runQuery($sql);
$rowCount = $db_handle->numRows($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pulish Events</title>
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
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWVINuwrJRw5m8Ip4xW_Kf4yPXb7qXOhs"></script> -->
  <style>
    #signout{
      color: black;
    }
  </style>
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<script>
function showEdit(editableObj) {
  $(editableObj).css("background","#FFF");
}

function saveToDatabase(editableObj,column,event_id) {
  $(editableObj).css("background","#FFF url(images/admin-img/loaderIcon.gif) no-repeat right");
  $.ajax({
    url: "script/editExistingEvent.php",
    type: "POST",
    data:'column='+column+'&editval='+editableObj.innerHTML+'&event_id='+event_id,
    success: function(data){
      $(editableObj).css("background","#FDFDFD");
    }
  });
}

function publishAsUpcoming(event_id, event_location){
  var key = "key=ngnpVJ927dAfZkEVDZJojkEuasTh1g2q";
  var geocoder = "http://www.mapquestapi.com/geocoding/v1/address";
  var address = geocoder + '?' + key + '&location=' + event_location;

  $.get(address, function(data, status){
    latitude = data.results[0].locations[0].displayLatLng.lat;
    longitude = data.results[0].locations[0].displayLatLng.lng;

    $.ajax({
      url: "script/publishEvent.php",
      type: "POST",
      data: '&event_id='+event_id+'&latitude='+latitude+'&longitude='+longitude,
      success: function(response){
        console.log('SUCCESS: '+JSON.stringify(response));
        $("#updateEvent").load(window.location + " #updateEvent");
      }
    });
  });
}

function deleteEvent(event_id){
  $.ajax({
    url: "script/deleteEvent.php",
    type: "POST",
    data: '&event_id='+event_id,
    success: function(response){
      $("#updateEvent").load(window.location + " #updateEvent");
    }
  });
}

function addNewEvent(){
  var client_name = document.getElementById("new_client_name").value;
  var client_email = document.getElementById("new_client_email").value;
  var client_mob = document.getElementById("new_client_mob").value;
  var event_name = document.getElementById("new_event").value;
  var event_location = document.getElementById("new_location").value;
  var event_date_time = document.getElementById("new_date_time").value;

  $.ajax({
    url:"script/insNewEvent.php",
    type: "POST",
    data:'&client_name='+client_name+'&client_email='+client_email+'&client_mob='+client_mob+'&event_name='+event_name+'&event_location='+event_location+'&event_date_time='+event_date_time,
    success: function(data){
      $("#updateEvent").load(window.location + " #updateEvent");
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
        Publish Upcoming T.R.A.P. Events
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Update Event List</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- Info boxes -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Edit & Publish Events!!</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <table id="updateEvent" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Event#</th>
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Client Mob</th>
                    <th>Event Name</th>
                    <th>Event Location</th>
                    <th>Event Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($rowCount > 0){
            		      foreach($faq as $k=>$v) {
            		  ?>
                  <tr class="table table-striped table-bordered">
          				<td><?php echo $k+1; ?></td>
                  <td contenteditable="true" onBlur="saveToDatabase(this,'client_name','<?php echo $faq[$k]["event_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["client_name"]; ?></td>
                  <td contenteditable="true" onBlur="saveToDatabase(this,'client_email','<?php echo $faq[$k]["event_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["client_email"]; ?></td>
                  <td contenteditable="true" onBlur="saveToDatabase(this,'client_mob','<?php echo $faq[$k]["event_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["client_mob"]; ?></td>
          				<td contenteditable="true" onBlur="saveToDatabase(this,'event_name','<?php echo $faq[$k]["event_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["event_name"]; ?></td>
          				<td contenteditable="true" onBlur="saveToDatabase(this,'event_location','<?php echo $faq[$k]["event_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["event_location"]; ?></td>
                  <td contenteditable="true" onBlur="saveToDatabase(this,'event_date_time','<?php echo $faq[$k]["event_id"]; ?>')" onClick="showEdit(this);"><?php echo $faq[$k]["event_date_time"]; ?></td>
                  <td>
                    <a type='button' class="btn btn-success" onClick="publishAsUpcoming('<?php echo $faq[$k]["event_id"]; ?>','<?php echo $faq[$k]["event_location"]; ?>')">Publish</button>
                    <a type='button' class="btn btn-danger" onClick="deleteEvent('<?php echo $faq[$k]["event_id"]; ?>')">Delete</button>
                  </td>
                  </tr>
              		<?php
              		  }
                  }
              		?>
                  <tr id="new_row">
                    <td> </td>
                    <td><input type="text" id="new_client_name"></td>
                    <td><input type="text" id="new_client_email"></td>
                    <td><input type="text" id="new_client_mob"></td>
                    <td><input type="text" id="new_event"></td>
                    <td><input type="text" id="new_location"></td>
                    <td><input type="text" id="new_date_time"></td>
                    <!-- <td><input type="button" value="Insert Row" onclick="addNewEvent();"></td> -->
                    <td>
                      <a type='button' class="btn btn-primary" onClick="addNewEvent()">Insert Row</button>
                    </td>
                  </tr>
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
      $('#updateEvent').DataTable({
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
