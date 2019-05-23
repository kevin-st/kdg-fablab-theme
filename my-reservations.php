<?php
  /* Template Name: Mijn reservaties template */

  // when reservation plugin is not activated, don't show the content of this page
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

  if (!is_plugin_active("kdg-fablab-reservation-system/kdg-fablab-reservation-system.php")) {
    wp_redirect(site_url('/mijn-profiel'));
  }

  // when not logged in, don't show the content of this page
  if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
  }

  kdg_fablab_reset_reservation_process();

  get_header();
?>
<main id="mainArchive">
  <?php
    while(have_posts()) {
      the_post();
    ?>
    <h1>
      <?php the_title(); ?>
    </h1>
    <?php
    }

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
  <div role="reservations" class="disp-f">
    <?php
      $all_reservations_current_user = new WP_Query([
        "post_type" => "reservation",
        "posts_per_page" => -1,
        "author" => get_current_user_id()
      ]);

      while($all_reservations_current_user->have_posts()) {
        $all_reservations_current_user->the_post();
    ?>
    <article class="reservation">
      <?php
        // declare variables for current post
        $reservation_type = get_post_meta($post->ID, "reservation_type", true);
        $reservation_date = NULL;
        $reservation_time_slots = NULL;

        if ($reservation_type === "machine") {
          $reservation_date = date_i18n("d F Y", strtotime(get_post_meta($post->ID, "reservation_date", true)));
          $reservation_time_slots = get_post_meta($post->ID, "reservation_time_slots", true);
        } else {
          // fetch the name of the current reservation item
          $reservation_item = get_post_meta($post->ID, "reservation_item", true);
          // fetch the workshop by the found name
          $workshop = get_page_by_title($reservation_item, OBJECT, "workshop");

          // set the reservation date
          $reservation_date = get_field("workshop_datum", $workshop->ID);
          // set the time slots
          $reservation_time_slots[] = get_field("start_tijd", $workshop->ID);
          $reservation_time_slots[] = get_field("eind_tijd", $workshop->ID);
        }
      ?>
      <h2>
        <?php the_title(); ?>
        <span class="reservation-type">
          <?php echo ($reservation_type === "workshop") ? $reservation_type : "toestel"; ?>
        </span>
      </h2>
      <p>
        <span>Datum:</span>
        <?php echo $reservation_date; ?>
      </p>
      <p>
        <span>Tijdstippen:</span>
        <?php echo implode(" - ", $reservation_time_slots); ?>
      </p>
    </article>
    <?php
      }
    ?>
  </div>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
