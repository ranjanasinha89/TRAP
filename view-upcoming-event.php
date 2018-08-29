<!DOCTYPE html>
<html lang="en">
<head>
 <title>T.R.A.P. Events</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5e6pgwM6I_HkK8WIuGhHQ4sKBqs6FxfQ"></script>
 <!-- Font Awesome -->
 <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
 <link rel="stylesheet" href="css/view-upcoming-events-style.css">
 <link rel="stylesheet" href="css/navbar-style.css">
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<?php include('inc/navbar.php'); ?>
<!--Upcoming Event Dates-->
<div id="tour" class="container">
  <div class="bg-1">
    <h3 class="text-center">Upcoming Events</h3>
    <p class="text-center">Hope to see you there!!</p>
      <table id="showEvent" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Event</th>
            <th>Date & Time</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once('script/dbcontroller.php');
          $db_handle = new DBController();
          $sql = "SELECT * FROM event WHERE event_status = 'upcoming'";
          $faq = $db_handle->runQuery($sql);
          
          foreach ($faq as $k=>$v) {
              ?>
          <tr data-toggle="collapse" data-target="#location<?php echo $faq[$k]["event_id"]; ?>" class="clickable">
            <td><?php echo $k+1; ?></td>
            <td><?php echo $faq[$k]["event_name"]; ?></td>
            <td><?php echo $faq[$k]["event_date_time"]; ?></td>
          </tr>
          <tr>
            <td colspan="12">
              <div id="location<?php echo $faq[$k]["event_id"]; ?>" class="collapse">
                <?php echo $faq[$k]["event_location"]; ?>
                <a href="#myMapModal" class="btn btn-info btn-lg pull-right" data-toggle="modal">Directions</a>
                <div class="modal fade" id="myMapModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Location</h4>
                      </div>
                      <div class="modal-body"><div class="container"></div>
                        <div class="container">
                          <div class="row">
                            <div id="map-canvas" class=""></div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                    <!-- /.modal-content -->

                  <?php
                    $lati       =null;
                    $longi      =null;
                    $address    = $faq[$k]["event_location"];
                    $address    = urlencode($address);//properly encode the url
                    // google map geocode api url
                    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";//we are getting the response in json
                    // get the json response
                    $resp_json = file_get_contents($url);
                    // decode the json
                    $resp = json_decode($resp_json, true);
                    if ($resp['status']=='OK') {
                      // echo "string1";
                      // get the longtitude and latitude data
                      $lat = $resp['results'][0]['geometry']['location']['lat'];
                      $long = $resp['results'][0]['geometry']['location']['lng'];
                      // echo "<h2>LAT: ".$lat." LONG:".$long."</h2>";
                      ?>
                      <script type="text/javascript">
                        var map;
                        var lati     = <?php echo $lat ?>;
                        var longi    = <?php echo $long ?>;
                        var map;
                        var myCenter =  new google.maps.LatLng(lati, longi);
                        var marker   =  new google.maps.Marker({
                            position:myCenter
                        });
                        function initialize() {
                          var mapProp = {
                            center:myCenter,
                            zoom: 14,
                            draggable: false,
                            scrollwheel: false,
                            mapTypeId:google.maps.MapTypeId.ROADMAP
                          };
                          var contentString = "Latitude: " + lati+" Longitude: "+longi;
                          map=new google.maps.Map(document.getElementById("map-canvas"),mapProp);
                          marker.setMap(map);
                          google.maps.event.addListener(marker, 'click', function() {
                            infowindow.setContent(contentString);
                            infowindow.open(map, marker);
                          });
                        };
                        google.maps.event.addDomListener(window, 'load', initialize);
                        google.maps.event.addDomListener(window, "resize", resizingMap());
                          $('#myMapModal').on('show.bs.modal', function() {
                             //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
                             resizeMap();
                          })
                          function resizeMap() {
                             if(typeof map =="undefined") return;
                             setTimeout( function(){resizingMap();} , 400);
                          }
                          function resizingMap() {
                             if(typeof map =="undefined") return;
                             var center = map.getCenter();
                             google.maps.event.trigger(map, "resize");
                             map.setCenter(center);
                          }
                        </script>
                    <?php
                        }
                    ?>
                  </div>
                  <!-- /.modal-dialog -->
                </div>
              </div>
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</body>
</html>
