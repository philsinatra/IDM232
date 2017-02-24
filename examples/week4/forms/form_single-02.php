<?php
  // 3. Let's add a redirect. First we need to include our functions file (_functions.php_).
  require_once("functions.php");

  if (isset($_POST['submit'])) {
    // form was submitted
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 4. Let's now check if we're logged in:
    if ($username == "philsinatra" && $password == "secret") {
      // successful login
      // 5. Redict to whatever the next page would be (dashboard or something else)
      redirect_to("basic.html");
    }
    else {
      // unsuccessful login
    }

    $message = "Form was submitted, with errors.";
  }
  else {
    // form was NOT submitted
    $message = "Please log in.";

    // 1. If the form was not submitted, there is no username.
    //    So we can define the default value.
    $username = "philsinatra";
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
    echo "<p>{$message}</p>";
   ?>

  <form action="form_single-02.php" method="post">
    <div class="control">
      <label for="username">Username:</label>
      <!--
        2. Next we set the value attribute for our username input to our $username variable.
        Note, we have to use the `htmlspecialchars` function that we learned about since
        the user is going to be able to define the input. So if they use some type of special
        character in their username, we can make sure it's safe.
      -->
      <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
    </div>
    <div class="control">
      <label for="password">Password:</label>
      <input type="password" name="password" value="">
    </div>
    <input type="submit" name="submit" value="Submit">
  </form>

</body>
</html>
