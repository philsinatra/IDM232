<?php require_once '../includes/db_connection.php'; ?>

<?php

/*
CREATE TABLE `idm232-courses`.`courses` (
  `id` int(11) NOT NULL NULL AUTO_INCREMENT,
  `courseTitle` varchar(100),
  `courseImageSmall` varchar(200),
  `courseImageMedium` varchar(200),
  `courseImageLarge` varchar(200),
  `courseDetails` text,
  `courseVisible` tinyint(1),
  PRIMARY KEY (`id`)
)ENGINE = InnoDB;
*/

  // Check if the 'id' parameter
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Since the 'id' value is coming from our URL string, it isn't safe.
    // To avoid a lethal SQL injection, we have to escape the value before
    // we us it in our SQL statement.
    $safe_id = mysqli_real_escape_string($connection, $id);
  }

  if (isset($_POST['submit'])) {
    $course_title = mysqli_real_escape_string($connection, $_POST['courseTitle']);
    $course_image_small = mysqli_real_escape_string($connection, $_POST['courseImageSmall']);
    $course_image_medium = mysqli_real_escape_string($connection, $_POST['courseImageMedium']);
    $course_image_large = mysqli_real_escape_string($connection, $_POST['courseImageLarge']);
    $course_details = mysqli_real_escape_string($connection, $_POST['courseDetails']);
    $course_visible = (int) $_POST['courseVisible'];

    // Validation
    $errors = array();
    $required_fields = array(
      'courseTitle',
      'courseImageSmall',
      'courseImageMedium',
      'courseImageLarge',
      'courseDetails'
    );
    foreach ($required_fields as $field) {
      $value = trim($_POST[$field]);
      if (!isset($value) || $value == '') {
        $errors[$field] = $field . ' can\'t be blank';
      }
    }

    if (!empty($errors)) {
      // do something...
      // redirect user?
    }

    // Perform update
    $query = 'UPDATE courses SET ';
    $query .= "courseTitle = '{$course_title}', ";
    $query .= "courseImageSmall = '{$course_image_small}', ";
    $query .= "courseImageMedium = '{$course_image_medium}', ";
    $query .= "courseImageLarge = '{$course_image_large}', ";
    $query .= "courseDetails = '{$course_details}', ";
    $query .= "courseVisible = '{$course_visible}' ";
    $query .= "WHERE id = {$id} ";
    $query .= 'LIMIT 1';

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      $message = '<div class="alert alert-success" role="alert">Page updated!</div>';
    } else {
      $message = '<div class="alert alert-danger" role="alert">Page update failed.</div>';
    }

  }
 ?>

<?php include_once 'includes/_head.php'; ?>

<body>
  <?php include 'includes/_navbar.php'; ?>

  <div class="container" role="main">
    <?php include 'includes/_aside-courses.php'; ?>

    <main class="col-md-9">
      <?php
        if (isset($message)) {
          echo "<p>{$message}</p>";
        }
       ?>
      <h1>Manage Courses</h1>

      <?php
        if (isset($safe_id)) {
          $query = 'SELECT * ';
          $query .= 'FROM courses ';
          $query .= "WHERE id = {$safe_id} ";
          $query .= 'LIMIT 1';

          $result = mysqli_query($connection, $query);

          // Could/should move this into a function!
          if (!$result) {
            die('Database query failed.');
          }

          while ($course = mysqli_fetch_assoc($result)) {
      ?>

      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>">
        <div class="form-group">
          <label for="courseTitle">Course Name</label>
          <input type="text" class="form-control" name="courseTitle" id="courseTitle" placeholder="My course Title" value="<?php echo $course['courseTitle']; ?>">
        </div>
        <div class="form-group">
          <label for="courseImageSmall">Course Image - Small</label>
          <input type="text" class="form-control" name="courseImageSmall" id="courseImageSmall" placeholder="filename" value="<?php echo $course['courseImageSmall']; ?>">
        </div>
        <div class="form-group">
          <label for="courseImageMedium">Course Image - Medium</label>
          <input type="text" class="form-control" name="courseImageMedium" id="courseImageMedium" placeholder="filename" value="<?php echo $course['courseImageMedium']; ?>">
        </div>
        <div class="form-group">
          <label for="courseImageLarge">Course Image - Large</label>
          <input type="text" class="form-control" name="courseImageLarge" id="courseImageLarge" placeholder="filename" value="<?php echo $course['courseImageLarge']; ?>">
        </div>
        <div class="form-group">
          <label for="courseDetails">Course Details</label>
          <textarea class="form-control" name="courseDetails" id="courseDetails" rows="3">
            <?php echo $course['courseDetails']; ?>
          </textarea>
        </div>
        <div class="form-group">
          <label for="courseVisible">Course Visibility</label>
          <select class="form-control" name="courseVisible" id="courseVisible">
            <option value="0"<?php if ($course['courseVisible'] == 0) echo 'selected'; ?>>Hidden</option>
            <option value="1" <?php if ($course['courseVisible'] == 1) echo 'selected'; ?>>Visible</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </form>

      <?php
        } // end while
      ?>

      <?php
        } else {
          // No specific course selected.
      ?>
      <p>Select a course to edit from the menu.</p>
      <?php } // endif ?>
    </main>
  </div>

  <?php include_once 'includes/_scripts.php'; ?>

  <script> CKEDITOR.replace( 'courseDetails' ); </script>
</body>
</html>
