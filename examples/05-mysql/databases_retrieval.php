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
    // echo "<pre>";
    // while ($row = mysqli_fetch_row($result)) {
    // // while ($row = mysqli_fetch_assoc($result)) {
    // // while ($row = mysqli_fetch_array($result)) {
    //   var_dump($row);
    //   echo "<hr>";
    // }
    // echo "</pre>";

    // while ($row = mysqli_fetch_row($result)) {
    //   echo "<figure>";
    //   echo "<img src=\"{$row[2]}\" alt=\"{$row[1]}\" />";
    //   echo "<figcaption>{$row[1]}</figcaption>";
    //   echo "<p>{$row[3]}</p>";
    //   echo "</figure>";
    //   echo "<hr />";
    // }

    // while ($row = mysqli_fetch_assoc($result)) {
    //   echo "<figure>";
    //   echo "<img src=\"{$row['img']}\" alt=\"{$row['title']}\" />";
    //   echo "<figcaption>{$row['id']}: {$row['title']}</figcaption>";
    //   echo "<p>{$row['description']}</p>";
    //   echo "</figure>";
    //   echo "<hr />";
    // }
  ?>


  <?php while ($row = mysqli_fetch_assoc($result)) { ?>

    <figure>
      <img src="<?php echo $row['img']; ?>" alt="<?php echo $row['title']; ?>">
      <figcaption><?php echo $row['title']; ?></figcaption>
      <p><?php echo $row['description']; ?></p>
    </figure>

    <!-- <li>
      <?php echo $row['title']; ?>
    </li> -->

  <?php } ?>

  <?php
    // Step 4: Release Returned Data
    mysqli_free_result($result);
  ?>

  <!--
  We could setup a new query here and build something else if needed.
  We've freed the previous result, so we're able to build something
  else if needed.
  -->

  <?php
    // Step 5: Close Database Connection
    mysqli_close($connection);
  ?>
</body>
</html>
