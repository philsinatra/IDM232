<?php require_once '../includes/db_connection.php'; ?>

<?php
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

    $query = "INSERT INTO courses (";
    $query .= " courseTitle, courseImageSmall, courseImageMedium, courseImageLarge, courseDetails, courseVisible";
    $query .= ") VALUES (";
    $query .= " '{$course_title}', '{$course_image_small}', '{$course_image_medium}', '{$course_image_large}', '{$course_details}', '{$course_visible}'";
    $query .= ")";

    error_log($query);

    $result = mysqli_query($connection, $query);

    if ($result) {
      $message = '<div class="alert alert-success" role="alert">Page updated!</div>';
    } else {
      $message = '<div class="alert alert-danger" role="alert">Page update failed.</div>';
    }
  }
?>

<?php include_once 'includes/_head.php'; ?>

<body>
  <!-- 01. Setup page structure. -->
  <?php include 'includes/_navbar.php'; ?>

  <div class="container" role="main">
    <?php include 'includes/_aside-courses.php'; ?>

    <!-- 01. Setup page structure. -->
    <main class="col-md-9">
      <?php
        if (isset($message)) {
          echo "<p>{$message}</p>";
        }
       ?>
      <h1>Add Course</h1>
      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
          <label for="courseTitle">Course Name</label>
          <input type="text" class="form-control" name="courseTitle" id="courseTitle" placeholder="My course Title" required>
        </div>
        <div class="form-group">
          <label for="courseImageSmall">Course Image - Small</label>
          <input type="text" class="form-control" name="courseImageSmall" id="courseImageSmall" placeholder="filename" required>
        </div>
        <div class="form-group">
          <label for="courseImageMedium">Course Image - Medium</label>
          <input type="text" class="form-control" name="courseImageMedium" id="courseImageMedium" placeholder="filename" required>
        </div>
        <div class="form-group">
          <label for="courseImageLarge">Course Image - Large</label>
          <input type="text" class="form-control" name="courseImageLarge" id="courseImageLarge" placeholder="filename" required>
        </div>
        <div class="form-group">
          <label for="courseDetails">Course Details</label>
          <textarea class="form-control" name="courseDetails" id="courseDetails" rows="3" required></textarea>
        </div>
        <div class="form-group">
          <label for="courseVisible">Course Visibility</label>
          <select class="form-control" name="courseVisible" id="courseVisible">
            <option value="1" selected>Visible</option>
            <option value="0">Hidden</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </form>
    </main>
  </div>

  <?php include_once 'includes/_scripts.php'; ?>

  <script> CKEDITOR.replace( 'courseDetails' ); </script>
</body>
</html>
