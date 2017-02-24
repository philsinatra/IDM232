<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Encoding GET Variables - Combined Techniques</title>
</head>
<body>

  <?php
    $page = "William Shakespear";
    $quote = "To be or not to be";

    $link = rawurlencode($page) . "?quote=" . urlencode($quote);

    echo $link;
  ?>
</body>
</html>
