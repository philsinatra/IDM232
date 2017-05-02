<?php
  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
  } else {
    $name = "Name not set!";
    $password = "Password not set!";
  }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="screen.css">
    <title>Result Page</title>
  </head>
  <body>
    <ul>
      <li>Name: <?php echo $name; ?></li>
      <li>Password: <?php echo $password; ?></li>
    </ul>
  </body>
</html>
