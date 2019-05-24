<?php
  /* Template Name: Profiel bewerken template */

  // when not logged in, don't show the content of this page
  if (!is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
  }

  kdg_fablab_reset_reservation_process();

  $user = wp_get_current_user();
  $user_meta = get_user_meta($user->ID);

  $first_name_error = $last_name_error = $email_error = $tel_number_error = $address_error = $postal_code_error = $city_error = $VAT_number_error = $company_name_error = /*$who_are_you_error =*/ "";

  if (isset($_POST['submit'])) {

    if (isset($_POST["first_name"])) {
      if ($_POST["first_name"] !== "") {
        if ($user_meta["first_name"][0] !== $_POST["first_name"]) {
          update_user_meta($user->ID, "first_name", sanitize_text_field($_POST["first_name"]));
        }
      } else {
        $first_name_error = "Je moet een voornaam invullen";
      }
    }

    if (isset($_POST["last_name"])) {
      if ($_POST["last_name"] !== "") {
        if ($user_meta["last_name"][0] !== $_POST["last_name"]) {
          update_user_meta($user->ID, "last_name", sanitize_text_field($_POST["last_name"]));
        }
      } else {
        $last_name_error = "Je moet een achternaam invullen";
      }
    }

    if (isset($_POST["email"])) {
      if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_error = "Je moet een geldig e-mailadres invullen";
      } else if ($_POST["email"] === "") {
        $email_error = "Je moet een e-mailadres invullen";
      } else {
        if ($user->user_email !== $_POST["email"]) {
          wp_update_user([
            "ID" => $user->ID,
            "user_email" => $_POST["email"]
          ]);
        }
      }
    }

    if (isset($_POST["tel_number"])) {
      if (!preg_match("/^\+[0-9]{11}$/", $_POST["tel_number"])) {
        $tel_number_error = "Het telefoonnummer bevat spaties of is niet in het juiste formaat geschreven. Gebruik het internationale formaat.";
      } else if ($_POST["tel_number"] === "") {
        $tel_number_error = "Je moet een telefoonnummer invullen";
      } else {
        if ($user_meta["tel_number"][0] !== $_POST["tel_number"]) {
          update_user_meta($user->ID, "tel_number", sanitize_text_field($_POST["tel_number"]));
        }
      }
    }

    if (isset($_POST["address"])) {
      if ($_POST["address"] !== "") {
        if ($user_meta["address"][0] !== $_POST["address"]) {
          update_user_meta($user->ID, "address", sanitize_text_field($_POST["address"]));
        }
      } else {
        $address_error = "Je moet een adres opgeven";
      }
    }

    if (isset($_POST["postal_code"])) {
      if ($_POST["postal_code"] !== "") {
        if (preg_match("/^[0-9]{4}$/", $_POST["postal_code"])) {
          if ($user_meta["postal_code"][0] !== $_POST["postal_code"]) {
            update_user_meta($user->ID, "postal_code", sanitize_text_field($_POST["postal_code"]));
          }
        } else {
          $postal_code_error = "Een postcode bevat 4 cijfers";
        }
      } else {
        $postal_code_error = "Je moet een postcode ingeven";
      }
    }

    if (isset($_POST["city"])) {
      if ($_POST["city"] !== "") {
        if ($user_meta["city"][0] !== $_POST["city"]) {
          update_user_meta($user->ID, "city", sanitize_text_field($_POST["city"]));
        }
      } else {
        $city_error = "Je moet een gemeente opgeven";
      }
    }

    if (isset($_POST["company_name"])) {
      if ($_POST["company_name"] !== "") {
        if ($user_meta["company_name"][0] !== $_POST["company_name"]) {
          update_user_meta($user->ID, "company_name", sanitize_text_field($_POST["company_name"]));
        }
      } else {
        $company_name_error = "Je moet de naam van het bedrijf opgeven";
      }
    }

    if (isset($_POST["VAT_number"])) {
      if ($_POST["VAT_number"] !== "") {
        if (preg_match("/^[0-9]{4}\.[0-9]{3}\.[0-9]{3}$/", $_POST["VAT_number"])) {
          if ($user_meta["VAT_number"][0] !== $_POST["VAT_number"]) {
            update_user_meta($user->ID, "VAT_number", sanitize_text_field($_POST["VAT_number"]));
          }
        } else {
          $VAT_number_error = "Een BTW-nummer bestaat uit 10 cijfers gescheiden door een punt en geschreven in het volgende formaat: xxxx.xxx.xxx";
        }
      } else {
        $VAT_number_error = "Je moet een BTW-nummer opgeven.";
      }
    }

    /*if (isset($_POST["who_are_you"])) {
      if ($_POST["who_are_you"] !== "") {
        if ($user_meta["who_are_you"][0] !== $_POST["who_are_you"]) {
          update_user_meta($user->ID, "who_are_you", sanitize_text_field($_POST["who_are_you"]));
        }
      } else {
        $who_are_you_error = "Vertel me wie je bent";
      }
    }*/

    if (
      $first_name_error == "" && $last_name_error == "" && $email_error == ""
      && $tel_number_error == "" && $address_error == "" && $postal_code_error == ""
      && $city_error == "" && $VAT_number_error == "" && $company_name_error == ""//&& $who_are_you_error == ""
    ) {
      // set user to initialized
      update_user_meta($user->ID, "is_initialized", 1);

      // set session value
      $_SESSION['sent'] = TRUE;
      $_SESSION['msg-type'] = "success";
      $_SESSION['msg'] = "Je profiel werd succesvol gëupdatet!";

      // redirect to profile page
      wp_redirect(site_url('/mijn-profiel'));
      exit();
    } else {
      $user_meta = get_user_meta($user->ID);
    }
  }

  get_header();

  $first_name = isset($user_meta['first_name'][0]) ? $user_meta['first_name'][0] : "";
  $last_name = isset($user_meta['last_name'][0]) ? $user_meta['last_name'][0] : "";

  $email = $user->user_email;
  $tel_number = isset($user_meta['tel_number'][0]) ? $user_meta['tel_number'][0] : "";

  $address = isset($user_meta['address'][0]) ? $user_meta['address'][0] : "";
  $postal_code = isset($user_meta['postal_code'][0]) ? $user_meta['postal_code'][0] : "";
  $city = isset($user_meta['city'][0]) ? $user_meta['city'][0] : "";

  $company_name = isset($user_meta["company_name"][0]) ? $user_meta["company_name"][0] : "";
  $VAT_number = isset($user_meta['VAT_number'][0]) ? $user_meta['VAT_number'][0] : "";
  $who_are_you = isset($user_meta['who_are_you'][0]) ? $user_meta['who_are_you'][0] : "";
