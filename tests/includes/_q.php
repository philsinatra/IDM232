<main>
  <?php
    for ($j = 1; $j <= $task_count; $j++) {
  ?>
    <section id="q<?php echo $j; ?>" hidden>
      <?php include 'includes/' . $q . '/q' . $j . '.php'; ?>
      <div class="controls">
        <div>
          <a href="<?php echo $_SERVER['PHP_SELF']; ?>?q=<?php echo $j; ?>" class="btn btn_reload">Test</a>
        </div>
        <div>
          <?php if ($j > 1) { ?>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?q=<?php echo $j-1; ?>" class="btn btn_prev">Previous</a>
          <?php } ?>
          <?php if ($j < $task_count) { ?>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?q=<?php echo $j+1; ?>" class="btn btn_next">Next</a>
          <?php } ?>
        </div>
      </div>
    </section>
  <?php
    } // end for loop
   ?>
</main>
