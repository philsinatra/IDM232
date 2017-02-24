<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Encoding GET Variables - Page 1</title>
</head>
<body>
  <?php
    $id = 5;
    /**
     * In addition to providing an `id`, let's also provide a `company` attribute.
     * The company name will be Johnson & Johnson
     */
    $company = "Johnson & Johnson";
  ?>

  <!-- Here's well build our link and pass both parameters to encode2.php -->
  <p>
    <a href="encode2.php?id=<?php echo $id; ?>&company=<?php echo $company; ?>">Encode Page 2</a>
  </p>


  <!-- _____________________________________________________________________________________________________________ -->

  <!-- We need to use `urlencode` on the company parameter when we build our URL. -->
  <p>
    <a href="encode2.php?id=<?php echo $id; ?>&company=<?php echo urlencode($company); ?>">Encode Page 2</a>
  </p>

  <!-- (REVIEW NEW URL IN BROWSER) -->
  <!-- (RETURN TO SLIDESHOW) -->

  <!-- _____________________________________________________________________________________________________________ -->

  <!-- `rawurlencode` -->
  <p>
    <a href="encode2.php?id=<?php echo $id; ?>&company=<?php echo rawurlencode($company); ?>">RAW Encode Page 2</a>
  </p>

  <!-- (REVIEW NEW URL IN BROWSER) -->
  <!-- (RETURN TO SLIDESHOW) -->

</body>
</html>
