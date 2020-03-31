<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Page 1</title>
</head>
<body>

  <!-- Let's start by making a link. -->
  <p><a href="page2.php">Page 2</a></p>


  <!--
  The great thing about PHP though is that we can start to improve these links.
  We can make them more dynamic. Instead of building the link in static HTML,
  we can use PHP to set page names and echo our values.
  -->
  <?php $link_name = "Page 2"; ?>
  <p><a href="page2.php"><?php echo $link_name; ?></a></p>


  <!--
  So now we have some dynamic text. This is something that could potentially
  be pulled from a database. Or maybe we have an if statement that decides if
  one condition is true, give it one name, or else give it some other name.
  Maybe PHP decides what link to display based on whether a user is logged in
  or not. One of the ways we send a lot of dynamic information is by sending
  something in the query string.

  The query string is what comes after the page name.
  -->
  <p><a href="page2.php?id=1"><?php echo $link_name; ?></a></p>


  <!--
  What if we were building a list of pages, or categories. The link name,
  file and id would be different for each link.
  -->
  <ul>
    <?php
      for ($i=1; $i < 5; $i++) {
        echo "<li>";
        echo "<a href=\"page{$i}.php?id={$i}\">Page {$i}</a>";
        echo "</li>";
      }
    ?>
  </ul>


  <!--
  Every time we increment, the link and `id` value go to a different page. Once we
  send that `id` to another page, the second page needs to be able to pick up
  on that.

  RETURN TO SLIDESHOW
  -->

  <!-- ____________________________________________________________________________________ -->

  <!--
  Let's go back to our simple link example. This link sends a 'get' request to
  page2.php and all of the query parameters are sent with that link. In this case
  we're sending "id=2".
  -->
  <?php
    $link_name = "Page 2";
    $id = 2;
  ?>
  <p><a href="page2.php?id=<?php echo $id; ?>"><?php echo $link_name; ?></a></p>

  <!-- Now let's go to page2.php -->

  <!-- ____________________________________________________________________________________ -->

  <!--
  Let's revisit our list of links, and I'm only going to change one thing.
  Instead of having 5 different .php pages, I'm going to set all the links
  to open page2.php; so I'm using page2.php as a template. Each link is going
  to go to the same PHP file, but still going to pass a different `id` parameter
  value in the URL.

  Let's see what happens when we click on each of these links.
  -->
  <ul>
    <?php
      for ($i=1; $i < 5; $i++) {
        echo "<li>";
        echo "<a href=\"page2.php?id={$i}\">Page {$i}</a>";
        echo "</li>";
      }
    ?>
  </ul>

  <!-- Let's do another example, based on an associative array: -->
  <?php
    $my_array = [
      [
        "first_name" => "Homer",
        "last_name" => "Simpson",
        "role" => "father"
      ],
      [
        "first_name" => "Marge",
        "last_name" => "Simpson",
        "role" => "mother"
      ],
      [
        "first_name" => "Bart",
        "last_name" => "Simpson",
        "role" => "brother"
      ],
      [
        "first_name" => "Lisa",
        "last_name" => "Simpson",
        "role" => "sister"
      ],
      [
        "first_name" => "Maggie",
        "last_name" => "Simpson",
        "role" => "baby"
      ]
      ];

      foreach ($my_array as $character) {
        $output = "<p>";
        $output .= $character["first_name"];
        $output .= " ";
        $output .= $character["last_name"];
        $output .= " is the ";
        $output .= $character["role"];
        $output .= ".</p>";
        echo $output;
      }
  ?>

</body>
</html>
