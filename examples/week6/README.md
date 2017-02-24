# Week 6 Walkthrough

<!-- TOC -->

## manage_courses.php

### Create the Base Template

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <title>IDM Course Catalog - CMS</title>
</head>
<body>
  <div class="container" role="main">
    <aside class="col-md-3">
      <h2>Courses</h2>
    </aside>
    <main class="col-md-9">
      <h1>Manage Courses</h1>
    </main>
  </div>
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
```

### Create the Database    

`examples/week6/courses.sql`

### Create Database Connection

- `./includes/db_connection.php`

```php
<?php
  // Define constants rather than regular variables.
  define('DB_SERVER', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', 'root');
  define('DB_NAME', 'idm232-courses');

  // Connect using the constants
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

  // Test if connection succeeded
  if (mysqli_connect_errno()) {
    die ('Database connection failed: ' .
        mysqli_connect_error() .
        ' )' . mysqli_connect_errno() . ')'
    );
  }
?>
```

### Build Aside Navigation

- `admin/includes/_aside-courses`

**Note**: this does not include the conditional that detects active page!

```php
<aside class="col-md-3">
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
        echo '<a href="manage_courses.php?id=';
        echo urlencode($course['id']);
        echo '" class="list-group-item">';
        echo $course['courseTitle'];
        echo '</a>';
      } // end while
      mysqli_free_result($result);
    ?>
  </div>
</aside>
```

### Create Blank Form Template

```html
<form>
  <div class="form-group">
    <label for="courseTitle">course Name</label>
    <input type="text" class="form-control" name="courseTitle" id="courseTitle" placeholder="My course Title">
  </div>
  <div class="form-group">
    <label for="courseImageSmall">course Image - Small</label>
    <input type="text" class="form-control" name="courseImageSmall" id="courseImageSmall" placeholder="filename">
  </div>
  <div class="form-group">
    <label for="courseImageMedium">course Image - Medium</label>
    <input type="text" class="form-control" name="courseImageMedium" id="courseImageMedium" placeholder="filename">
  </div>
  <div class="form-group">
    <label for="courseImageLarge">course Image - Large</label>
    <input type="text" class="form-control" name="courseImageLarge" id="courseImageLarge" placeholder="filename">
  </div>
  <div class="form-group">
    <label for="courseDetails"></label>
    <textarea class="form-control" id="courseDetails" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="courseVisible">Course Visibility</label>
    <select class="form-control" name="courseVisible" id="courseVisible">
      <option value="1">Visible</option>
      <option value="0">Hidden</option>
    </select>
  </div>
  <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
```

### Query the Database

```php
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
```

### Update the Form

```php
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
```

### Update Database

```php
<?php
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
 ```

 ```php
 <?php
   if (isset($message)) {
     echo "<p>{$message}</p>";
   }
?>
```

### Show Active Page

- `admin/includes/_aside-courses`

```php
echo '" class="list-group-item';
if (isset($safe_id)) {
  if ($course['id'] == $safe_id) {
    echo ' active';
  }
}
echo '">';
```

### Add CKEditor

```html
<!-- Inside the document _head.php -->
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
```

```html
<!-- At the bottom of the page, before the closing <body> tag. -->
<script> CKEDITOR.replace( 'courseDetails' ); </script>
```  

### Add Course Button

```html
<a href="add_course.php" class="list-group-item"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Course</a>
```

## Add Course

### Form Template

```php
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
```

### Add `INSERT` Query

```php
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
```
