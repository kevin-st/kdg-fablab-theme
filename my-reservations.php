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
  <?php
    if (isset($_SESSION['sent'])) {
      if ($_SESSION['sent']) {
        $_SESSION['sent'] = FALSE;
  ?>
    <div class="modal modal-<?php echo isset($_SESSION['msg-type']) ? $_SESSION['msg-type'] : ""; ?>">
      <p><?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : "Er ging iets mis."; ?></p>
    </div>
  <?php
      }
    }
  ?>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
