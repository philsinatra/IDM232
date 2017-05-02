  <h2>Task 01</h2>
  <p>This page will generate a random number each time the Test function runs. Create an <i>if statement</i> with the following output:</p>
  <ul>
    <li>If the random number that is generated is less than 50, print the phrase "small number" to the screen.</li>
    <li>If the random number that is generated is greater than 50, print the phrase "large number" to the screen.</li>
    <li>If the random number that is generated is exactly 50, print the phrase "how about that?" to the screen.</li>
  </ul>

  <pre class="solution">
    <?php
    $rand = rand(10,100);
    echo "Random number = {$rand}<br><br>";
    //Your solution here.

    // end your solution
    ?>
  </pre>
