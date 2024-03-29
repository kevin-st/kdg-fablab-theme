<?php /* Template Name: Reserveren Template */ ?>
<?php
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

  if (!is_plugin_active("kdg-fablab-reservation-system/kdg-fablab-reservation-system.php")) {
    wp_redirect(home_url());
  }

  if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
  }

  $current_step = isset($_SESSION["reservation"]["reservation-step"]) ? intval($_SESSION["reservation"]["reservation-step"]) : 0;
  $reservation_type = isset($_SESSION["reservation"]["reservation-type"]) ? $_SESSION["reservation"]["reservation-type"] : NULL;
  $reservation_item = isset($_SESSION["reservation"]["reservation-item"]) ? $_SESSION["reservation"]["reservation-item"] : NULL;
  $reservation_date = isset($_SESSION["reservation"]["reservation-date"]) ? $_SESSION["reservation"]["reservation-date"] : NULL;
  $reservation_time_slots = isset($_SESSION["reservation"]["reservation-time-slots"]) ? $_SESSION["reservation"]["reservation-time-slots"] : [];
  $errors = "";

  if (isset($_POST["submit"])) {
    // check if a certain step has errors
    $errors = KdGFablab_RS::kdg_fablab_rs_reservation_process($_POST, $current_step);

    // get updated values
    $current_step = KdGFablab_RS::kdg_fablab_rs_get_reservation_step();
    $reservation_type = KdGFablab_RS::kdg_fablab_rs_get_reservation_type();
    $reservation_item = KdGFablab_RS::kdg_fablab_rs_get_reservation_item();
    $reservation_date = KdGFablab_RS::kdg_fablab_rs_get_reservation_date();
    $reservation_time_slots = KdGFablab_RS::kdg_fablab_rs_get_reservation_time_slots();
  }

  /*echo "<pre>";
  echo "SESSIE";
  var_dump($_SESSION);
  echo "</pre>";

  echo "<pre>";
  echo "POST";
  var_dump($_POST);
  echo "</pre>";*/

  get_header();
