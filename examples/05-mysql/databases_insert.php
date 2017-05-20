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
  $title       = "My New Image";
  $img         = "http://placehold.it/350x150/990000/ffffff/";
  $description = "A placeholder image with a red background and white text.";

  // Step 2: Preform Database Query
  $query = "INSERT INTO images (title, img, description)
            VALUES ('{$title}', '{$img}', '{$description}')";
  $result = mysqli_query($connection, $query);

  // Check there are no errors with our SQL statement
  if ($result) {
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
