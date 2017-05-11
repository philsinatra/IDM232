<?php
  /*
  1. Create database `idm232-example`

  2. Create table
  CREATE TABLE `idm232-example`.`images` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(50) NOT NULL , `img` VARCHAR(50) NOT NULL , `description` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

  3. Populate some data
  INSERT INTO `images` (`id`, `title`, `img`, `description`) VALUES (NULL, 'The Happy Cat', 'http://placehold.it/350x150/e8117f/ffffff/', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus et erat orci. Etiam in dolor at arcu scelerisque aliquet. Quisque lorem diam, volutpat in elementum non, facilisis vel ipsum. Fusce ut posuere neque. Vestibulum egestas, odio a gravida rhoncus, dolor mi ullamcorper velit, id lobortis nisl elit imperdiet neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras ac nunc nisi, egestas tincidunt urna. Nullam vel tortor nec lectus porta tincidunt ac eget diam. Praesent vulputate, nunc eget sodales imperdiet, nunc orci ullamcorper justo, in elementum ante felis sit amet dolor. Vivamus mattis blandit blandit. Etiam vitae sapien nulla, interdum feugiat ligula. Cras eu tortor orci. Maecenas sed est tellus. Vestibulum est libero, venenatis a feugiat id, condimentum et erat. Nulla id volutpat nunc. Nam sodales nunc qui[...]');
  */


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

  // Step 2: Preform Database Query
  $query = "SELECT * FROM images";
  $result = mysqli_query($connection, $query);

  // Check there are no errors with our SQL statement
  if (!$result) {
    die ("Database query failed.");
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
    // Step 3: Use Returned Data
    echo "<pre>";
    while ($row = mysqli_fetch_row($result)) {
      var_dump($row);
      echo "<hr>";
    }
    echo "</pre>";
  ?>

  <?php
    // Step 4: Release Returned Data
    mysqli_free_result($result);
  ?>

  <!--
  We could setup a new query here and build soemthing else if needed.
  We've freed the previous result, so we're able to build something
  else if needed.
  -->

  <?php
    // Step 5: Close Database Connection
    mysqli_close($connection);
  ?>
</body>
</html>
