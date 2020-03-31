<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HTML Encoding - Full Example</title>
</head>
<body>

  <?php
    $url_page = "php/created/page/url.php";
    $param1   = "This is a string with < >";
    $param2   = "&#?*$[]+ are bad characters";
    $linktext = "<Click> & learn more";

    $url = "http://localhost/";
    $url .= rawurlencode($url_page);
    $url .= "?" . "param1=" . urlencode($param1);
    $url .= "&" . "param2=" . urlencode($param2);
  ?>

  <a href="<?php echo htmlspecialchars($url); ?>">
    <?php echo htmlspecialchars($linktext); ?>
  </a>

</body>
</html>
