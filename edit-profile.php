<?php
  /* Template Name: Profiel bewerken template */

  // when not logged in, don't show the content of this page
  if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
  }

  $user = wp_get_current_user();
  $user_meta = get_user_meta($user->ID);

  if (isset($_POST['submit'])) {

    if (isset($_POST["first_name"])) {
      if ($user_meta["first_name"][0] !== $_POST["first_name"]) {
        update_user_meta($user->ID, "first_name", sanitize_text_field($_POST["first_name"]));
      }
    }

    if (isset($_POST["last_name"])) {
      if ($user_meta["last_name"][0] !== $_POST["last_name"]) {
        update_user_meta($user->ID, "last_name", sanitize_text_field($_POST["last_name"]));
      }
    }

    if (isset($_POST["email"])) {
      if ($user->user_email !== $_POST["email"]) {
        wp_update_user([
          "ID" => $user->ID,
          "user_email" => $_POST["email"]
        ]);
      }
    }

    if (isset($_POST["tel_number"])) {
      if ($user_meta["tel_number"][0] !== $_POST["tel_number"]) {
        update_user_meta($user->ID, "tel_number", sanitize_text_field($_POST["tel_number"]));
      }
    }

    if (isset($_POST["address"])) {
      if ($user_meta["address"][0] !== $_POST["address"]) {
        update_user_meta($user->ID, "address", sanitize_text_field($_POST["address"]));
      }
    }

    if (isset($_POST["postal_code"])) {
      if ($user_meta["postal_code"][0] !== $_POST["postal_code"]) {
        update_user_meta($user->ID, "postal_code", sanitize_text_field($_POST["postal_code"]));
      }
    }

    if (isset($_POST["city"])) {
      if ($user_meta["city"][0] !== $_POST["city"]) {
        update_user_meta($user->ID, "city", sanitize_text_field($_POST["city"]));
      }
    }

    if (isset($_POST["VAT_number"])) {
      if ($user_meta["VAT_number"][0] !== $_POST["VAT_number"]) {
        update_user_meta($user->ID, "VAT_number", sanitize_text_field($_POST["VAT_number"]));
      }
    }

    if (isset($_POST["who_are_you"])) {
      if ($user_meta["who_are_you"][0] !== $_POST["who_are_you"]) {
        update_user_meta($user->ID, "who_are_you", sanitize_text_field($_POST["who_are_you"]));
      }
    }

     wp_redirect(site_url('/mijn-profiel'));
     exit();
  }

  get_header();

  $first_name = isset($user_meta['first_name'][0]) ? $user_meta['first_name'][0] : "";
  $last_name = isset($user_meta['last_name'][0]) ? $user_meta['last_name'][0] : "";

  $email = $user->user_email;
  $tel_number = isset($user_meta['tel_number'][0]) ? $user_meta['tel_number'][0] : "";

  $address = isset($user_meta['address'][0]) ? $user_meta['address'][0] : "";
  $postal_code = isset($user_meta['postal_code'][0]) ? $user_meta['postal_code'][0] : "";
  $city = isset($user_meta['city'][0]) ? $user_meta['city'][0] : "";

  $VAT_number = isset($user_meta['VAT_number'][0]) ? $user_meta['VAT_number'][0] : "";
  $who_are_you = isset($user_meta['who_are_you'][0]) ? $user_meta['who_are_you'][0] : "";
?>
<main>
  <?php get_sidebar("profile"); ?>
  <h1><?php the_title(); ?></h1>
  <form id="profile-meta-data" action="<?php the_permalink(); ?>" method="post">
    <div class="disp-f col-2-of-2">
      <div class="col-1-of-2">
        <div class="input-group">
          <label>Voornaam:</label>
          <input type="text" name="first_name" value="<?php echo $first_name; ?>" />
        </div>
      </div>
      <div class="col-1-of-2">
        <div class="input-group">
          <label>Achternaam:</label>
          <input type="text" name="last_name" value="<?php echo $last_name; ?>" />
        </div>
      </div>
    </div>
    <div class="disp-f col-2-of-2">
      <div class="col-1-of-2">
        <div class="input-group">
          <label>E-mailadres:</label>
          <input type="text" name="email" value="<?php echo $email; ?>"/>
        </div>
      </div>
      <div class="col-1-of-2">
        <div class="input-group">
          <label>Telefoonnummer:</label>
          <input type="text" name="tel_number" value="<?php echo $tel_number; ?>"/>
        </div>
      </div>
    </div>
    <div class="input-group">
      <label>Adres:</label>
      <input type="text" name="address" value="<?php echo $address; ?>"/>
    </div>
    <div class="disp-f col-2-of-2">
      <div class="col-1-of-2">
        <div class="input-group">
          <label>Postcode:</label>
          <input type="text" name="postal_code" value="<?php echo $postal_code; ?>"/>
        </div>
      </div>
      <div class="col-1-of-2">
        <div class="input-group">
          <label>Gemeente:</label>
          <input type="text" name="city" value="<?php echo $city; ?>"/>
        </div>
      </div>
    </div>
    <?php if ($who_are_you === "bedrijf") { ?>
      <div class="input-group">
        <label>BTW-nummer:</label>
        <input type="text" name="VAT_number" value="<?php echo $VAT_number; ?>"/>
      </div>
    <?php } ?>
    <div class="input-group">
      <label>Wie ben je?</label>
      <select name="who_are_you">
        <option value="" <?php if ($who_are_you == "") echo "selected"; ?>>-- Kiezen --</option>
        <option value="student" <?php if ($who_are_you == "student") echo "selected"; ?>>Student</option>
        <option value="bedrijf" <?php if ($who_are_you == "bedrijf") echo "selected"; ?>>Bedrijf</option>
        <option value="particulier" <?php if ($who_are_you == "particulier") echo "selected"; ?>>Particulier</option>
      </select>
    </div>
    <input class="btn btn-submit" type="submit" name="submit" value="Profiel bijwerken" />
  </form>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
