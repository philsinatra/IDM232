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