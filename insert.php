<?php
    echo "This php page sends the data collected in the form.html file and inserts it into the MySQL database\n\n";
    include 'settings.php'; //DB Connect Function Defined Here
    
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $major = $_POST['major'];
        
    $conn = dbConnect();
    
    // Run sql insert into query to add data to the table
    $sql = "INSERT INTO studentform (FirstName, LastName, Major) VALUES (?,?,?)";
    if ($stmt = $conn->prepare($sql)) {
        /* bind parameters for markers */
        $stmt->bind_param("sss", $firstname, $lastname, $major);
        /* execute query */
        $stmt->execute();
        printf("\n%d Row inserted.\n", $stmt->affected_rows);
        $stmt->close();
    }
    $conn->close();
?>
