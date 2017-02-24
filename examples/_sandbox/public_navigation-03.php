<?php require_once 'includes/db.php'; ?>
<?php
  // If the URL contains a 'subject' parameter
  if (isset($_GET['subject'])) {
    $subject_id = $_GET['subject'];

    // Make that parameter safe to use
    $safe_subject_id = mysqli_real_escape_string($connection, $subject_id);

    // Extract the database row where the ID matches the 'subject' URL parameter
    $query  = 'SELECT * ';
    $query .= 'FROM subjects ';
    $query .= "WHERE id = {$safe_subject_id} ";
    $query .= 'LIMIT 1';
    $subject_set = mysqli_query($connection, $query);

    if (!$subject_set) {
        die('Database query failed.');
    }
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Public Navigation</title>
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
    if (isset($_GET['subject'])) {
      $query = 'SELECT * ';
      $query .= 'FROM pages ';
      $query .= "WHERE subject_id = {$safe_subject_id} ";
      $query .= 'AND visible = 1 ';
      $query .= 'LIMIT 1';

      $page_set = mysqli_query($connection, $query);

      if (!$page_set) {
        die('Database query failed.');
      }

      $output = '';
      while ($current_page = mysqli_fetch_assoc($page_set)) {
        $output .= '<h2>' . htmlentities($current_page['menu_name']) . '</h2>';
        $output .= nl2br(htmlentities($current_page['content']));
      }

      echo $output;
    } else {
      echo '<h1>Welcome to Widget Corp!</h1>';
    }
   ?>

</body>
</html>
