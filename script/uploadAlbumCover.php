<?php
echo "Image varifiaction";
if(!empty($_FILES["fileToUpload"]["name"])){
  require_once('dbcontroller.php');
  $db_handle = new DBController();

  $target_dir = "/opt/lampp/htdocs/TRAPwebsite/images/album-cover";
  $target_file = $target_dir."/". basename($_FILES["fileToUpload"]["name"]);
  $name = basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      echo "<br>";
      echo $_FILES["fileToUpload"]["tmp_name"];
      echo "<br>";
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 2000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          $upload_dir = "images/album-cover/".$name;

          echo $upload_dir."<br>";

          $query = "INSERT INTO album VALUES (DEFAULT,'$upload_dir','','','')";

          $ret = $db_handle->insertQuery($query);
      }
  }
}
header('Location: http://localhost/TRAPwebsite/updateAlbumInfo.php');
exit;
?>
