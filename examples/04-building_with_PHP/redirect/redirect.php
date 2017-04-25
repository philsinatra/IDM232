<?php
  function redirect_to($new_location) {
    header("Location: {$new_location}");
    exit;
  }

  if (isset($_GET['logged_in'])) {
    $logged_in = $_GET['logged_in'];

    if ($logged_in == 1) {
      redirect_to("basic.html");
    } else {
      redirect_to("http://google.com");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Redirect</title>
</head>
<body>
  <ul>
    <li><a href="redirect.php?logged_in=1">Log In</a></li>
    <li><a href="redirect.php?logged_in=0">Log Out</a></li>
  </ul>
</body>
</html>
