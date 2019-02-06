<?php
include 'settings.php';
$conn = dbConnect();
$conn->query("Select * from studentform;");
