<?php
  /**
   * 2. Next we want to check if the form was submitted.
   */
  if (isset($_POST['submit'])) {
    // form was submitted
    //
    // If the form was submitted, let's log our variables.
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Let's also setup a message that we can display later on the page.
    $message = "Logging in: {$username}";
  }
  else {
    // form was NOT submitted
    //
    // Form was not submitted, so let's change the message.
    $message = "Please log in.";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form</title>
  <style media="screen">
    form {
      height: 6.25rem;
      width: 6.25rem;
      position: absolute;
      top: 0; right: 0; bottom: 0; left: 0;
      margin: auto;
    }
    .control {
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>

  <?php
    // 3. Let's echo our message.
    echo "<p>{$message}</p>";
    // 4. Next, let's put some default values in our form. (form_single-02.php)
   ?>

  <!--
  1.  First we change the form "action" to point to this same file (form_single.php).
      So the form is going to submit to itself.
  -->
  <form action="form_single-01.php" method="post">
    <div class="control">
      <label for="username">Username:</label>
      <input type="text" name="username" value="">
    </div>
    <div class="control">
      <label for="password">Password:</label>
      <input type="password" name="password" value="">
    </div>
    <input type="submit" name="submit" value="Submit">
  </form>

</body>
</html>
