<?php /* Template Name: Reserveren Template */ ?>
<?php
  $current_step = isset($_SESSION["reservation"]["reservation-step"]) ? intval($_SESSION["reservation"]["reservation-step"]) : 0;
  $reservation_type = isset($_SESSION["reservation"]["reservation-type"]) ? $_SESSION["reservation"]["reservation-type"] : NULL;
  $reservation_item = isset($_SESSION["reservation"]["reservation-item"]) ? $_SESSION["reservation"]["reservation-item"] : NULL;
  $reservation_date = isset($_SESSION["reservation"]["reservation-date"]) ? $_SESSION["reservation"]["reservation-date"] : NULL;
  $reservation_time_slots = isset($_SESSION["reservation"]["reservation-time-slots"]) ? $_SESSION["reservation"]["reservation-time-slots"] : [];

  // check if a certain step has errors
  $init_step_error = $first_step_error = $first_step_machine_date_error = $second_step_machine_time_slots_error = "";

  echo "<pre>";
  echo "SESSIE";
  var_dump($_SESSION);
  echo "</pre>";

  echo "<pre>";
  echo "POST";
  var_dump($_POST);
  echo "</pre>";

  if (isset($_POST["submit"])) {
    // When submit value is next
    if (strtolower($_POST["submit"]) === "volgende") {
      $next_step = isset($_POST["step"]) ? intval($_POST["step"]) : 0;

      // Initial step
      if ($current_step === 0) {
        if (!empty($_POST["reservation-type"])) {
          $_SESSION["reservation"]["reservation-type"] = $reservation_type = $_POST["reservation-type"];
        } else {
          $init_step_error = "Maak een keuze";
        }
      } // End of initial step
      else if ($current_step === 1) {
        // set the reservation-item
        if (!empty($_POST["reservation-item"])) {
          $_SESSION["reservation"]["reservation-item"] = $reservation_item = $_POST["reservation-item"];
        } else {
          $first_step_error = "Kies een " . (($reservation_type === "workshop") ? $reservation_type : "toestel");
        }

        if ($reservation_type === "machine") {
          if (!empty($_POST["reservation-date"])) {
            $_SESSION["reservation"]["reservation-date"] = $reservation_date = $_POST["reservation-date"];
          } else {
            $first_step_machine_date_error = "Selecteer een datum";
          }
        }
      } // End of first step
      else if ($current_step === 2) {
        if (isset($_POST["reservation-time-slots"]) && count($_POST["reservation-time-slots"]) > 0) {
          $_SESSION["reservation"]["reservation-time-slots"] = $reservation_time_slots = $_POST["reservation-time-slots"];
        } else {
          $second_step_machine_time_slots_error = "Selecteer één of meerdere tijdsloten voor uw reservatie";
        }
      } // End of second step

      if (
        empty($init_step_error) && empty($first_step_error)
        && empty($first_step_machine_date_error)
        && empty($second_step_machine_time_slots_error)
      ) {
        // update the current step value
        $_SESSION["reservation"]["reservation-step"] = $current_step = $next_step;
      }
    }
    else {
      // submit value is previous
      if ($reservation_type === "workshop" && $current_step === 3) {
        $_SESSION["reservation"]["reservation-step"] = $current_step = 1;
      } else if ($current_step > 0) {
        $current_step -= 1;
        $_SESSION["reservation"]["reservation-step"] = $current_step;
      }
    }
  }

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
    <ul class="progressbar">
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
      <pre>
        <?php echo "De huidige stap is: " . $current_step; ?>
      </pre>

      <?php if ($current_step === 0) { ?>
      <!-- Initial step -->
      <div class="input-group">
        <label for="reservation-type">Wat wilt u reserveren?</label>
        <select id="reservation-type" for="reservation-type" name="reservation-type" class="<?php echo (!empty($init_step_error)) ? "error" : "" ; ?>">
          <option value="" <?php echo ($reservation_type == "") ? "selected" : ""; ?>>-- Kiezen --</option>
          <option value="machine" <?php echo ($reservation_type == "machine") ? "selected" : ""; ?>>Toestel</option>
          <option value="workshop" <?php echo ($reservation_type == "workshop") ? "selected" : ""; ?>>Workshop</option>
        </select>
        <span class="error-message <?php echo ($init_step_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $init_step_error; ?></span>
      </div>
      <input type="hidden" name="step" value="1" />
      <input class="btn btn-blue btn-submit btn-next1" type="submit" name="submit" value="Volgende" />
      <!-- End of initial step -->
      <?php } ?>

      <?php if ($current_step === 1 && $reservation_type === "workshop") { ?>
      <!-- First step workshop -->
      <pre class="reservation-info">
        <span class="fw-b">Reservatie voor:</span>
        <?php echo $reservation_type; ?>
      </pre>
      <div class="input-group">
        <label for="reservation-item">Welke workshop wilt u reserveren?</label>
        <select id="reservation-item" name="reservation-item" class="<?php echo (!empty($first_step_error)) ? "error" : ""; ?>">
          <option value="" <?php echo ($reservation_item == "") ? "selected" : ""; ?>>-- Kiezen --</option>
          <?php
            $all_workshops = new WP_Query([
              "posts_per_page" => -1,
              "post_type" => "workshop"
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
        <span class="error-message <?php echo ($first_step_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $first_step_error; ?></span>
      </div>
      <input type="hidden" name="step" value="3" />
      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <input class="btn btn-dark btn-submit" name="submit" type="submit" value="Vorige" />
        </div>
        <div class="col-1-of-2">
          <input class="btn btn-blue btn-submit btn-next" name="submit" type="submit" value="Volgende" />
        </div>
      </div>
      <!-- End of first step workshop -->
      <?php } ?>

      <?php if ($current_step === 1 && $reservation_type === "machine") { ?>
      <!-- First step machine -->
      <pre class="reservation-info">
        <span class="fw-b">Reservatie voor:</span>
        <?php echo $reservation_type; ?>
      </pre>
      <div class="input-group">
        <label for="reservation-item">Welk toestel wilt u reserveren?</label>
        <select id="reservation-item" name="reservation-item" class="<?php echo (!empty($first_step_error)) ? "error" : ""; ?>">
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
        <span class="error-message <?php echo (!empty($first_step_error)) ? 'disp-b' : 'disp-n'; ?>">
          <?php echo $first_step_error; ?>
        </span>
      </div>
      <div class="input-group">
        <label for="reservation-date">Selecteer de datum waarop u het toestel wilt reserveren.</label>
        <input id="reservation-date" name="reservation-date" type="date" value="<?php echo $reservation_date; ?>" class="<?php echo (!empty($first_step_machine_date_error)) ? "error" : ""; ?>" />
        <span class="error-message <?php echo (!empty($first_step_machine_date_error)) ? "disp-b" : "disp-n"; ?>">
          <?php echo $first_step_machine_date_error; ?>
        </span>
      </div>
      <input type="hidden" name="step" value="2" />
      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <input class="btn btn-dark btn-submit btn-previous" name="submit" type="submit" value="Vorige" />
        </div>
        <div class="col-1-of-2">
          <input class="btn btn-blue btn-submit btn-next" name="submit" type="submit" value="Volgende" />
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

        // get amount of rows in grid
        $amount_of_columns = 5;
        $amount_of_rows = ceil($amount_of_timeslots / $amount_of_columns);
      ?>
      <h3><?php echo $date_str_repr; ?></h3>
      <div class="time-slots-container">
        <p>Selecteer één of meerdere tijdsloten waarop u het toestel wilt reserveren.</p>
        <?php
          $current_time = $start_hour_selected_day;

          for ($row = 0; $row < $amount_of_rows; $row++) {
            echo '<div class="disp-f">';
            for ($column = 0; $column < $amount_of_timeslots; $column++) {
              if ($column !== 0 && $column%$amount_of_columns === 0) {
                $amount_of_timeslots -= $amount_of_columns;
                break;
              }
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

            echo '</div>';
          }
        ?>
      </div>
      <span class="error-message message <?php echo (!empty($second_step_machine_time_slots_error)) ? "disp-b" : "disp-n"; ?>">
        <?php echo $second_step_machine_time_slots_error; ?>
      </span>
      <input type="hidden" name="step" value="3" />
      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <input class="btn btn-dark btn-submit btn-previous" name="submit" type="submit" value="Vorige" />
        </div>
        <div class="col-1-of-2">
          <input class="btn btn-blue btn-submit btn-next" name="submit" type="submit" value="Volgende" />
        </div>
      </div>
      <!-- End of second step machine -->
      <?php } ?>

      <?php if ($current_step === 3) { ?>
      <!-- Third step -->
      <pre class="reservation-info">
        <span class="fw-b">Reservatie voor:</span>
        <?php echo $reservation_item; ?>
      </pre>
      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <input class="btn btn-dark btn-submit btn-previous" name="submit" type="submit" value="Vorige" />
        </div>
        <div class="col-1-of-2">
          <input class="btn btn-blue btn-submit btn-next" name="submit" type="submit" value="Volgende" />
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
