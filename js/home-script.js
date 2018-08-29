$(document).ready(function() {
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  $("#fan_uploads").submit(function(event) {
    event.preventDefault();

    // console.log('fan_uploads::submission()');
    var $form = $(this),
      fanName = $form.find("input[name='name']").val(),
      fanEmail = $form.find("input[name='email']").val(),
      fileSelect = document.getElementById('fileToUpload'),
      file = fileSelect.files[0],
      fan_comment = $('textarea#comments').val(),
      url = $form.attr("action");

    // console.log('POST URL: ' + url);
    // console.log('FAN NAME: ' + fanName);
    // console.log('FAN EMAIL: ' + fanEmail);
    // console.log('FAN COMMENT: ' + fan_comment);
    if (file) {
      // console.log('FILE ' + JSON.stringify(file));
      // console.log('FAN UPLOAD : ' + file.name + ' FILE TYPE: ' + file.type + ' FILE SIZE: ' + file.size);
      var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
      if ($.inArray(file.type, ValidImageTypes) < 0) {
        // invalid file type code goes here.
        alert('File type not accepted for submission!\nPlease only upload photos.');
        $form[0].reset();
        return false;
      }
      if (file.size > 200 * 1024 * 1024) {
        alert('Sorry, maximum file size allowed for submission is 200 mb!');
        $form[0].reset();
        return false;
      }
    }
    var $inputs = $form.find("input, select, button, textarea");
    var formData = new FormData();
    formData.append('name', fanName);
    formData.append('email', fanName);
    formData.append('comments', fan_comment);
    if (file) {
      // console.log('Appending file data to the formdata');
      formData.append('fileToUpload', file, file.name)
    }
    $inputs.prop("disabled", true);
    $.ajax({
      url: 'script/upload_fanmail.php',
      method: 'POST',
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function() {
        //$('#msg').html('Loading......');
        // console.log('Sending data');
      },
      success: function(data) {
        // console.log('SUCCESS:: ' + JSON.stringify(data));
        // if (data.error) {
        //   console.error('ERROR: ' + JSON.stringify(data.error));
        // }
        alert('Thanks for your submission!');
      },
      error: function(data) {
        console.error('FAILED:: ' + JSON.stringify(data));
        alert('Server error, your submission failed!');
      },
      complete: function(data) {
        console.log('ALWAYS: ' + JSON.stringify(data));
        $form[0].reset();
        //console.log('Enabling inputs from always');
        $inputs.prop("disabled", false);
      }
    });
  });

  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function() {

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
