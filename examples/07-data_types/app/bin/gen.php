<?php
  $head        = '../includes/_head.php';
  $footer      = '../includes/_footer.php';

  $jsonurl     = '../data/data.json';

  /**
  * Get the contens of the .json file.
  * This information is stored in the $json variable as a string.
  * @var string
  */
  $json        = file_get_contents($jsonurl, 0, null, null);

  /**
  * Convert the string to a PHP variable that can then be manipulated.
  * @var array
  */
  $json_output = json_decode($json);

  // A basic counter.
  $i = 1;

  $dir = "../build/";

  /**
   * Begin building the unique content for each page of output.
   * Loop through all the of `categories` in the JSON data,
   * for each single `category` (which is a question), we're going
   * to generate a unique HTML file.
   */
  foreach ($json_output->categories as $category) {
    // Get the contents of our _head.php file to start each HTML file.
    $output = file_get_contents($head);

    // Write the `question` text in an <h1> element.
    // Then setup a <ul> for each of the possible answers.
    $output .= "<h1>{$category->question}</h1>";
    $output .= "<ul>";

    // A second counter, which we'll need for our second loop.
    $count = 1;

    /** For each possible `answer`, create a <li>
     * The anchors and spans within are dictated by the CSS design.
     * A lot of work happens before this point to figure out the
     * page design and functionality. All of that work is reflected here.
     */
    foreach ($category->answers as $answer) {
      $output .= "<li>";
      $output .= "<a href=\"#q_{$count}\" class=\"btn_option\">";
      $output .= "<span class=\"q_num\">{$count}</span>";
      $output .= "<span class=\"q_answer\">{$answer}</span>";
      $output .= "</a>";
      $output .= "</li>";

      $count++;
    }
    $output .= "</ul>";
    $output .= "</main>";
    $output .= "</div>"; // /.wrapper

    /**
     * If our primary counter is greater than 1, we're not building the first question page.
     * That means we need a `previous` button.
     */
    if ($i > 1) {
      $previous = $i - 1;
      $output .= "<a href=\"question-{$previous}.html\" class=\"btn_pagenav\" id=\"btn_prev\">";
      $output .= "<svg><use xlink:href=\"#arrow_left\"></use></svg>";
      $output .= "</a>";
    }

    /**
     * If our primary counter is not equal to the number of total `categories`, we're not
     * building the last question page. That means we need a `next` button.
     */
    if ($i != count($json_output->categories)) {
      $next = $i + 1;
      $output .= "<a href=\"question-{$next}.html\" class=\"btn_pagenav\" id=\"btn_next\">";
      $output .= "<svg><use xlink:href=\"#arrow_right\"></use></svg>";
      $output .= "</a>";
    }

    // This Javascript will be written inline, at the bottom of each page.
    $output .= "<script>";
    /**
     *  First we setup two variables, and set their values to false/0.
     *  These variables are going to determine if there is a next/previous screen.
     *  The javascript is going to look for these variables and add eventListeners for
     *  page navigation.
     */
    $output .= "var has_previous_screen = 0;\r";
    $output .= "var has_next_screen = 0;\r";
    if ($i > 1)
      $output .= "has_previous_screen = \"question-{$previous}.html\";\r";
    if ($i != count($json_output->categories))
      $output .= "has_next_screen = \"question-{$next}.html\";\r";
    $output .= "</script>";

    // Get the _footer.php file and add it to the end of each file.
    $output .= file_get_contents($footer);

    // Write a new HTML file for the current `question`.
    $file = fopen($dir . "question-" . $i . ".html", "w");
    fwrite($file, $output);
    fclose($file);

    // Increment our counter, and repeat the loop for the next `question`.
    $i++;
  }

  echo "Done. Check app/build/ for static HTML files.";
?>
