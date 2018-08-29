<?php
class dbcontroller{
  public $user = 'admin';
  public $pass = 'admin';
  public $db = 'trapdb';
  public $host = 'localhost';


  function __construct() {
		$this->conn = $this->connectDB();
	}

  function connectDB() {
    $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
		return $conn;
	}

  function runQuery($query) {
		$result = mysqli_query($this->conn, $query);

    if (!$result) {
    $error = mysqli_error($this->conn);
    return $error;

    } else {
        while($row=mysqli_fetch_array($result)) {
    			$resultset[] = $row;
    		}

    		if(!empty($resultset))
    			return $resultset;
    }
	}

  function insertQuery($query){
    $result = mysqli_query($this->conn, $query);

    if (!$result) {
    $error = mysqli_error($this->conn);
    return $error;
    }
    return NULL;

  }

  function numRows($query) {
		$result = mysqli_query($this->conn, $query);
		$rowcount = $result->num_rows;
		return $rowcount;
	}

  function executeUpdate($query) {
    $result = mysqli_query($this->conn,$query);
  return $result;
  }

  function validateLogin($query) {
    $result = mysqli_query($this->conn,$query);
    $row = mysqli_fetch_row($result);

    if(!$row) {
      //if no row is fetched return the error
      $ret_val = mysqli_error($this->conn);
    } else {
      //else send the rows
      $rowcount = $result->num_rows;

      if($rowcount == 1){ //good to go
        $ret_val = "TRUE";
      }
    }
  return $ret_val;
  }

  function removeEscChar($var) {
    $result = mysqli_real_escape_string($this->conn, $var);
  return $result;
  }

  function closeConn() {
    $result = mysqli_close($this->conn);
  return $result;
  }
}
?>﻿
