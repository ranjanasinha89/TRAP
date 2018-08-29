<?php
require_once('dbcontroller.php');
$db_handle = new DBController();

$fanName = $db_handle->removeEscChar($_POST["name"]);
$fanEmail   = $db_handle->removeEscChar($_POST["email"]);
$comment    = $db_handle->removeEscChar($_POST["comments"]);
$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_file = "";
if ($file_name) {
    $target_dir = "/opt/lampp/htdocs/TRAPwebsite/images/fanmail/";
    $target_file = $target_dir .basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    try {
        if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            throw new Exception('File upload failed', 500);
        }
    } catch (Exception $e) {
        echo json_encode(array(
          'error' => array(
              'msg' => 'File upload error',
              'code' => '500',
          ),
      ));
        header('HTTP/1.1 500 Internal Server Error');
        exit(0);
    }
}
$uploadedFile = "images/fanmail/".$file_name;
$query = "INSERT INTO fan_mail_repo VALUES (DEFAULT, '$fanName', '$fanEmail', '$uploadedFile', '$comment', 'added')";
try {
    $s = $db_handle->insertQuery($query);
    if ($s) {
      echo "shouldnt be here"."<br>";
        throw new Exception('DB_INSERT error', 500);
    }
    echo json_encode(array(
        // 'result' => 'success uploading fanmail sent from php server, upload_fanmail.php',
        'file_name' => $target_file,
        'file_type'=> $imageFileType,
        'msg' => 'success uploading fanmail sent from php server!',
        'code' => '200',
    ));
} catch (Exception $e) {
  echo "aww"."<br>";
    echo json_encode(array(
        'error' => array(
            'msg' => 'Something went wrong. Failed to upload fan mail',
            'code' => '500',
        ),
    ));
}

?>
