<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Number Functions</title>
</head>
<body>

  <?php
    $var1 = 3;
    $var2 = 4;
  ?>

  <hr>

  Basic math: <?php echo ((1 + 2 + $var1) * $var2) / 2 - 5 ?>

  <hr>

  <?php
    $var2++;
    echo 'Incremenet $var2: ' . $var2; // 5
    echo "<br>";

    $var2 = 4;
    $var2--;
    echo 'Decremenet $var2: ' . $var2; // 3
  ?>

  <hr>

  <?php echo "Float: " . $float = 3.14; ?><br>
  <?php echo round($float, 1); // 3.1 ?><br>
  <?php echo ceil($float); ?><br>
  <?php echo floor($float); ?>

  <hr>

  <?php
    $integer = 3;
    $float = 3.14;

    echo "Is {$integer} integer? " . is_int($integer);
    echo "<br>";
    echo "Is {$integer} float? " . is_float($float);
    echo "<br>";
    echo "Is {$integer} numeric? " . is_numeric($integer);
    echo "<br>";
    echo "Is {$float} numeric? " . is_numeric($float);
  ?>
</body>
</html>
