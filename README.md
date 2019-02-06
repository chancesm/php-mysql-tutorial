# php-mysql-tutorial
Instructions for PHP / MySQL / HTML Form In-Class Exercise.
NOTE: If you download this repository, the file creation steps are done for you. 
To see the finished code, look at the 'finished' branch.

## TASK A: Create a database for storing data

### Step 1. 

Login to phpmyadmin by visiting http://localhost/phpmyadmin/ and entering your credentials (if it’s the first time you’ve logged in, your username will be “root” and your password will be whatever you used when you installed MySQL).

### Step 2. 

Create a new database called “webforms” by giving it a name on the main window and using the default settings. This will create a new database, but there is no data in it currently.

### Step 3. 

Create a table called “studentform” with 5 fields using the dialog options. Create the following fields: 

| Column Name | DETAILS |
| ----------- | ------- |
| StudentID   | SMALLINT; attribute=UNSIGNED; Index:PRIMARY; A_I:CHECK to autoincrement | 
| FirstName   | VARCHAR; Length=50 |
| LastName    | same |
| Major       | same |
| TimeStamp   | TIMESTAMP; DEFAULT:CURRENT_TIMESTAMP |

Choose “SAVE”

### Step 4. 

Add a row of data into the Table by going to the Insert tab and entering data (StudentID=1, your first and last name and major). Then click “Go”. Look at the SQL “Insert” statement. Then click on the Browse tab to make sure it looks as you expect.

## TASK B: Create an HTML page with a form that matches our database table. You can download it from learningsuite. Or do the following:


### Step 1. 

Create a new file in /var/www/ called form.html
```html
<html>
<body>

<form action="insert.php" method="post">
First Name: <input type="text" name="firstname" />
Last Name: <input type="text" name="lastname" />
Major: <input type="text" name="major" />
<input type="submit" />
</form>

</body>
</html> 
```
### Step 2. 

Open it in a web browser to make sure it works: http://localhost/form.html
Notice that when you try submitting data it tries to send it to the insert.php file, but since no such file exists it gives you an error message. That leads us to our next task.

## TASK C: Create two php files: one called settings.php that contains your database connection inormation, and one called insert.php that will take the data from the form and insert it into the MySQL database table we created in TASK A above. You can download the insert.txt file from learningsuite and change the extension to .php. Or do the following:

### Step 1. 

Create the settings.php page with the following code and put it in your /var/www/ folder, filling in your username,password,and database:
```php
<?php

function dbConnect() {
  $dbaddress = "localhost";
  $dbuser = "YOUR_DB_USER";
  $dbpass = "YOUR_DB_PASS";
  $dbname = "YOUR_DB_NAME";
  
	$conn = new mysqli($dbaddress, $dbuser, $dbpass, $dbname);

  if ($mysqli->connect_error) {
      die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
  }
	  return $conn;
}
?>
```

### Step 2. 

Create the insert.php page with the following code and put it in your /var/www/ folder:
```php
<?php
    echo "This php page sends the data collected in the form.html file and inserts it into the MySQL database\n\n";
    include 'settings.php'; //DB Connect Function Defined Here
    
    $firstname = $_POST[firstname];
    $lastname = $_POST[lastname];
    $major = $_POST[major];
        
    $conn = dbConnect();
    
    // Run sql insert into query to add data to the table
    $sql = "INSERT INTO studentform (FirstName, LastName, Major) VALUES (?,?,?)";
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

```

### Step 3. 

Verify that it worked by going back to phpMyAdmin, “browsing” the table and choosing “refresh”. It should have a new record with the data you entered on the form.html page.
NOTE: if you download this Repository, there is a file called read.php that will print out an unformatted version of the studentforms table.
