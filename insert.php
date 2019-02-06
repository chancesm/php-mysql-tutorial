<html>
<body>
<p>This php page sends the data collected in the form.html file and inserts it into the MySQL database</p>

<?php
<? 
include 'settings.php';

$firstname = $_POST[firstname];
$lastname = $_POST[lastname];
$major = $_POST[major]
    
$conn = dbConnect();

// Run sql insert into query to add data to the table
$sql = "INSERT INTO studentform (FirstName, LastName, Major) VALUES (?,?,?)";
// WARNING: This is very bad because it does not protect against SQL Injection!!!
// You should use prepared statements in the lab. 
// See https://www.w3schools.com/php/php_mysql_prepared_statements.asp for a nice example

if ($stmt = $mysqli->prepare($sql)) {

    /* bind parameters for markers */
    $stmt->bind_param("sss", $firstname, $lastname, $major);

    /* execute query */
    $stmt->execute();
    printf("%d Row inserted.\n", $stmt->affected_rows);
    $stmt->close();
}
$conn->close();

?> 


</body>
</html>
