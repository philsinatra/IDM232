<?php require_once "../includes/initialize.php"; ?>
<?php
  if (isset($_GET["id"])) {
    $id = $_GET["id"];

    /**
    Since the 'id' value is coming from our URL string, it isn't safe.
    To avoid a lethal SQL injection, we have to escape the value before
    we us it in our SQL statement.
    */
    $safe_id = mysqli_real_escape_string($connection, $id);
  }

  if (isset($_POST["submit"])) {
    $course_title = mysqli_real_escape_string($connection, $_POST['courseTitle']);
    $course_image_small = mysqli_real_escape_string($connection, $_POST['courseImageSmall']);
    $course_image_medium = mysqli_real_escape_string($connection, $_POST['courseImageMedium']);
    $course_image_large = mysqli_real_escape_string($connection, $_POST['courseImageLarge']);
    $course_details = mysqli_real_escape_string($connection, $_POST['courseDetails']);
    $course_visible = (int) $_POST['courseVisible'];

    // Form validation

    $query = 'UPDATE courses SET ';
    $query .= "courseTitle = '{$course_title}', ";
    $query .= "courseImageSmall = '{$course_image_small}', ";
    $query .= "courseImageMedium = '{$course_image_medium}', ";
    $query .= "courseImageLarge = '{$course_image_large}', ";
    $query .= "courseDetails = '{$course_details}', ";
    $query .= "courseVisible = '{$course_visible}' ";
    $query .= "WHERE id = {$safe_id} ";
    $query .= 'LIMIT 1';

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // success
      $message = '<div class="alert alert-success" role="alert">Page Updated!</div>';
    } else {
      $message = '<div class="alert alert-danger" role="alert">Page update failed!</div>';
    }
  }
?>
<?php include_once "includes/_head.php"; ?>

<body>
  <div class="container">
    <?php include "includes/_aside.php"; ?>
    <main class="col-md-8">

      <?php
        if (isset($message)) {
          echo $message;
        }
      ?>

      <h2>Manage Courses</h2>

      <?php
        if (isset($safe_id)) {
          $query = 'SELECT * ';
          $query .= 'FROM courses ';
          $query .= "WHERE id = {$safe_id} ";
          $query .= 'LIMIT 1';

          $result = mysqli_query($connection, $query);

          if (!$result) {
            die('Database query failed.');
          }

          while ($course = mysqli_fetch_assoc($result)) {
      ?>

      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $safe_id; ?>">
        <div class="form-group">
          <label for="courseTitle">Course Name</label>
          <input type="text" class="form-control" name="courseTitle" value="<?php echo $course['courseTitle']; ?>" require>
        </div>
        <div class="form-group">
          <label for="courseImageSmall">Small Image</label>
          <input type="text" class="form-control" name="courseImageSmall" value="<?php echo $course['courseImageSmall']; ?>" require>
        </div>
        <div class="form-group">
          <label for="courseImageMedium">Medium Image</label>
          <input type="text" class="form-control" name="courseImageMedium" value="<?php echo $course['courseImageMedium']; ?>" require>
        </div>
        <div class="form-group">
          <label for="courseImageLarge">Large Image</label>
          <input type="text" class="form-control" name="courseImageLarge" value="<?php echo $course['courseImageLarge']; ?>" require>
        </div>
        <div class="form-group">
          <label for="courseDetails">Course Details</label>
          <textarea class="form-control" name="courseDetails" id="courseDetails" rows="3" required>
            <?php echo $course['courseDetails']; ?>
          </textarea>
        </div>
        <div class="form-group">
          <label for="courseVisible">Course Visibility</label>
          <select class="form-control" name="courseVisible" id="courseVisible">
            <option
              value="0"
              <?php if ($course['courseVisible'] == 0) echo " selected"; ?>
            >
              Hidden</option>
            <option
              value="1"
              <?php if ($course['courseVisible'] == 1) echo " selected"; ?>
            >Visible</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </form>

      <?php
          } // end while loop
        } else {
          echo "<p>Select a course to edit from the menu.</p>";
        } // end if
      ?>
    </main>
  </div>

  <?php require_once "includes/_scripts.php"; ?>
  <script> CKEDITOR.replace( 'courseDetails' ); </script>
</body>
</html>