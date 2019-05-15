<?php require_once "../includes/initialize.php"; ?>
<?php
  if (isset($_POST["submit"])) {
    $course_title = mysqli_real_escape_string($connection, $_POST['courseTitle']);
    $course_image_small = mysqli_real_escape_string($connection, $_POST['courseImageSmall']);
    $course_image_medium = mysqli_real_escape_string($connection, $_POST['courseImageMedium']);
    $course_image_large = mysqli_real_escape_string($connection, $_POST['courseImageLarge']);
    $course_details = mysqli_real_escape_string($connection, $_POST['courseDetails']);
    $course_visible = (int) $_POST['courseVisible'];

    // validation

    $query = "INSERT INTO courses (";
    $query .= " courseTitle, courseImageSmall, courseImageMedium, courseImageLarge, courseDetails, courseVisible";
    $query .= ") VALUES (";
    $query .= " '{$course_title}', '{$course_image_small}', '{$course_image_medium}', '{$course_image_large}', '{$course_details}', '{$course_visible}'";
    $query .= ")";

    // error_log($query);

    $result = mysqli_query($connection, $query);

    if ($result) {
      $message = '<div class="alert alert-success" role="alert">Page updated!</div>';
    } else {
      $message = '<div class="alert alert-danger" role="alert">Page update failed.</div>';
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

      <h2>Add Course</h2>

      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
          <label for="courseTitle">Course Name</label>
          <input type="text" class="form-control" name="courseTitle" require>
        </div>
        <div class="form-group">
          <label for="courseImageSmall">Small Image</label>
          <input type="text" class="form-control" name="courseImageSmall" require>
        </div>
        <div class="form-group">
          <label for="courseImageMedium">Medium Image</label>
          <input type="text" class="form-control" name="courseImageMedium" require>
        </div>
        <div class="form-group">
          <label for="courseImageLarge">Large Image</label>
          <input type="text" class="form-control" name="courseImageLarge" require>
        </div>
        <div class="form-group">
          <label for="courseDetails">Course Details</label>
          <textarea class="form-control" name="courseDetails" id="courseDetails" rows="3" required> </textarea>
        </div>
        <div class="form-group">
          <label for="courseVisible">Course Visibility</label>
          <select class="form-control" name="courseVisible" id="courseVisible">
            <option value="0" > Hidden</option>
            <option value="1" >Visible</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </form>
    </main>
  </div>

  <?php require_once "includes/_scripts.php"; ?>
  <script> CKEDITOR.replace( 'courseDetails' ); </script>
</body>
</html>