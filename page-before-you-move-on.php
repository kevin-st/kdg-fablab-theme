<?php
  /* Template Name: Registratieformulier template */

  $is_user_initialized = get_user_meta(get_current_user_id(), "is_initialized", true);

  if (!is_user_logged_in() || $is_user_initialized) {
    wp_redirect(home_url());
    exit;
  }


?>
<main>
  <form>
    <p>
      <label>Adres</label>
      <input type="text" value="" />
    </p>
    <p>
      <label>Postcode</label>
      <input type="text" value="" />
    </p>
    <p>
      <label>Gemeente</label>
      <input type="text" value="" />
    </p>
    <p>
      <label>Telefoonnummer</label>
      <input type="text" value="" />
    </p>
    <?php if (metadata_exists("user", get_current_user_id(), "VAT_number")) { ?>
    <p>
      <label>BTW-nummer</label>
      <input type="text" value="" />
    </p>
    <?php } ?>
    <input type="submit" value="verzenden" />
  </form>
</main>
