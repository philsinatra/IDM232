<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Page 2</title>
</head>
<body>

  <!--
  Remember, all the parameters that get passed in the URL are going
  to be stored in an associative array. So let's use PHP's `print_r`
  function to take a look at the contents of that array.
  -->

  <!-- I'm going to use <pre> tags to help format the array contents. -->
  <pre>
    <!-- Then we'll use our super global GET and take a look at what the
    value looks like. -->
    <?php print_r($_GET); ?>
  </pre>

  <!--
  You can put any parameters in the URL you want and reload the page.
  EXAMPLE: id=34&name=Phil
  -->

  <!--
  We know how to access the values that are stored in associate arrays.
  So instead of a print_r, let's set up a variable and assign it to the
  parameter value.
  -->
  <?php
    /**
     * This will take the value in the associative array stored in the key
     * `id` and assign it to that variable.
     */
    $id = $_GET['id'];
    echo "ID: {$id}";
  ?>

  <!--
  (Go back to page1.php and build another nav list that uses this page as a template.)
  -->

</body>
</html>
