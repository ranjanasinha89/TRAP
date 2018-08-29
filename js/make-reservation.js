$(document).ready(function () {

    $('#datetimepicker').datetimepicker();

    function validateEmail(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }

    function validateDateTime(value) {
      var matches = value.match(/^(\d{2})\.(\d{2})\.(\d{4}) (\d{2}):(\d{2}):(\d{2})$/);
      var ret = false;

      if (matches === null) {
        // invalid
      } else {
        // now lets check the date sanity
        var year = parseInt(matches[3], 10);
        var month = parseInt(matches[2], 10) - 1; // months are 0-11
        var day = parseInt(matches[1], 10);
        var hour = parseInt(matches[4], 10);
        var minute = parseInt(matches[5], 10);
        var second = parseInt(matches[6], 10);
        var date = new Date(year, month, day, hour, minute, second);
        if (date.getFullYear() !== year ||
          date.getMonth() != month ||
          date.getDate() !== day ||
          date.getHours() !== hour ||
          date.getMinutes() !== minute ||
          date.getSeconds() !== second
        ) {
        } else {
          ret = true;
        }
      }
      return ret;
    }

    function checkDateTime(element) {
      if (!Date.parse(element)) {
        return false;
      } else {
        return true;
      }
    }

    function validatePhonenumber(str) {
      var phoneRegEx = /^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,3})|(\(?\d{2,3}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/;
      var isphone = phoneRegEx.test(str);
      return isphone;
    }

    $("#reservation-request").submit(function(event) {
      event.preventDefault();
      var $form = $(this),
        clientName = $form.find("input[name='clientName']").val(),
        clientEmail = $form.find("input[name='clientEmail']").val(),
        clientMob = $form.find("input[name='clientMob']").val(),
        eventName = $form.find("input[name='eventName']").val(),
        eventLocation = $form.find("input[name='eventLocation']").val(),
        eventDescription = $('textarea#description').val(),
        eventDateTime = $form.find("input[name='eventDateTime']").val(),
        url = $form.attr("action");

      // console.log("Client name: " + clientName);
      // console.log("clientEmail: " + clientEmail);
      // console.log("clientMob: " + clientMob);
      // console.log("eventName: " + eventName);
      // console.log("eventLocation: " + eventLocation);
      // console.log("eventDescription: " + eventDescription);
      // console.log("Eevent data and time:" + eventDateTime);
      // console.log('action url: ' + url);

      if (clientName == null || clientName == "") {
        alert("Please enter your name.");
        return false;
      }
      if (!validatePhonenumber(String(clientMob))) {
        alert('Invalid Phone Number entered!');
        return false;
      }
      if (!validateEmail(clientEmail)) {
        alert('Invalid Email address!');
        return false;
      }
      if (!checkDateTime(eventDateTime)) {
        console.error('Invalid date/time');
        alert("Please enter valid date/time!");
        return false;
      }

      var $inputs = $form.find("input, select, button, textarea");
      $inputs.prop("disabled", true);
      var posting = $.post(url, {
        clientName: clientName,
        clientEmail: clientEmail,
        clientMob: clientMob,
        eventName: eventName,
        eventLocation: eventLocation,
        description: eventDescription,
        eventDateTime: eventDateTime
      });
      posting.success(function(data) {
        // console.log('Success data: ' + JSON.stringify(data));
        if (data.error) {
          // handle the error
          console.error('ERROR in server: ' + data.error.msg);
          //throw data.error.msg;
        } else {
          alert("Thank you for contacting us! Someone will shortly get back to you.");
        }
      });
      posting.fail(function(data) {
        // console.log('FAIL data: ' + JSON.stringify(data));
        // console.error('FAIL: data.Message => ' + data.responseText);
        if (data.error) {
          // handle the error
          console.error('ERROR in server: ' + data.error);
          alert("Unknown server error! Try again later.");
        }
      });
      posting.always(function() {
        // Reenable the inputs
        $form[0].reset();
        //console.log('Enabling inputs from always');
        $inputs.prop("disabled", false);
      });
    });
});
