<?php
  /* Template Name: Reserveren Template */
  $current_step = "0";
  $reservation_type = isset($_SESSION["reservation"]["reservation-type"]) ? $_SESSION["reservation"]["reservation-type"] : NULL;

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
      $next_step = isset($_POST["step"]) ? $_POST["step"] : NULL;

      // Initial step
      if ($current_step === "0") {
        if (isset($_POST["reservation-type"])) {
          $_SESSION["reservation"]["reservation-type"] = $_POST["reservation-type"];
          $reservation_type = $_SESSION["reservation"]["reservation-type"];
          $current_step = $next_step;
        }
      }
      // End of initial step

    }
    else {

    }

  }

  get_header();
?>
<main>
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

      <?php if ($current_step === "0") { ?>
        <!-- Initial step -->
        <div class="input-group">
          <label for="reservation-type">Wat wilt u reserveren?</label>
          <select for="reservation-type" name="reservation-type">
            <option value="">-- Kiezen --</option>
            <option value="machine">Toestel</option>
            <option value="workshop">Workshop</option>
          </select>
        </div>
        <input type="hidden" name="step" value="1" />
        <input class="btn btn-submit" type="submit" name="submit" value="Volgende" />
        <!-- End of initial step -->
      <?php } ?>


      <?php echo "current step is: " . $current_step; ?>
      <?php if ($current_step === "1" && $reservation_type === "workshop") { ?>
      <div class="reservation-info">
        <p>
          <span class="fw-b">Reservatie voor:</span>
          <?php echo $reservation_type; ?>
        </p>
      </div>
      <!-- First step workshop -->
      <div class="input-group">
        <label for="reservation-item">Welke workshop wilt u reserveren?</label>
        <select for="reservation-item">

        </select>
      </div>
      <!-- End of first step workshop -->
      <?php } ?>


    </form>
  </div>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
