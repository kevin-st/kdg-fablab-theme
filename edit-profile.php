<?php
  /* Template Name: Profiel bewerken template */

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
  $postal_code = isset($user_meta['postal_code'][0]) ? $user_meta['postal_code'][0] : "";
  $city = isset($user_meta['city'][0]) ? $user_meta['city'][0] : "";
  $VAT_number = isset($user_meta['VAT_number'][0]) ? $user_meta['VAT_number'][0] : "";
  $who_are_you = isset($user_meta['who_are_you'][0]) ? $user_meta['who_are_you'][0] : "";
?>
<main>
  <div class="disp-f">
    <?php get_sidebar("profile"); ?>
    <form id="profile-meta-data" action="<?php the_permalink(); ?>" method="post">
      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <div class="input-group">
            <label>Voornaam:</label>
            <input type="text" value="<?php echo $first_name; ?>" />
          </div>
        </div>
        <div class="col-1-of-2">
          <div class="input-group">
            <label>Achternaam:</label>
            <input type="text" value="<?php echo $last_name; ?>" />
          </div>
        </div>
      </div>
      <div class="input-group">
        <label>Telefoonnummer:</label>
        <input type="text" value="<?php echo $tel_number; ?>"/>
      </div>
      <div class="input-group">
        <label>Adres:</label>
        <input type="text" value="<?php echo $address; ?>"/>
      </div>
      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <div class="input-group">
            <label>Postcode:</label>
            <input type="text" value="<?php echo $postal_code; ?>"/>
          </div>
        </div>
        <div class="col-1-of-2">
          <div class="input-group">
            <label>Gemeente:</label>
            <input type="text" value="<?php echo $city; ?>"/>
          </div>
        </div>
      </div>
      <?php if ($who_are_you === "bedrijf") { ?>
        <div class="input-group">
          <label>BTW-nummer:</label>
          <input type="text" value="<?php echo $VAT_number; ?>"/>
        </div>
      <?php } ?>
      <div class="input-group">
        <label>Wie ben je?</label>
        <select>
          <option value="" <?php if ($who_are_you == "") echo "selected"; ?>>-- Kiezen --</option>
          <option value="student" <?php if ($who_are_you == "student") echo "selected"; ?>>Student</option>
          <option value="bedrijf" <?php if ($who_are_you == "bedrijf") echo "selected"; ?>>Bedrijf</option>
          <option value="particulier" <?php if ($who_are_you == "particulier") echo "selected"; ?>>Particulier</option>
        </select>
      </div>
      <input class="btn btn-submit" name="submit" value="Profiel bijwerken" />
    </form>
  </div>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
