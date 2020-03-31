# CMS Walkthrough

## Project Directory Structure

- admin
  - includes
- includes
- public
  - css
  - includes

## Create Database

- `./examples/06-cms/idm232-courses.sql`

## Create Database Connection File

- `includes/db.php`

```php
<?php
  // 1. Create database connection
  //
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

## Create Functions File

- `includes/functions.php`

```php
<?php
/**
 * Redirect to a new location.
 * This must be called prior to any HTML
 * being rendered, including even a single space.
 * @param  string $location : the URL to navigate to
 */
function redirect_to($location = NULL) {
  if ($location != NULL) {
    header("Location:{$location}");
    exit;
  }
}
?>
```

## Create Initialize File

- `includes/initialize.php`

```php
<?php
require_once 'db.php'; // Establishes database connection
require_once 'functions.php';     // Load custom PHP functions

// Global variables
$site_title = 'IDM Course Catalog';
?>
```

## Create Public Index File

- `public/index.php`

```php
<?php require_once '../includes/initialize.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo $site_title; ?></title>
  <link rel="stylesheet" href="css/screen.css">
</head>
<body>

</body>
</html>
```

## Refactor `public/includes/_head.php` Partial

```diff
<?php require_once '../includes/initialize.php'; ?>

- <!DOCTYPE html>
- <html lang="en">
- <head>
-   <meta charset="UTF-8">
-   <meta name="viewport" content="width=device-width, initial-scale=1.0">
-   <meta http-equiv="X-UA-Compatible" content="ie=edge">
-   <title><?php echo $site_title; ?></title>
-   <link rel="stylesheet" href="css/screen.css">
- </head>
+ <?php require_once 'includes/_head.php'; ?>
<body>

</body>
</html>
```

## Setup `_header.php` Partial

```diff
<?php require_once '../includes/initialize.php'; ?>
<?php require_once 'includes/_head.php'; ?>

- <body>
+ <body class="index">

+   <?php include 'includes/_header.php'; ?>
</body>
</html>
```

## Create `public/includes/_header.php` Partial

```php
<header role="banner">
  <div class="header__logo">
    <a href="index.php"><img src="http://placehold.it/400x100" alt="placeholder"></a>
  </div>
  <nav role="navigation">
    <ul>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
      <li><a href="#">Resume</a></li>
    </ul>
  </nav>
</header>
```

## Build Main Content

- `public/index.php`

```php
<main role="main">
  <h1>Course Catalog</h1>
  <div class="courses">

    <?php
      $query = "SELECT * ";
      $query .= "FROM courses ";
      $query .= "ORDER BY id ASC";

      $result = mysqli_query($connection, $query);

      if (!$result) {
        die("Database query failed.");
      }

      while ($course = mysqli_fetch_assoc($result)) {
        if ($course["courseVisible"] == 1) {
    ?>

    <div class="course">
      <figure>
        <img
          src="<?php echo $course["courseImageSmall"]; ?>"
          alt="<?php echo $course["courseTitle"]; ?>"
        >
        <figcaption>
          <?php echo $course["courseTitle"]; ?>
        </figcaption>
      </figure>

      <div class="call_to_action">
        <a
          href="course.php?id=<?php echo $course["id"]; ?>"
          class="btn">Learn More</a>
      </div>
    </div>

    <?php
        } // end if
      } // end while loop
      mysqli_free_result($result);
    ?>

  </div>
</main>
```

## Create `public/course.php`

```php
<?php require_once '../includes/initialize.php'; ?>
<?php
  # Get the `id` from URL parameter
  $id = isset($_GET["id"]) ? $_GET["id"] : null;

  # Same as
  // if (isset($_GET["id"])) {
  //   $id = $_GET["id"];
  // } else {
  //   $id = null;
  // }

  # If no ID, redirect
  if (!$id) {
    redirect_to("index.php");
  } else {
    $query = 'SELECT * ';
    $query .= 'FROM courses ';
    $query .= "WHERE id = '{$id}' ";
    $query .= 'LIMIT 1';

    $result = mysqli_query($connection, $query);

    if (!$result) {
      die('Database query failed.');
    }
  }

  include_once "includes/_head.php";
?>

<body class="single single-course">

  <?php
    include "includes/_header.php";

    while ($course = mysqli_fetch_assoc($result)) {
  ?>

    <div class="mast">
      <picture>
        <source media="(min-width: 900px)" srcset="<?php echo $course['courseImageLarge']; ?>">
        <source media="(min-width: 600px)" srcset="<?php echo $course['courseImageMedium']; ?>">
        <img
          src="<?php echo $course['courseImageSmall']; ?>"
          alt="<?php echo $course['courseTitle']; ?>">
      </picture>
    </div>

    <main role="main">
      <section class="container">
        <h1>
          <?php echo $course["courseTitle"]; ?>
        </h1>
        <?php echo $course["courseDetails"]; ?>
      </section>
    </main>

  <?php
    } // end while loop
    mysqli_free_result($result);
  ?>

