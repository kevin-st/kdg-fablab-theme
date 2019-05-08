<?php /* Template Name: Reserveren Template */ ?>
<?php
  $current_step = isset($_SESSION["reservation"]["reservation-step"]) ? intval($_SESSION["reservation"]["reservation-step"]) : 0;
  $reservation_type = isset($_SESSION["reservation"]["reservation-type"]) ? $_SESSION["reservation"]["reservation-type"] : NULL;
  $reservation_item = isset($_SESSION["reservation"]["reservation-item"]) ? $_SESSION["reservation"]["reservation-item"] : NULL;

  // check if a certain step has errors
  $init_step_error = $first_step_ws_error = "";

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
        if ($reservation_type === "workshop") {
          if (!empty($_POST["reservation-item"])) {
            $_SESSION["reservation"]["reservation-item"] = $reservation_item = $_POST["reservation-item"];
          } else {
            $first_step_ws_error = "Kies een workshop";
          }
        }
      } // End of first step

      if (empty($init_step_error) && empty($first_step_ws_error)) {
        // update the current step value
        $_SESSION["reservation"]["reservation-step"] = $current_step = $next_step;
      }
    }
    else {
      // submit value is previous
      if ($reservation_type === "workshop" && $current_step === 3) {
        $_SESSION["reservation"]["reservation-step"] = $current_step = 1;
      } else {
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
  <div class="page-reserveren-content">
    <form id="reservation-form" action="<?php the_permalink(); ?>" method="post">

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
        <input class="btn btn-blue btn-submit" type="submit" name="submit" value="Volgende" />
        <!-- End of initial step -->
      <?php } ?>


      <?php echo "De huidige stap is: " . $current_step; ?>
      <?php if ($current_step === 1 && $reservation_type === "workshop") { ?>
      <!-- First step workshop -->
      <div class="reservation-info">
        <p>
          <span class="fw-b">Reservatie voor:</span>
          <?php echo $reservation_type; ?>
        </p>
      </div>
      <div class="input-group">
        <label for="reservation-item">Welke workshop wilt u reserveren?</label>
        <select id="reservation-item" name="reservation-item" class="<?php echo (!empty($first_step_ws_error)) ? "error" : ""; ?>">
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
        <span class="error-message <?php echo ($first_step_ws_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $first_step_ws_error; ?></span>
      </div>
      <input type="hidden" name="step" value="3" />
      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <input class="btn btn-dark btn-submit" name="submit" type="submit" value="Vorige" />
        </div>
        <div class="col-1-of-2">
          <input class="btn btn-blue btn-submit" name="submit" type="submit" value="Volgende" />
        </div>
      </div>

      <!-- End of first step workshop -->
      <?php } ?>


      <!-- Third step workshop -->
      <?php if ($current_step === 3 && $reservation_type === "workshop") { ?>
        <div class="reservation-info">
          <p>
            <span class="fw-b">Reservatie voor:</span>
            <?php echo $reservation_type; ?>
          </p>
          <p>
            <span class="fw-b">Workshop:</span>
            <?php echo $reservation_item; ?>
          </p>
        </div>
        <div class="disp-f col-2-of-2">
          <div class="col-1-of-2">
            <input class="btn btn-dark btn-submit" name="submit" type="submit" value="Vorige" />
          </div>
          <div class="col-1-of-2">
            <input class="btn btn-blue btn-submit" name="submit" type="submit" value="Volgende" />
          </div>
      <?php } ?>
      <!-- End of Third step workshop -->

    </form>
  </div>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
