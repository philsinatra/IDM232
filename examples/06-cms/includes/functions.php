<?php
/**
 * Redirect to a new location.
 * This must be called prior to any HTML
 * being rendered, including even a single space.
 * @param  string $location : the URL to navigate to
 */
function redirect_to($location = NULL) {
  if ($location != NULL) {
    header("Location:{$location}");
    exit;
  }
}
?>
