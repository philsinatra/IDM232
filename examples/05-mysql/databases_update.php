<?php
  // Step 1: Create Database Connection
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "root";
  $dbname = "idm232-example";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Check the connection is good with no errors
  if (mysqli_connect_errno()) {
    die ("Database connection failed: " .
      mysqli_connect_error() .
      " (" . mysqli_connect_errno() . ")"
    );
  }

  // Often these are form values in $_POST
  $id = 1;
  $title       = "My Newly Updated Image";
  $img         = "http://placehold.it/350x150/000000/ffffff/";
  $description = "A placeholder image with a black background and white text.";

  // Step 2: Preform Database Query
  $query = "UPDATE images SET ";
  $query .= "title = '{$title}', ";
  $query .= "img = '{$img}', ";
  $query .= "description = '{$description}' ";
  $query .= "WHERE id = {$id}";

  $result = mysqli_query($connection, $query);

  // Check there are no errors with our SQL statement
  // Also checking that the number of affected rows is only 1.
  if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    // redirect_to("somepage.php");
    echo "Success!";
  } else {
    die ("Database query failed. " . mysqli_error($connection));
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Databases</title>
</head>
<body>
  <?php
    // Step 5: Close Database Connection
    mysqli_close($connection);
  ?>
</body>
</html>
