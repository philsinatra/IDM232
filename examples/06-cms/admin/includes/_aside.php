<aside class="col-md-4">
  <h2>Courses</h2>
  <div class="list-group">
    <?php
      $query = 'SELECT id, courseTitle ';
      $query .= 'FROM courses ';
      $query .= 'ORDER BY id ASC';

      $result = mysqli_query($connection, $query);

      if (!$result) {
        die('Database query failed.');
      }

      while ($course = mysqli_fetch_assoc($result)) {
        echo '<a href="index.php?id=';
        echo urlencode($course["id"]);
        echo '"';
        echo 'class="list-group-item';

        if (isset($safe_id)) {
          if ($course["id"] == $safe_id) {
            echo " active";
          }
        }

        echo '"';
        echo ">{$course['courseTitle']}</a>";
      } // end while loop
      mysqli_free_result($result);
    ?>

    <a href="add_course.php" class="list-group-item"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Course</a>

  </div>
</aside>