?>
<main id="reserverenMain">
  <div class="title-content">
    <?php
      while(have_posts()) {
        the_post();
    ?>
    <h1><?php the_title(); ?></h1>
    <?php
        the_content();
      }
    ?>
  </div>

  <div class="progressbar-container">
    <ul class="disp-f progressbar m-0">
      <li class="<?php echo ($current_step === 0) ? "progressbar-active" : ""; ?>">
        Toestel of workshop
      </li>
      <?php if ($reservation_type === NULL || $current_step === 0) { ?>
      <li>Details reservatie</li>
    <?php } else if ($current_step > 0 && $reservation_type === "machine") { ?>

      <li class="<?php echo ($current_step === 1) ? "progressbar-active" : ""; ?>">
        Kies een toestel
      </li>
      <li class="<?php echo ($current_step === 2) ? "progressbar-active" : ""; ?>">
        Kies een tijdstip
      </li>

    <?php } else if ($current_step > 0 && $reservation_type === "workshop") { ?>
      <li class="<?php echo ($current_step === 1) ? "progressbar-active" : ""; ?>">
        Kies een workshop
      </li>

      <?php } ?>
      <li class="<?php echo ($current_step === 3) ? "progressbar-active" : ""; ?>">
        Bevestiging
      </li>
   </ul>
  </div>

  <div class="page-reserveren-content">
    <form id="reservation-form" action="<?php the_permalink(); ?>" method="post" novalidate>
      <?php if ($current_step === 0) { ?>
      <!-- Initial step -->
      <div class="input-group">
        <label for="reservation-type">Wat wilt u reserveren?</label>
        <select id="reservation-type" for="reservation-type" name="reservation-type" class="<?php echo (!empty($errors)) ? "error" : "" ; ?>">
          <option value="" <?php echo ($reservation_type == "") ? "selected" : ""; ?>>-- Kiezen --</option>
          <option value="machine" <?php echo ($reservation_type == "machine") ? "selected" : ""; ?>>Toestel</option>
          <option value="workshop" <?php echo ($reservation_type == "workshop") ? "selected" : ""; ?>>Workshop</option>
        </select>
        <span class="error-message <?php echo ($errors !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $errors; ?></span>
      </div>
      <input type="hidden" name="step" value="1" />
      <input class="btn-blue btn-submit" type="submit" name="submit" value="Volgende" />
      <!-- End of initial step -->
      <?php } ?>

      <?php if ($current_step === 1 && $reservation_type === "workshop") { ?>
      <!-- First step workshop -->
      <div class="input-group">
        <label for="reservation-item">Welke workshop wilt u reserveren?</label>
        <select id="reservation-item" name="reservation-item" class="<?php echo (!empty($errors)) ? "error" : ""; ?>">
          <option value="" <?php echo ($reservation_item == "") ? "selected" : ""; ?>>-- Kiezen --</option>
          <?php
            $today = date("Ymd");
            $all_workshops = new WP_Query([
              "posts_per_page" => -1, // control number of posts with this -> -1 is all posts
              "post_type" => "workshop",
              "meta_key" => "workshop_datum",
              "orderby" => "meta_value_num",
              "order" => "ASC",
              "meta_query" => [
                array(
                  "key" => "workshop_datum",
                  "compare" => ">=",
                  "value" => $today,
                  "type" => "numeric"
                )
              ]
            ]);

            while($all_workshops->have_posts()) {
              $all_workshops->the_post();
              $title = get_the_title();
          ?>
          <option value="<?php echo $title; ?>" <?php echo ($reservation_item == $title) ? "selected" : ""; ?>>
            <?php echo $title; ?>
          </option>
          <?php
            }
          ?>
        </select>
        <span class="error-message <?php echo (!empty($errors) && isset($errors["item-error"])) ? 'disp-b' : 'disp-n'; ?>">
          <?php echo (isset($errors["item-error"])) ? $errors["item-error"] : ""; ?>
        </span>
      </div>
      <input type="hidden" name="step" value="3" />
      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <input class="btn-dark btn-submit" name="submit" type="submit" value="Vorige" />
        </div>
        <div class="col-1-of-2">
          <input class="btn-blue btn-submit" name="submit" type="submit" value="Volgende" />
        </div>
      </div>
      <!-- End of first step workshop -->
      <?php } ?>

      <?php if ($current_step === 1 && $reservation_type === "machine") { ?>
      <!-- First step machine -->
      <div class="input-group">
        <label for="reservation-item">Welk toestel wilt u reserveren?</label>
        <select id="reservation-item" name="reservation-item" class="<?php echo (!empty($errors) && isset($errors["item-error"])) ? "error" : ""; ?>">
          <option value="" <?php echo ($reservation_item == "") ? "selected" : ""; ?>>-- Kiezen --</option>
          <?php
            $all_machines = new WP_Query([
              "posts_per_page" => -1,
              "post_type" => "machine"
            ]);

            while($all_machines->have_posts()) {
              $all_machines->the_post();
              $title = get_the_title();
          ?>
          <option value="<?php echo $title; ?>" <?php echo ($reservation_item == $title) ? "selected" : ""; ?>>
            <?php echo $title; ?>
          </option>
          <?php
            }
          ?>
        </select>
        <span class="error-message <?php echo (!empty($errors) && isset($errors["item-error"])) ? 'disp-b' : 'disp-n'; ?>">
          <?php echo (isset($errors["item-error"])) ? $errors["item-error"] : ""; ?>
        </span>
      </div>
      <div class="input-group">
        <label for="reservation-date">Selecteer de datum waarop u het toestel wilt reserveren.</label>
        <input id="reservation-date" name="reservation-date" type="date" value="<?php echo $reservation_date; ?>" class="<?php echo (!empty($errors) && isset($errors["date-error"])) ? "error" : ""; ?>" />
        <span class="error-message <?php echo (!empty($errors) && isset($errors["date-error"])) ? "disp-b" : "disp-n"; ?>">
          <?php echo (isset($errors["date-error"])) ? $errors["date-error"] : ""; ?>
        </span>
      </div>
      <input type="hidden" name="step" value="2" />
      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <input class="btn-dark btn-submit" name="submit" type="submit" value="Vorige" />
        </div>
        <div class="col-1-of-2">
          <input class="btn-blue btn-submit" name="submit" type="submit" value="Volgende" />
        </div>
      </div>
      <!-- End of first step machine -->
      <?php } ?>

      <?php if ($current_step === 2 && $reservation_type === "machine") { ?>
      <!-- Second step machine -->
      <?php
        $date_str_repr = ucwords(date_i18n("l, j F Y", strtotime($reservation_date)));
        $day_of_week = strtolower(date("l", strtotime($reservation_date)));

        // get the start and end hour of the day the user has selected
        // these values are set in the admin
        $start_hour_selected_day = get_option("kdg_fablab_rs_opening_hours")[$day_of_week]["start"];
        $end_hour_selected_day = get_option("kdg_fablab_rs_opening_hours")[$day_of_week]["end"];

        // get datetimes from found hours
        $start_date = new DateTime($day_of_week . " " . $start_hour_selected_day);
        $end_date = new DateTime($day_of_week . " " . $end_hour_selected_day);

        // count the amount of minutes between the two dates
        $diff_in_min = $start_date->diff($end_date);
        $diff_in_min = ($diff_in_min->h * 60) + $diff_in_min->i;

        // get the amount of timeslots available based on the timeslot setting in the admin
        // amount of minutes divided by timeslot setting = amount of timeslots available for this day
        $time_slot_setting = get_option("kdg_fablab_rs_time_slot");
        $amount_of_timeslots = $diff_in_min / $time_slot_setting;
      ?>
      <h3><?php echo $date_str_repr; ?></h3>
      <div class="time-slots-container">
        <p>Selecteer één of meerdere tijdsloten waarop u het toestel wilt reserveren.</p>
        <div role="time-slots" class="disp-f">
          <?php
            $current_time = $start_hour_selected_day;

            for ($i = 0; $i < $amount_of_timeslots; $i++) {
          ?>
          <div class="time-slot">
            <p class="time-slot-title"><?php echo $current_time; ?></p>
            <label>
              <input type="checkbox" name="reservation-time-slots[]" value="<?php echo $current_time; ?>" <?php echo (in_array($current_time, $reservation_time_slots)) ? "checked" : ""; ?> />
                <p class="labelReserveren">reserveren</p>
            </label>
          </div>
          <?php
              $current_time = date('H:i', strtotime("+". $time_slot_setting ." minutes", strtotime($current_time)));
            }
          ?>
        </div>
      </div>
      <span class="error-message message <?php echo (!empty($errors)) ? "disp-b" : "disp-n"; ?>">
        <?php echo $errors; ?>
      </span>
      <input type="hidden" name="step" value="3" />
      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <input class="btn-dark btn-submit" name="submit" type="submit" value="Vorige" />
        </div>
        <div class="col-1-of-2">
          <input class="btn-blue btn-submit" name="submit" type="submit" value="Volgende" />
        </div>
      </div>
      <!-- End of second step machine -->
      <?php } ?>

      <?php if ($current_step === 3) { ?>
      <!-- Third step -->
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

      <h2>Bevestig <?php echo ($reservation_type === "workshop") ? $reservation_type : "toestel"; ?></h2>
      <div class="disp-f col-4-of-4" role="info">
        <div class="col-1-of-4">
          <h3>Type reservatie</h3>
          <p><?php echo ($reservation_type === "workshop") ? ucwords($reservation_type) : "Toestel"; ?></p>

          <h3><?php echo ($reservation_type === "workshop") ? ucwords($reservation_type) : "Toestel"; ?></h3>
          <p><?php echo $reservation_item; ?></p>
        </div>
        <div class="col-1-of-4">
          <h3>Datum</h3>
          <?php
            echo "<p>". date_i18n("d F Y", strtotime($reservation_date)) ."</p>";
            echo "<h3>Tijdstippen</h3>";

            foreach ($reservation_time_slots as $time_slot) {
              echo "<p>". $time_slot ."</p>";
            }
          ?>
        </div>
      </div>

      <input type="hidden" name="step" value="final" />
      <div role="buttons" class="disp-f col-4-of-4">
        <div class="col-1-of-4">
          <input class="btn-dark btn-submit" name="submit" type="submit" value="Vorige" />
        </div>
        <div class="col-1-of-4">
          <input class="btn-blue btn-submit" name="submit" type="submit" value="Indienen" />
        </div>
      </div>
      <!-- End of third step -->
      <?php } ?>

    </form>
  </div>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