</body>
</html>
```

## Create Admin Index `admin/index.php`

### Create `admin/includes/_head.php` Partial

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <title>IDM Course Catalog - CMS</title>
  <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
</head>
```

## Build `admin/index.php` Initial Structure

```php
<?php require_once "../includes/initialize.php"; ?>
<?php include_once "includes/_head.php"; ?>

<body>
  <div class="container">
    <aside class="col-md-4">
      <h2>Courses</h2>
    </aside>
    <main class="col-md-8">
      <h2>Manage Courses</h2>
    </main>
  </div>
</body>
</html>
```

## Move Aside Into `admin/includes/_aside.php` Partial

```diff
<body>
  <div class="container">
-   <aside class="col-md-3">
-     <h2>Courses</h2>
-   </aside>
+   <?php include "includes/_aside.php"; ?>
    <main class="col-md-9">
      <h2>Manage Courses</h2>
    </main>
  </div>
</body>
```

### Create `admin/includes/_aside.php` Partial

```php
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
        echo '"';
        echo ">{$course['courseTitle']}</a>";
      } // end while loop
      mysqli_free_result($result);
    ?>
  </div>
</aside>
```

## Add Form To `admin/index.php`

```php
<?php require_once "../includes/initialize.php"; ?>
<?php include_once "includes/_head.php"; ?>

<body>
  <div class="container">
    <?php include "includes/_aside.php"; ?>
    <main class="col-md-8">
      <h2>Manage Courses</h2>

      <form>
        <div class="form-group">
          <label for="courseTitle">Course Name</label>
          <input type="text" class="form-control" name="courseTitle">
        </div>
        <div class="form-group">
          <label for="courseImageSmall">Small Image</label>
          <input type="text" class="form-control" name="courseImageSmall">
        </div>
        <div class="form-group">
          <label for="courseImageMedium">Medium Image</label>
          <input type="text" class="form-control" name="courseImageMedium">
        </div>
        <div class="form-group">
          <label for="courseImageLarge">Large Image</label>
          <input type="text" class="form-control" name="courseImageLarge">
        </div>
        <div class="form-group">
          <label for="courseDetails">Course Details</label>
          <textarea class="form-control" name="courseDetails" id="courseDetails" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="courseVisible">Course Visibility</label>
          <select class="form-control" name="courseVisible" id="courseVisible">
            <option value="0">Hidden</option>
            <option value="1">Visible</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </form>

    </main>
  </div>
</body>
</html>
```

## Create `admin/includes/_scripts.php` Partial

```html
<!-- jQyery & Bootstrap -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
```

## Add Scripts Partial and CKEditor

- `admin/index.php`

```diff
</main>
  </div>

+ <?php require_once "includes/_scripts.php"; ?>
+ <script> CKEDITOR.replace( 'courseDetails' ); </script>
</body>
</html>
```

## Catch `id` And Populate Form

- `admin/index.php`

```diff
<?php require_once "../includes/initialize.php"; ?>
+<?php
+  if (isset($_GET["id"])) {
+    $id = $_GET["id"];
+
+    /**
+    Since the 'id' value is coming from our URL string, it isn't safe.
+    To avoid a lethal SQL injection, we have to escape the value before
+    we us it in our SQL statement.
+    */
+    $safe_id = mysqli_real_escape_string($connection, $id);
+  }
+?>
<?php include_once "includes/_head.php"; ?>

<body>
  <div class="container">
    <?php include "includes/_aside.php"; ?>
    <main class="col-md-8">
      <h2>Manage Courses</h2>

+     <?php
+       if (isset($safe_id)) {
+         $query = 'SELECT * ';
+         $query .= 'FROM courses ';
+         $query .= "WHERE id = {$safe_id} ";
+         $query .= 'LIMIT 1';

+         $result = mysqli_query($connection, $query);

+         if (!$result) {
+           die('Database query failed.');
+         }

+         while ($course = mysqli_fetch_assoc($result)) {
+       }
+     ?>

      <form>
        <div class="form-group">
          <label for="courseTitle">Course Name</label>
          <input type="text" class="form-control" name="courseTitle">
        </div>
        <div class="form-group">
          <label for="courseImageSmall">Small Image</label>
          <input type="text" class="form-control" name="courseImageSmall">
        </div>
        <div class="form-group">
          <label for="courseImageMedium">Medium Image</label>
          <input type="text" class="form-control" name="courseImageMedium">
        </div>
        <div class="form-group">
          <label for="courseImageLarge">Large Image</label>
          <input type="text" class="form-control" name="courseImageLarge">
        </div>
        <div class="form-group">
          <label for="courseDetails">Course Details</label>
          <textarea class="form-control" name="courseDetails" id="courseDetails" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="courseVisible">Course Visibility</label>
          <select class="form-control" name="courseVisible" id="courseVisible">
            <option value="0">Hidden</option>
            <option value="1">Visible</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </form>

+     <?php
+         } // end while loop
+       } else {
+         echo "<p>Select a course to edit from the menu.</p>";
+       } // end if
+     ?>

    </main>
  </div>

  <?php require_once "includes/_scripts.php"; ?>
  <script> CKEDITOR.replace( 'courseDetails' ); </script>
</body>
</html>
```

