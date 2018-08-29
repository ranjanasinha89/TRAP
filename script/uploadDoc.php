<?php
if(isset($_POST["buttonSubmit"]))
{
  echo "Hello"."<br>";
  require_once('dbcontroller.php');
  $db_handle = new DBController();

  $errors = array();
  $uploadedFiles = array();
  $extension = array("pdf", "PDF");
  $bytes = 1024;
  $KB = 1024;
  $MB = 15;
  $totalBytes = $bytes * $KB *$MB;
  $UploadFolder = "/opt/lampp/htdocs/TRAPwebsite/documents";

  $counter = 0;

  foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
    echo "In here"."<br>";
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
      array_push($errors, $name." file size is larger than the 15 MB.");
    }

    $ext = pathinfo($name, PATHINFO_EXTENSION);
    if(in_array($ext, $extension) == true){
      $file_type = 'application';
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
      move_uploaded_file($temp,$UploadFolder."/".$name);
      $target_file = "documents/".$name;
      echo $target_file."<br>";
      echo $file_type."<br>";
      echo $ext."<br>";
      $query = "INSERT INTO documents VALUES (DEFAULT, '$target_file', '$caption', '$file_type/$ext')";

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

header('Location: http://localhost/TRAPwebsite/uploadDocument.php');
?>
