<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Switch</title>
</head>
<body>
  <?php
    $a = 3;

    switch ($a) {
      case 0:
        echo "a equals 0";
      case 1:
        echo "a equals 1";
      case 2:
        echo "a equals 2";
      case 3:
        echo "a equals 3";
    }
  ?>

  <hr>

  <?php
    $year = 2013;
    switch (($year - 4) % 12) {
      case 0: $zodiac = "Rat";      break;
      case 1: $zodiac = "Ox";       break;
      case 2: $zodiac = "Tiger";    break;
      case 3: $zodiac = "Rabbit";   break;
      case 4: $zodiac = "Dragon";   break;
      case 5: $zodiac = "Snake";    break;
      case 6: $zodiac = "Horse";    break;
      case 7: $zodiac = "Goat";     break;
      case 8: $zodiac = "Monkey";   break;
      case 9: $zodiac = "Rooster";  break;
      case 10: $zodiac = "Dog";     break;
      case 11: $zodiac = "Pig";     break;
    }
    echo "{$year} is the year of the {$zodiac}";
   ?>

   <hr>

   <?php
     $user_type = "customer";

     switch ($user_type) {
       case "student":
         echo "Welcome!";
         break;
       case "press":
       case "customer":
       case "admin":
         echo "Hello!";
         break;
     }
   ?>
</body>
</html>
