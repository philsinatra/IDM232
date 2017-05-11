build-lists: true
footer: IDM 232: Scripting for IDM II
slidenumbers: true
autoscale: true
theme: Plain Jane, 2

# IDM 232
## Scripting for<br>Interactive Digital Media II

---

## Week 6
### Build the CMS

---

## Project Plan

- create database
- create base template
- create form template
- query database
- CRUD database content

^ Our project plan today is to create a template for a content management system. We're going to build a form that will allow us to add and update content in our database. We're going to use the CSS Framework [Bootstrap](http://getbootstrap.com) to save some time with the UI.

---

## The Database

```sql
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
```

^ Here's the SQL for the table we're creating. You can create this table in PHPMyAdmin. We're building a course catalog for the IDM department. Each course will have a title and details, and some images to use in the public website.

---

## The Connection

```php
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'idm232-courses');

// Connect using the constants
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
```

^ Next, let's create our PHP include for connecting to the database.

---

## The Head

```html
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet"
   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
   integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
   crossorigin="anonymous">
  <title>IDM Course Catalog - CMS</title>
</head>
```

^ We'll start by setting up an _include_ to use as the _head_ for our pages. Notice our mobile meta tag, and a link to the Bootstrap master stylesheet.

---

## Footer

```html
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
crossorigin="anonymous"></script>
```

^ And here is our footer _include_ which right now contains a link to jQuery and the master Bootstrap javascript file. Bootstrap is being used only to handle the UI, which is simply saving us time in this example instead of building a custom UI from scratch.

---

## The Form

```html
<form method="POST"
      action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>">
  <div class="form-group">
    <label for="courseTitle">Course Name</label>
    <input type="text"
      class="form-control"
      name="courseTitle"
      id="courseTitle"
      placeholder="My course Title"
      value="<?php echo $course['courseTitle']; ?>">
  </div>
```

^ Next we build the form we'll use to add or update our database. Here's a sample of the form. This sample shows one of the input fields, the _course name_ field. The full field would have all of the inputs for each of the items we are managing (images, details, visibility).

---

## The Aside

```html
<aside class="col-md-3">
  <h2>Courses</h2>
  <div class="list-group">
```

^ Next, we're setting up a sidebar that will list all of the courses in the database, as links. The goal is to setup each link so that when clicked, the form will reload and populate all of the fields with the information that's currently in the database. Then we can edit the form fields, and submit the form to update the database.

---

## The Aside

```php
$query = 'SELECT id, courseTitle ';
$query .= 'FROM courses ';
$query .= 'ORDER BY id ASC';

$result = mysqli_query($connection, $query);

if (!$result) {
  die('Database query failed.');
}
```

^ We'll do that first by querying the database and selecting the `id` and `courseTitle` from our `courses` table.

---

## The Aside

```php
while ($course = mysqli_fetch_assoc($result)) {
  echo '<a href="manage_courses.php?id=';
  echo urlencode($course['id']);
  echo '" class="list-group-item';
  if (isset($safe_id)) {
    if ($course['id'] == $safe_id) {
      echo ' active';
    }
  }
  echo '">';
  echo $course['courseTitle'];
  echo '</a>';
} // end while
```

^ We loop through all of the courses, creating an `anchor` element for each one. The `a` is going to link to the _manage_courses.php_ page, which is the same page we're currently on, but it will append the selected course's `id` to the URL.

^ We also put in a conditional to check that the `id` is set, and if it is, we add a class `active` to our `a`. So if the page is loaded without an `id` URL parameter, none of the links are active. If there is an `id`, then we are going to highlight the button related to that `id` in the nav list.

---

## The Aside

```html
mysqli_free_result($result);
?>

<a href="add_course.php"
  class="list-group-item">
  <span class="glyphicon glyphicon-plus"
    aria-hidden="true"></span> Add Course</a>
```

^ After our nav list, we tack on an extra button for adding a new course, which we'll get to in a minute.

---

## Manage Courses

```html
<?php require_once '../includes/db_connection.php'; ?>
```

^ Back to our form, we're going to include our database connection first.

---

## Manage Courses

```php
// Check if the 'id' parameter is set
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $safe_id = mysqli_real_escape_string($connection, $id);
}
```

^ Next, we want to check if the form should be empty, or populated with the content of a database entry. We'll do that based on the presence of a URL parameter `id`.

^ Since the 'id' value is coming from our URL string, it isn't safe. To avoid a lethal SQL injection, we have to escape the value before we us it in our SQL statement.

---

## Manage Courses

```php
if (isset($safe_id)) {
  $query = 'SELECT * ';
  $query .= 'FROM courses ';
  $query .= "WHERE id = {$safe_id} ";
  $query .= 'LIMIT 1';

  $result = mysqli_query($connection, $query);
```

^ We also need to get all the information related to a database entry if that `safe_id` exists. We're going to take all of the information in the database for this entry and populate our form with the values.

---

### PHP

```php
  while ($course = mysqli_fetch_assoc($result)) {
```

### HTML

```html
<input type="text" class="form-control"
  name="courseTitle"
  id="courseTitle"
  placeholder="My course Title"
  value="<?php echo $course['courseTitle']; ?>">
```

---

### Course Visibility Example

```html
<select class="form-control" name="courseVisible" id="courseVisible">
  <option value="0"
    <?php if ($course['courseVisible'] == 0) echo 'selected'; ?>>Hidden</option>
  <option value="1"
    <?php if ($course['courseVisible'] == 1) echo 'selected'; ?>>Visible</option>
</select>
```

^ We use some `if` statements to toggle the _visibility_ checkboxes.

---

### Submit Button

```html
<button type="submit"
  name="submit"
  class="btn btn-default">Submit</button>
```

^ And at the end of our form, we have our submit button. Next we have to deal with what happens when the form is submitted.

---

### Form Submission

```php
if (isset($_POST['submit'])) {
  $course_title = mysqli_real_escape_string(
    $connection, $_POST['courseTitle']);
  $course_image_small = mysqli_real_escape_string(
    $connection, $_POST['courseImageSmall']);
  $course_image_medium = mysqli_real_escape_string(
    $connection, $_POST['courseImageMedium']);
  $course_image_large = mysqli_real_escape_string(
    $connection, $_POST['courseImageLarge']);
  $course_details = mysqli_real_escape_string(
    $connection, $_POST['courseDetails']);
  $course_visible = (int) $_POST['courseVisible'];
```

^ If our form has been submitted, we being by gathering the posted values from the form into variables.

---

### Form Validation

```php
$errors = array();
$required_fields = array(
  'courseTitle',
  'courseImageSmall',
  'courseImageMedium',
  'courseImageLarge',
  'courseDetails'
);
```

^ Form validation should have happened on the client side prior to the form being successfully submitted, but just in case something slipped through the cracks, we're going to double check everything on the server side.

---

### Form Validation

```php
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
```

^ If our errors array is not empty, we have to inform the user of the problems and stop any further database communication.

---

### Update Database

```php
$query = 'UPDATE courses SET ';
$query .= "courseTitle = '{$course_title}', ";
$query .= "courseImageSmall = '{$course_image_small}', ";
$query .= "courseImageMedium = '{$course_image_medium}', ";
$query .= "courseImageLarge = '{$course_image_large}', ";
$query .= "courseDetails = '{$course_details}', ";
$query .= "courseVisible = '{$course_visible}' ";
$query .= "WHERE id = {$id} ";
$query .= 'LIMIT 1';
```

^ No errors - let's update the database. We'll start by setting up our query string.

---

### Query The Database

```php
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
  // Success
} else {
  // Failure
}
```

^ If the result was successful and the number of effected rows equals 1, we've updated the database successfully. What about adding a new course to the database?

---

## Add Course

```html
<label for="courseTitle">Course Name</label>
<input type="text"
  class="form-control"
  name="courseTitle"
  id="courseTitle"
  placeholder="My course Title" required>
```

^ We can use the same form since all of the fields are the same.

---

### Form Submission

```php
if (isset($_POST['submit'])) {
  $course_title = mysqli_real_escape_string(
    $connection, $_POST['courseTitle']);
  $course_image_small = mysqli_real_escape_string(
    $connection, $_POST['courseImageSmall']);
  $course_image_medium = mysqli_real_escape_string(
    $connection, $_POST['courseImageMedium']);
  $course_image_large = mysqli_real_escape_string(
    $connection, $_POST['courseImageLarge']);
  $course_details = mysqli_real_escape_string(
    $connection, $_POST['courseDetails']);
  $course_visible = (int) $_POST['courseVisible'];
```

^ Start by gathering the posted values on submission.

---

### Form Validation

```php
$errors = array();
$required_fields = array(
  'courseTitle',
  'courseImageSmall',
  'courseImageMedium',
  'courseImageLarge',
  'courseDetails'
);
```

^ Validate again. (full process not shown again)

---

### Insert Statement

```sql
$query = "INSERT INTO courses (";
$query .= " courseTitle,
  courseImageSmall,
  courseImageMedium,
  courseImageLarge,
  courseDetails, courseVisible";
$query .= ") VALUES (";
$query .= " '{$course_title}',
  '{$course_image_small}',
  '{$course_image_medium}',
  '{$course_image_large}',
  '{$course_details}',
  '{$course_visible}'";
$query .= ")";
```

^ The main difference this time is instead of an `update` statement, we're going to create an `insert` statement, adding our values to a new entry in the database.

---

### Update Database

```php
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
  // Success
} else {
  // Failure
}
```

---

## Live Demo

^ (_examples/week6/admin/manage_courses.php_)

---

## Live Demo - Public Site

^ (_examples/week6/public_html/index.php_)

---

## CSS Grid Bonus

```scss
@media screen and (min-width: 32.5em)
{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-column-gap: 1rem;
}
@media screen and (min-width: 62.5em)
{
    max-width: 68.75rem;
    margin: 0 auto;
    grid-template-columns: 1fr 1fr 1fr;
}
```

^ Last term we mentioned CSS Grid as a new feature in CSS that was not yet available in major browsers. As of March 2017, CSS Grid is now available in Firefox, Chrome and Safari.

^ This example includes the CSS Grid, so check out the SASS files for some simple examples of how to implement some of the basics of CSS Grid.

---

## For Next Week...
