# Example Site Instructor Notes

<!-- TOC -->

## `include()`

1. Start with a basic HTML page:

    ```html
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title></title>
    </head>
    <body>
      <p>Hello World</p>
    </body>
    </html>
    ```

1. Separate the _header_ and _footer_ into individual include files.
1. Show updated _index.php_ file that includes _header_ and _footer_ files.

    ```php
    <?php include "includes/_header.php"; ?>
    <p>Hello World</p>
    <?php include "includes/_footer.php"; ?>
    ```

1. Build _functions.php_ file.

    ```php
    <?php
      function hello($name) {
        return "Hello {$name}";
      }
    ?>
    ```

1. Explain \_header.php is a _partial_ which is why it has the leading underscore in its name.
1. Update _index.php_ to include _functions.php_.

    ```php
    <?php
      include "includes/functions.php";
      include "includes/_header.php";
    ?>

    <?php echo hello("Everyone"); ?> <br>

    <?php include "includes/_footer.php"; ?>
    ```

1. _return to slideshow_
