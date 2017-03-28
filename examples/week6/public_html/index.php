<?php require_once 'includes/initialize.php'; ?>
<?php include_once 'includes/_head.php'; ?>

<!-- .index used to target CSS styles specific to the homepage -->
<body class="index">

  <!-- Header include contains the logo and navigation -->
  <?php include 'includes/_header.php'; ?>

  <main role="main">
    <h1>Course Catalog</h1>
    <!-- .courses used for styling a grid of available courses -->
    <div class="courses">

      <?php
        $query = 'SELECT * ';
        $query .= 'FROM courses ';
        $query .= 'ORDER BY id ASC';

        $result = mysqli_query($connection, $query);

        if (!$result) {
          die('Database query failed.');
        }

        while ($course = mysqli_fetch_assoc($result)) {
          if ($course['courseVisible'] == 1) {
      ?>

        <div class="course">
          <figure>
            <img src="<?php echo $course['courseImageSmall']; ?>" alt="<?php echo $course['courseTitle']; ?>">
            <figcaption><?php echo $course['courseTitle']; ?></figcaption>
          </figure>
          <div class="call_to_action">
            <a href="course.php?id=<?php echo $course['id']; ?>" class="btn">Learn More</a>
          </div>
        </div>

      <?php
          } // end if
        } // end while
        mysqli_free_result($result);
      ?>

    </div>
  </main>

  <?php include 'includes/_footer.php'; ?>
</body>
</html>
