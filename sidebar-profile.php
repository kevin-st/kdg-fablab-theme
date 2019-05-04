<div class="sidebar">
  <?php
    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('profile_sidebar')) {
      return;
    }
  ?>
</div>
