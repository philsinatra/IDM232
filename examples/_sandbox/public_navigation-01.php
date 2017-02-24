<?php require_once 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Public Navigation</title>
  <style media="screen">
    html { font-size: 300%; }
  </style>
</head>
<body>

  <ul class="nav nav-sidebar">
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
          $output .= '<li>';
          $output .= '<a href="#">';
          $output .= htmlentities($subject['menu_name']);
          $output .= '</a>';
          $output .= '</li>';
      }
      echo $output;
     ?>
  </ul>

</body>
</html>
