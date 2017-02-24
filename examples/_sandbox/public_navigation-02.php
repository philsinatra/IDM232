<?php require_once 'includes/db.php'; ?>
<?php
/*
#     /$$
#   /$$$$
#  |_  $$
#    | $$
#    | $$
#    | $$
#   /$$$$$$
#  |______/
*/
  // If the URL contains a 'subject' parameter
  if (isset($_GET['subject'])) {
    $subject_id = $_GET['subject'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Public Navigation</title>
  <!--
  #    /$$$$$$
  #   /$$__  $$
  #  |__/  \ $$
  #     /$$$$$/
  #    |___  $$
  #   /$$  \ $$
  #  |  $$$$$$/
  #   \______/
  -->
  <style media="screen">
    html { font-size: 300%; }
    .active a { color: red; }
  </style>
</head>
<body>

  <ul>
    <?php
      $query = 'SELECT * ';
      $query .= 'FROM subjects ';
      $query .= 'WHERE visible = 1 ';
      $query .= 'ORDER BY position ASC';

      $subject_set = mysqli_query($connection, $query);

      if (!$subject_set) {
          die('Database query failed.');
      }

      $output = '';
      while ($subject = mysqli_fetch_assoc($subject_set)) {
          /*
          #    /$$$$$$
          #   /$$__  $$
          #  |__/  \ $$
          #    /$$$$$$/
          #   /$$____/
          #  | $$
          #  | $$$$$$$$
          #  |________/
          */
          $output .= '<li';
          if (isset($subject_id)) {
            if ($subject_id == $subject['id']) {
              $output .= ' class="active"';
            }
          }
          $output .= '>';
          $output .= '<a href="';
          $output .= $_SERVER['PHP_SELF'];
          $output .= '?subject=';
          $output .= urlencode($subject['id']);
          $output .= '">';
          $output .= htmlentities($subject['menu_name']);
          $output .= '</a>';
          $output .= '</li>';
      }
      echo $output;
     ?>
  </ul>

</body>
</html>
