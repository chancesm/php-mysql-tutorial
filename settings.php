<?php

function dbConnect() {
  $dbaddress = "localhost";
  $dbuser = "chance";
  $dbpass = "password";
  $dbname = "";
  
	$conn = new mysqli($dbaddress, $dbuser, $dbpass, $dbname);

  if ($mysqli->connect_error) {
      die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
  }
	  return $conn;
}
