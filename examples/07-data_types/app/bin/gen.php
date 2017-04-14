<?php
  $head        = '../includes/_head.php';
  $footer      = '../includes/_footer.php';

  $jsonurl     = '../data/data.json';
  $json        = file_get_contents($jsonurl, 0, null, null);
  $json_output = json_decode($json);

  $i = 1;

  $dir = "../build/";

  foreach ($json_output->categories as $category) {
    $output = file_get_contents($head);

    $output .= "<h1>{$category->question}</h1>";
    $output .= "<ul>";

    $count = 1;
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

    if ($i > 1) {
      $previous = $i - 1;
      $output .= "<a href=\"question-{$previous}.html\" class=\"btn_pagenav\" id=\"btn_prev\">";
      $output .= "<svg><use xlink:href=\"#arrow_left\"></use></svg>";
      $output .= "</a>";
    }

    if ($i != count($json_output->categories)) {
      $next = $i + 1;
      $output .= "<a href=\"question-{$next}.html\" class=\"btn_pagenav\" id=\"btn_next\">";
      $output .= "<svg><use xlink:href=\"#arrow_right\"></use></svg>";
      $output .= "</a>";
    }

    $output .= "<script>";
    $output .= "var has_previous_screen = 0;\r";
    $output .= "var has_next_screen = 0;\r";
    if ($i > 1)
      $output .= "has_previous_screen = \"question-{$previous}.html\";\r";
    if ($i != count($json_output->categories))
      $output .= "has_next_screen = \"question-{$next}.html\";\r";
    $output .= "</script>";

    $output .= file_get_contents($footer);

    $file = fopen($dir . "question-" . $i . ".html", "w");
    fwrite($file, $output);
    fclose($file);

    $i++;
  }
?>
