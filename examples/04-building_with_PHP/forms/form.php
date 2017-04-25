<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form</title>
  <style media="screen">
    body {
      font: 100%/1.5 sans-serif;
    }
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

  <!--
  So I've got my form with its action, which is form_processing.php. That's the page that doesn't exist yet, but it's where we're going to send this data, so this is going to post the data to form_processing.php. And the method that it will use is post, and that's common, and we're going to do that with almost all forms, send them as post data.

  And then we've got our user name, where I'm going to have an input field. It's going to be a text field, and the `name` of that is going to be `username`. Now, this is important because this is the key in the associative array on the processing page that I'm going to look for. So inside post, there'll be a value for `username`, and it'll be exactly the name that's here. Now, there is no value for it, it's just going to be a blank field. Then on the next line, I've got password. Everything's the same, except that it's of type password, which just means that it doesn't show the text as I've typed it. It puts bullets instead. And then last of all, I've got a submit button down here, that's what this is. And it's going to have the text submit on it, the type is submit. I've also got a name attribute for submit.

  If we click submit, the form is submitted to `form_processing.php` (which doesn't exist yet). Let's build that page. (form_processing.php)
  -->

  <form action="form_processing.php" method="post">
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
