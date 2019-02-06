<html>
<body>
<p>This php page sends the data collected in the form.html file and inserts it into the MySQL database</p>

<?php
<? 
include 'settings.php';

// Check connection and throw error if it fails

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Run sql insert into query to add data to the table
$sql = "INSERT INTO $table (FirstName, LastName, Major) VALUES ('$_POST[firstname]','$_POST[lastname]', '$_POST[major]')";
// WARNING: This is very bad because it does not protect against SQL Injection!!!
// You should use prepared statements in the lab. 
// See https://www.w3schools.com/php/php_mysql_prepared_statements.asp for a nice example

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?> 


</body>
</html>
