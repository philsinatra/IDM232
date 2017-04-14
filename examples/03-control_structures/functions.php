<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Functions</title>
</head>
<body>
  <?php
  function say_hello() {
    echo "Hello World!<br>";
  }

  function say_something($word) {
    echo "Hello {$word}<br>";
  }

  say_hello();
  say_something('Cowboy!');



  $name = "John Doe";
  function better_hello($greeting, $target, $punct) {
    echo $greeting . " " . $target . $punct . "<br>";
  }

  better_hello("Hello", $name, "!");
  better_hello("Greetings", $name, "!!!");



  function better_hello_return($greeting, $target, $punct) {
    return $greeting . " " . $target . $punct . "<br>";
  }

  $result = better_hello_return("Howdy", $name, ":)");
  echo $result;



  function add_subt($val1, $val2) {
    $add  = $val1 + $val2;
    $subt = $val1 - $val2;
    return array($add, $subt);
  }

  $result_array = add_subt(10,5); // an array
  echo "Add: " . $result_array[0] . "<br>Subtract: " . $result_array[1] . "<br>";



  function better_add_subt($val1, $val2) {
    $add  = $val1 + $val2;
    $subt = $val1 - $val2;
    return array($add, $subt);
  }

  list($add_result, $subt_result) = better_add_subt(20,7);
  echo "Add: " . $add_result . "<br>Subtract: " . $subt_result;



  function paint($color="red") {
    return "The color of the room is {$color}.<br>";
  }

  echo paint();
  ?>
</body>
</html>
