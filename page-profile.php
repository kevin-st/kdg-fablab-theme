<?php
  /* Template Name: Profiel template */

  // when not logged in, don't show the content of this page
  if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
  }

  get_header();

  $user = wp_get_current_user();
  $user_meta = get_user_meta($user->ID);

  $first_name = isset($user_meta['first_name'][0]) ? $user_meta['first_name'][0] : "";
  $last_name = isset($user_meta['last_name'][0]) ? $user_meta['last_name'][0] : "";
  $tel_number = isset($user_meta['tel_number'][0]) ? $user_meta['tel_number'][0] : "";
  $address = isset($user_meta['address'][0]) ? $user_meta['address'][0] : "";
  $company_name = isset($user_meta["company_name"][0]) ? $user_meta["company_name"][0] : "";
  $postal_code = isset($user_meta['postal_code'][0]) ? $user_meta['postal_code'][0] : "";
  $city = isset($user_meta['city'][0]) ? $user_meta['city'][0] : "";
  $VAT_number = isset($user_meta['VAT_number'][0]) ? $user_meta['VAT_number'][0] : "";
  $who_are_you = isset($user_meta['who_are_you'][0]) ? $user_meta['who_are_you'][0] : "";
?>
<main id="profielMain">
    <?php
      wp_nav_menu([
        "theme_location" => "profile_navigation"
      ]);
    ?>
    <div class="content-profile">
      <?php
        while(have_posts()) {
          the_post();
        ?>
        <h1><?php the_title(); ?></h1>
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

      <div id="user-info">
        <section>
          <h3>Persoonlijke gegevens</h3>
          <div>
            <p>
              <span class="profile-value-label">Gebruikersnaam:</span>
              <span class="profile-value"><?php echo $user->user_nicename; ?></span>
            </p>
          </div>
          <div class="disp-f col-2-of-2">
            <div class="col-1-of-2">
              <p>
                <span class="profile-value-label">Voornaam:</span>
                <span class="profile-value"><?php echo $first_name; ?></span>
              </p>
            </div>
            <div class="col-1-of-2">
              <p>
                <span class="profile-value-label">Achternaam:</span>
                <span class="profile-value"><?php echo $last_name; ?></span>
              </p>
            </div>
          </div>

          <div class="disp-f col-2-of-2">
            <div class="col-1-of-2">
              <div>
                <p>
                  <span class="profile-value-label">E-mailadres:</span>
                  <span class="profile-value"><?php echo $user->user_email; ?></span>
                </p>
              </div>
            </div>
            <div class="col-1-of-2">
              <div>
                <p>
                  <span class="profile-value-label">Telefoonnummer:</span>
                  <span class="profile-value"><?php echo $tel_number; ?></span>
                </p>
              </div>
            </div>
          </div>
        </section>

        <section>
          <h3>Contactgegevens</h3>

          <div class="disp-f col-2-of-2">
            <div class="col-1-of-2">
              <p>
                <span class="profile-value-label">Adres:</span>
                <span class="profile-value"><?php echo $address; ?></span>
              </p>
            </div>
            <?php if ($who_are_you === "bedrijf") { ?>
            <div class="col-1-of-2">
              <p>
                <span class="profile-value-label">Naam bedrijf:</span>
                <span class="profile-value"><?php echo $company_name; ?></span>
              </p>
            </div>
            <?php } ?>
          </div>

          <div class="disp-f col-2-of-2">
            <div class="col-1-of-2">
              <p>
                <span class="profile-value-label">Postcode:</span>
                <span class="profile-value"><?php echo $postal_code; ?></span>
              </p>
            </div>
            <div class="col-1-of-2">
              <p>
                <span class="profile-value-label">Gemeente:</span>
                <span class="profile-value"><?php echo $city; ?></span>
              </p>
            </div>
          </div>
        </section>

        <section>
          <h3>Extra info</h3>
          <div class="disp-f col-2-of-2">
            <div class="col-1-of-2">
              <p>
                <span class="profile-value-label">Wie je bent:</span>
                <span class="profile-value"><?php echo $who_are_you; ?></span>
              </p>
            </div>
            <?php if ($who_are_you === "bedrijf") { ?>
            <div class="col-1-of-2">
              <p>
                <span class="profile-value-label">BTW-nummer:</span>
                <span class="profile-value"><?php echo $VAT_number; ?></span>
              </p>
            </div>
            <?php } ?>
          </div>
        </section>
      </div>
    </div>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