?>
<main id="profielMain">
  <div id="user-info">
    <div class="disp-f">
      <a id="pijllink" href="<?php echo site_url("/mijn-profiel"); ?>"><img id="pijl" src="<?php echo get_theme_file_uri("img/pijl.png");?>" alt="teruggaan"></a>
      <h1><?php the_title(); ?></h1>
    </div>

    <?php echo do_shortcode( '[plugin_delete_me /]' ); ?>
    <form id="profile-meta-data" action="<?php the_permalink(); ?>" method="post">

      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <div class="input-group mr-med input-class">
            <label>Voornaam:</label>
            <input class="<?php echo ($first_name_error !== "") ? "error" : ""; ?>" type="text" name="first_name" value="<?php echo $first_name; ?>" />
            <span class="error-message <?php echo ($first_name_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $first_name_error; ?></span>
          </div>
        </div>
        <div class="col-1-of-2">
          <div class="input-group input-class">
            <label class="extra">Achternaam:</label>
            <input class="<?php echo ($last_name_error !== "") ? "error" : ""; ?>" type="text" name="last_name" value="<?php echo $last_name; ?>" />
            <span class="error-message <?php echo ($last_name_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $last_name_error; ?></span>
          </div>
        </div>
      </div>

      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <div class="input-group mr-med input-class">
            <label>E-mailadres:</label>
            <input class="<?php echo ($email_error !== "") ? "error" : ""; ?>" type="text" name="email" value="<?php echo $email; ?>"/>
            <span class="error-message <?php echo ($email_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $email_error; ?></span>
          </div>
        </div>
        <div class="col-1-of-2">
          <div class="input-group input-class">
            <label>Telefoonnummer:</label>
            <input class="<?php echo ($tel_number_error !== "") ? "error" : ""; ?>" type="text" name="tel_number" value="<?php echo $tel_number; ?>"/>
            <span class="error-message <?php echo ($tel_number_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $tel_number_error; ?></span>
          </div>
        </div>
      </div>

      <div class="input-group input-class">
        <label>Adres:</label>
        <input class="<?php echo ($address_error !== "") ? "error" : ""; ?>" id="adres" type="text" name="address" value="<?php echo $address; ?>"/>
        <span class="error-message <?php echo ($address_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $address_error; ?></span>
      </div>

      <div class="disp-f col-2-of-2">
        <div class="col-1-of-2">
          <div class="input-group mr-med input-class">
            <label>Postcode:</label>
            <input class="<?php echo ($postal_code_error !== "") ? "error" : ""; ?>" type="text" name="postal_code" value="<?php echo $postal_code; ?>"/>
            <span class="error-message <?php echo ($postal_code_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $postal_code_error; ?></span>
          </div>
        </div>
        <div class="col-1-of-2">
          <div class="input-group input-class">
            <label>Gemeente:</label>
            <input class="<?php echo ($city_error !== "") ? "error" : ""; ?>" type="text" name="city" value="<?php echo $city; ?>"/>
            <span class="error-message <?php echo ($city_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $city_error; ?></span>
          </div>
        </div>
      </div>

      <?php if ($who_are_you === "bedrijf") { ?>
        <div class="input-group input-class">
          <label>Naam bedrijf:</label>
          <input class="<?php echo ($company_name_error !== "") ? "error" : ""; ?>" type="text" name="company_name" value="<?php echo $company_name; ?>"/>
          <span class="error-message <?php echo ($company_name_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $company_name_error; ?></span>
        </div>
        <div class="input-group input-class">
          <label>BTW-nummer:</label>
          <input class="<?php echo ($VAT_number_error !== "") ? "error" : ""; ?>" type="text" name="VAT_number" value="<?php echo $VAT_number; ?>"/>
          <span class="error-message <?php echo ($VAT_number_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php echo $VAT_number_error; ?></span>
        </div>
      <?php } ?>

      <!-- <div class="input-group">
        <label>Wie ben je?</label>
        <select class="<?php // echo ($who_are_you_error !== "") ? "error" : ""; ?>" name="who_are_you">
          <option value="" <?php // if ($who_are_you == "") echo "selected"; ?>> Kiezen </option>
          <option value="student" <?php // if ($who_are_you == "student") echo "selected"; ?>>Student</option>
          <option value="bedrijf" <?php // if ($who_are_you == "bedrijf") echo "selected"; ?>>Bedrijf</option>
          <option value="particulier" <?php // if ($who_are_you == "particulier") echo "selected"; ?>>Particulier</option>
        </select>
        <span class="error-message <?php // echo ($who_are_you_error !== "") ? 'disp-b' : 'disp-n'; ?>"><?php // echo $who_are_you_error; ?></span>
      </div>
      -->
      <div class="disp-f" id="editBtn">
        <input class="btn btn-submit editBtn btn-blue" type="submit" name="submit" value="Aanpassingen opslaan" />
      </div>

    </form>
  </div>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