## Update Form To Use DB Values

```diff
<form>
  <div class="form-group">
    <label for="courseTitle">Course Name</label>
-   <input type="text" class="form-control" name="courseTitle">
+   <input type="text" class="form-control" name="courseTitle" value="<?php echo $course['courseTitle']; ?>" required>
  </div>
  <div class="form-group">
    <label for="courseImageSmall">Small Image</label>
-   <input type="text" class="form-control" name="courseImageSmall">
+   <input type="text" class="form-control" name="courseImageSmall" value="<?php echo $course['courseImageSmall']; ?>" required>
  </div>
  <div class="form-group">
    <label for="courseImageMedium">Medium Image</label>
-   <input type="text" class="form-control" name="courseImageMedium">
+   <input type="text" class="form-control" name="courseImageMedium" value="<?php echo $course['courseImageMedium']; ?>" required>
  </div>
  <div class="form-group">
    <label for="courseImageLarge">Large Image</label>
-   <input type="text" class="form-control" name="courseImageLarge">
+   <input type="text" class="form-control" name="courseImageLarge" value="<?php echo $course['courseImageLarge']; ?>" required>
  </div>
  <div class="form-group">
    <label for="courseDetails">Course Details</label>
-   <textarea class="form-control" name="courseDetails" id="courseDetails" rows="3"></textarea>
+   <textarea class="form-control" name="courseDetails" id="courseDetails" rows="3" required>
+     <?php echo $course['courseDetails']; ?>
+   </textarea>
  </div>
  <div class="form-group">
    <label for="courseVisible">Course Visibility</label>
    <select class="form-control" name="courseVisible" id="courseVisible">
-     <option value="0">Hidden</option>
-     <option value="1">Visible</option>
+     <option
+       value="0"
+       <?php if ($course['courseVisible'] == 0) echo " selected"; ?>
+     >
+       Hidden</option>
+     <option
+       value="1"
+       <?php if ($course['courseVisible'] == 1) echo " selected"; ?>
+     >Visible</option>
    </select>
  </div>
  <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
```

## Update `admin/includes/_aside.php` To Show Active Button Styles

```diff
while ($course = mysqli_fetch_assoc($result)) {
  echo '<a href="index.php?id=';
  echo urlencode($course["id"]);
  echo '"';
  echo 'class="list-group-item';

+ if (isset($safe_id)) {
+   if ($course["id"] == $safe_id) {
+     echo " active";
+   }
+ }

  echo '"';
  echo ">{$course['courseTitle']}</a>";
} // end while loop
```

## Update `admin/index.php` Form Method

```diff
- <form>
+ <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $safe_id; ?>">
```

## Update `admin/index.php` To Handle Form Submission

```php
//  $safe_id = mysqli_real_escape_string($connection, $id);
// }

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
// ?>
// <?php include_once "includes/_head.php"; ?>
```

### Show Message If Needed

```diff
<main class="col-md-8">

+ <?php
+   if (isset($message)) {
+     echo $message;
+   }
+ ?>

<h2>Manage Courses</h2>
```

## Add "Add Course" Button To `admin/includes/_aside.php`

```diff
      mysqli_free_result($result);
    ?>

+   <a href="add_course.php" class="list-group-item"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Course</a>

  </div>
</aside>
```

## Create `admin/add_course.php`

```php
<?php require_once "../includes/initialize.php"; ?>
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
```

## Build `admin/add_course.php` Query Commands

```php
// <?php require_once "../includes/initialize.php"; ?>
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
// <?php include_once "includes/_head.php"; ?>
```