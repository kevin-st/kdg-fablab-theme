<?php
  /* Template Name: Registratie template */
  get_header();
?>
<main>
  <h1><?php the_title(); ?></h1>
  <form class="disp-f" action="<?php the_permalink(); ?>" method="post">
    <!-- left column -->
    <div class="col-1-of-2 mr-lg">

      <div class="disp-f">

        <!-- left column -->
        <div class="col-1-of-2 mr-lg">

          <!-- surname field -->
          <div class="input-group">
            <label for="reg-surname">
              Voornaam:
              <span class="required">*</span>
            </label>
            <input class="<?php echo $name_has_error ? "error" : ""?>" type="text" placeholder="voornaam" id="reg-surname" name="reg-surname" value="<?php echo ""; ?>">
            <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
          </div>
          <!-- end of surname -->
        </div>
        <!-- end of left column -->

        <!-- right column -->
        <div class="col-1-of-2">

          <!-- lastname field -->
          <div class="input-group">
            <label for="reg-lastname">
              Achternaam:
              <span class="required">*</span>
            </label>
            <input class="<?php echo $name_has_error ? "error" : ""?>" type="text" placeholder="achternaam" id="reg-lastname" name="reg-lastname" value="<?php echo ""; ?>">
            <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
          </div>
          <!-- end of lastname -->
        </div>
        <!-- end of right column -->
      </div>

      <!-- who are you field -->
      <div class="input-group">
        <label for="reg-who-are-you">
          Wie ben je?
          <span class="required">*</span>
        </label>
        <select id="reg-who-are-you">
          <option value="">--Kiezen--</option>
          <option value="student">Student</option>
          <option value="company">Bedrijf</option>
          <!-- other values ? -->
        </select>
        <span class="error-message <?php echo $email_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $user_email_error; ?></span>
      </div>
      <!-- end of who are you field -->

      <!-- VAT field -->
      <div class="input-group">
        <label for="reg-VAT-num">
          BTW-nummer:
          <span class="required">*</span>
        </label>
        <input class="<?php echo $name_has_error ? "error" : ""?>" type="text" placeholder="BTW-nummer" id="reg-VAT-num" name="reg-VAT-num" value="<?php echo ""; ?>">
        <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
      </div>
      <!-- end of VAT field -->

      <!-- e-mail field -->
      <div class="input-group">
        <label for="reg-email">
          E-mailadres:
          <span class="required">*</span>
        </label>
        <input class="<?php echo $name_has_error ? "error" : ""?>" type="email" placeholder="voorbeeld@hotmail.com" id="reg-email" name="reg-email" value="<?php echo ""; ?>">
        <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
      </div>
      <!-- end of e-mail field-->

      <!-- tel. number field -->
      <div class="input-group" id="reg-tel">
        <label for="reg-tel-num">
          Telefoonnummer:
          <span class="required">*</span>
        </label>
        <input class="<?php echo $name_has_error ? "error" : ""?>" type="text" placeholder="telefoonnummer" id="reg-tel-num" name="reg-tel-num" value="<?php echo ""; ?>">
        <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
      </div>
      <!-- end of tel. number field -->
    </div>
    <!-- end of left column -->

    <!-- right column -->
    <div class="col-1-of-2 p-rel">
      <!-- address field -->
      <div class="input-group">
        <label for="reg-address">
          Adres - nummer:
          <span class="required">*</span>
        </label>
        <input class="<?php echo $name_has_error ? "error" : ""?>" type="text" placeholder="straatnaam en nummer" id="reg-address" name="reg-address" value="<?php echo ""; ?>">
        <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
      </div>
      <!-- end of address field -->

      <div class="disp-f">
        <!-- left column -->
        <div class="col-1-of-2 mr-lg">
          <!-- postal code field -->
          <div class="input-group">
            <label for="reg-postal-code">
              Postcode:
              <span class="required">*</span>
            </label>
            <input class="<?php echo $name_has_error ? "error" : ""?>" type="text" placeholder="postcode" id="reg-postal-code" name="reg-address" value="<?php echo ""; ?>">
            <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
          </div>
          <!-- end of postal code field -->
        </div>
        <!-- end of left column -->

        <!-- right column -->
        <div class="col-1-of-2">
          <!-- city field -->
          <div class="input-group">
            <label for="reg-city">
              Gemeente:
              <span class="required">*</span>
            </label>
            <input class="<?php echo $name_has_error ? "error" : ""?>" type="text" placeholder="gemeente" id="reg-city" name="reg-city" value="<?php echo ""; ?>">
            <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
          </div>
          <!-- end of city field -->
        </div>
        <!-- end of right column -->
      </div>

      <!-- password field -->
      <div class="input-group">
        <label for="reg-password">
          Wachtwoord:
          <span class="required">*</span>
        </label>
        <input class="<?php echo $name_has_error ? "error" : ""?>" type="password" placeholder="wachtwoord" id="reg-password" name="reg-password" value="<?php echo ""; ?>">
        <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
      </div>
      <!-- end of password field -->

      <!-- confirm password field -->
      <div class="input-group">
        <label for="reg-confirm-password">
          Wachtwoord bevestigen:
          <span class="required">*</span>
        </label>
        <input class="<?php echo $name_has_error ? "error" : ""?>" type="password" placeholder="wachtwoord bevestigen" id="reg-confirm-password" name="reg-confirm-password" value="<?php echo ""; ?>">
        <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
      </div>
      <!-- end of confirm password field -->

      <!-- submit button -->
      <input class="p-abs attach-to-bottom btn-submit" name="submit" type="submit" value="Registreren">
    </div>
    <!-- end of right column -->
  </form>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
