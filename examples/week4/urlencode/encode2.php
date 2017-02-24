<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Page 2</title>
</head>
<body>

  <pre>
    <?php print_r($_GET); ?>
  </pre>

  <?php
    $id = $_GET['id'];
    $company = $_GET['company'];
    echo "ID: {$id}<br>";
    echo "Company: {$company}";

    /**
     * The ampersand is considered another parameter, which is why our
     * array has three keys, even though we're only passing two parameters
     * in our URL.
     *
     * The solution is to use `urlencode`
     * (return to encode1.php)
     */
  ?>
</body>
</html>
