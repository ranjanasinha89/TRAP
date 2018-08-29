<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="css/navbar-style.css">
    <link rel="stylesheet" href="css/reservation-style.css">
    <script src="js/make-reservation.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/lang/en-gb.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.0.0/js/bootstrap-datetimepicker.min.js"></script>
    <title>reservation</title>
    <link rel="stylesheet" href="css/navbar-style.css">
  </head>
  <body data-spy="scroll" data-target=".navbar" data-offset="50">
    <?php include('inc/navbar.php'); ?>
    </br>
    </br>
    <div class="center">
      <h1>We would love to perform at your event!!</h1>
      <form action="script/post-reservation.php" method="post" name="reservation-request" id="reservation-request">
        <div class="form-group">
          <label for="InputName">Name</label>
          <input type="name" class="form-control" id="InputName" name="clientName" aria-describedby="nameHelp" placeholder="Enter your Full Name">
        </div>
        <div class="form-group">
          <label for="InputEmail">Email address</label>
          <input type="email" class="form-control" id="InputEmail" name="clientEmail" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="InputMob">Mobile Number</label>
          <input type="mob" class="form-control" id="InputMob" name="clientMob" aria-describedby="MobHelp" placeholder="Enter 10 digit mobile number">
        </div>
        <div class="form-group">
          <label for="InputEventName">Event Name</label>
          <input type="eventName" class="form-control" id="InputEventName" name="eventName" aria-describedby="eventNameHelp" placeholder="Enter the Event Name here">
        </div>
        <div class="form-group">
          <label for="InputLocation">Event Location</label>
          <input type="location" class="form-control" id="InputLocation" name="eventLocation" aria-describedby="locationHelp" placeholder="Enter the tentative event address">
        </div>
        <div class="form-group">
          <label for="description">Write a few lines about your event</label>
          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="date">Event Date Time</label>
          <div class='input-group date' id='datetimepicker'>
            <input type='text' class="form-control" name="eventDateTime"/>
            <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>
        </div>

        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <script>
      includeHTML();
    </script>
  </body>
</html>
