<?php
  /**
   * Let's simply look at the information that was passed.
   * The form data has been posted to our processing page in an
   * associative array, we'll use `print_r` to take a look at that
   * array and the values that came through. Notice that the form
   * data was not passed in the URL like with $_GET.
   */
  print_r($_POST);

  // Let's extract each of the values and assign them to variables.
  $username = $_POST['username'];
  $password = $_POST['password'];
?>

<p>Username: <?php echo $username; ?></p>
<p>Password: <?php echo $password; ?></p>
