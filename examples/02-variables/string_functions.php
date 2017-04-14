<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>String Functions</title>
</head>
<body>

  <?php
    $first = "The quick brown fox";
    $second = " jumped over the lazy dog.";

    $third = $first;
    $third .= $second;

    echo $third;
  ?>

  <hr>

  Lowercase: <?php echo strtolower($third); ?><br>
  Uppercase: <?php echo strtoupper($third); ?><br>
  Uppercase first: <?php echo ucfirst($third); ?><br>
  Uppercase words: <?php echo ucwords($third); ?>

  <hr>

  Length: <?php echo strlen($third); ?><br>
  Find: <?php echo strstr($third, "brown"); ?><br>
  Replace by string: <?php echo str_replace("quick", "super-fast", $third); ?>

  <hr>

  Make substring: <?php echo substr($third, 5, 10); ?><br>
  Find position: <?php echo strpos($third, "brown"); ?>

</body>
</html>
