<?php
  /* Template Name: Mijn reservaties template */

  // when not logged in, don't show the content of this page
  if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
  }

  get_header();
?>
<main>
  <h1>Dit is het overzicht van mijn reservaties.</h1>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
