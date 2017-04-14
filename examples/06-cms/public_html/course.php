<?php require_once 'includes/initialize.php'; ?>
<?php
  // Get the `id` from the URL parameter.
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  // If no parameter is provided, redirect to the home page.
  if (!$id) redirect_to('index.php');
  else {
    // Parameter is provided.
    // Look for a matching ID in the database.
    $query = 'SELECT * ';
    $query .= 'FROM courses ';
    $query .= "WHERE id = '{$id}' ";
    $query .= 'LIMIT 1';

    $result = mysqli_query($connection, $query);

    if (!$result) {
      die('Database query failed.');
    }

  }
?>

<?php include_once 'includes/_head.php'; ?>

<!--
.single used for styling this and any templates that are
used to display basic content in a single column.
It exists in case we build an example of a 'pages' template
that would be similar to the 'course' template.

.single-course is for styles that apply specifically to a
single course within this template.
 -->
<body class="single single-course">

  <?php include 'includes/_header.php'; ?>

    <?php
      while ($course = mysqli_fetch_assoc($result)) {
    ?>

      <div class="mast">
        <picture>
          <source media="(min-width: 900px)" srcset="<?php echo $course['courseImageLarge']; ?>">
          <source media="(min-width: 600px)" srcset="<?php echo $course['courseImageMedium']; ?>">
          <img src="<?php echo $course['courseImageSmall']; ?>" alt="<?php echo $course['courseTitle']; ?>">
        </picture>
      </div>

      <main role="main">
        <section class="container">
          <h1><?php echo $course['courseTitle']; ?></h1>

          <?php echo $course['courseDetails']; ?>
        </section>
      </main>

    <?php
      } // end while
      mysqli_free_result($result);
    ?>

  <?php include 'includes/_footer.php'; ?>

</body>
</html>
