  <h2>Task 12</h2>
  <p>I've created a function for you:</p>
  <pre>
function say_hello($name, $color="red", $sport="hockey") {
  $string = "{$name} loves to play {$sport} for the {$color} team.";
  return $string;
}
  </pre>
  <p>Use this function to print the following sentence to the screen:</p>
  <pre>
Little Johnny loves to play football for the green team.
  </pre>

  <pre class="solution">
    <?php
    function say_hello($name, $color="red", $sport="hockey") {
      $string = "{$name} loves to play {$sport} for the {$color} team.";
      return $string;
    }
    //Your solution here.
    
    // end your solution
    ?>
  </pre>
