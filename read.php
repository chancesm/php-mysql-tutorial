<?php
include 'settings.php';
$conn = dbConnect();
if ($result = $conn->query("Select * from studentform;")) {
  $data = $result->fetch_all(MYSQLI_ASSOC);
  var_dump($data);
}
