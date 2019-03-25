<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HTML Encoding</title>
</head>
<body>

  <!-- This does not work, because HTML thinks '<Click>' is an HTML tag. -->
  <p>
    <a href="#"><Click> & Learn More</Click></a>
  </p>


  <!-- Use PHP to encode the < and > symbols. -->
  <?php $linktext = "<Click> & Learn More"; ?>
  <p>
    <a href="#"><?php echo htmlspecialchars($linktext); ?></a>
  </p>


  <!-- Encode all special characters with `entities()` -->
  <?php
    $text = "™©®è";
    echo htmlentities($text);
  ?>

</body>
</html>
