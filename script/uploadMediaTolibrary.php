<?php
require_once('dbcontroller.php');
$db_handle = new DBController();
echo "R: ".$_POST["btnSubmit"];
echo "<br>";
echo "Files: ".$_FILES["files"]["tmp_name"];
echo "<br>";
if(isset($_POST["btnSubmit"]))
{
  $errors = array();
  $uploadedFiles = array();
  $aud_extension = array("mp3", "wav");
  $vid_extension = array("mp4","aac");
  $bytes = 1024;
  $KB = 1024;
  $MB = 100;
  $totalBytes = $bytes * $KB *$MB;
  $UploadFolder = "/opt/lampp/htdocs/TRAPwebsite/media/";

  $counter = 0;

  foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
    $temp = $_FILES["files"]["tmp_name"][$key];
    $name = $_FILES["files"]["name"][$key];
    if(empty($temp))
    {
      break;
    }

    $counter++;
    $UploadOk = true;

    if($_FILES["files"]["size"][$key] > $totalBytes)
    {
      $UploadOk = false;
      array_push($errors, $name." file size is larger than the 100 MB.");
    }

    $ext = pathinfo($name, PATHINFO_EXTENSION);
    if(in_array($ext, $aud_extension) == true){
      $file_type = 'audio';
    }elseif (in_array($ext, $vid_extension) == true) {
      $file_type = 'video';
    }else{
      $UploadOk = false;
      array_push($errors, $name." is invalid file type.");
    }

    if(file_exists($UploadFolder."/".$name) == true){
      $UploadOk = false;
      array_push($errors, $name." file is already exist.");
    }

    if($UploadOk == true){

      $caption = "";
      move_uploaded_file($temp, $UploadFolder.$name);
      $target_file = "media/".$name;

      $query = "INSERT INTO media (media_id, media_location, caption, media_type, extension)
      VALUES(DEFAULT, '$target_file', '$caption', '$file_type', '$file_type/$ext')";

      $ret = $db_handle->insertQuery($query);
      array_push($uploadedFiles, $name);
    }
  }

  if($counter>0){
    if(count($errors)>0)
    {
      echo "<b>Errors:</b>";
      echo "<br/><ul>";
      foreach($errors as $error)
      {
        echo "<li>".$error."</li>";
      }
      echo "</ul><br/>";
    }

    if(count($uploadedFiles)>0){
      echo "<b>Uploaded Files:</b>";
      echo "<br/><ul>";
      foreach($uploadedFiles as $fileName)
      {
        echo "<li>".$fileName."</li>";
      }
      echo "</ul><br/>";

      echo count($uploadedFiles)." file(s) are successfully uploaded.";
    }
  }
  else{
    echo "Please, Select file(s) to upload.";
  }
}
header('Location: http://localhost/TRAPwebsite/uploadMedia.php');
?>
