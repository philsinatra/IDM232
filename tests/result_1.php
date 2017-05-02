<?php
  if (isset($_GET['id'])) $id = $_GET['id'];
  else $id = "id NOT SET!";

  if (isset($_GET['name'])) $name = $_GET['name'];
  else $name = "name NOT SET!";
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
      <li>ID: <?php echo $id; ?></li>
      <li>Name: <?php echo $name; ?></li>
    </ul>
  </body>
</html>
