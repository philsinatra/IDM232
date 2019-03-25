<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Arrays</title>
</head>
<body>

  <?php
    $numbers = array(4,8,15,16);
    print_r($numbers);
  ?>

  <p>$numbers[1]: <?php echo $numbers[1]; ?></p>

  <?php
    $mixed = array(6, "fox", "dog", array("x", "y", "z"));
    print_r($mixed);
  ?>

  <p>$mixed[2]: <?php echo $mixed[2]; ?></p>
  <p>$mixed[3]: <?php echo $mixed[3]; ?></p>
  <p>$mixed[3][1]: <?php echo $mixed[3][1]; ?></p>

  <?php
    $mixed[2] = "cat";
    $mixed[4] = "mouse";
    print_r($mixed);

    echo "<br>";
    $mixed[] = "horse";
    print_r($mixed);
  ?>

  <hr>

  <?php
    $assoc = [
      "first_name" => "Dolores",
      "last_name" => "Abernathy"
    ];
    echo $assoc["first_name"]; // Dolores
  ?>

  <hr>

  <?php $numbers = array(8,23,15,42,16,4); ?>

  <p>Count: <?php echo count($numbers); ?></p>
  <p>Max value: <?php echo max($numbers); ?></p>
  <p>Min value: <?php echo min($numbers); ?></p>

  <p>Sort: <?php sort($numbers); print_r($numbers); ?></p>
  <p>Implode: <?php echo $num_string = implode(' * ', $numbers); ?></p>
  <p>Explode: <?php print_r(explode(' * ', $num_string)); ?></p>

</body>
</html>
