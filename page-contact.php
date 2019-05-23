<?php
  /* Template Name: Contact template */
  kdg_fablab_reset_reservation_process();
  
  get_header();
?>
<?php
  /*
    REMOVE THIS COMMENT

    content for generic page goes here (layout can be used accross multiple pages):
    -> e.g.
      - About us
      - Biography of an author
      - ...

    creating a custom page:
    -> https://developer.wordpress.org/themes/template-files-section/page-template-files/#creating-custom-page-templates-for-global-use
   */
   // user variables
   $user_name = isset($_POST['contact-user-name']) ? esc_attr($_POST['contact-user-name']) : "";
   $user_email = isset($_POST['contact-user-email']) ? esc_attr($_POST['contact-user-email']) : "";
   $user_question = isset($_POST['contact-user-question']) ? esc_attr($_POST['contact-user-question']) : "";

   // mail variables
   $to = get_option("admin_email");
   $subject = "Iemand diende een vraag in op " . get_bloginfo("name");
   $headers = "From: " . $user_email . "\r\nReplay-To: " . $user_email . "\r\n";

   // error variables
   $name_has_error = $email_has_error = $question_has_error = false;

   $username_error = "Vul je naam in.";
   $user_email_error = "Vul je email in.";
   $user_question_error = "Sorry, maar dit begrijp ik niet.";

   if (isset($_POST['submit'])) {
     if (empty($user_name)) {
       $name_has_error = true;
     } else if (preg_match('/[^A-Za-z\s]+/', $user_name)) {
       $name_has_error = true;
       $username_error = "Een naam kan geen cijfers en/of speciale tekens bevatten.";
     }

     if (empty($user_email)) {
       $email_has_error = true;
     } else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
       $email_has_error = true;
       $user_email_error = "De email die je opgaf is niet geldig.";
     }

     if (empty($user_question)) {
       $question_has_error = true;
       $user_question_error = "Gelieve je vraag duidelijk te omschrijven.";
     }

     if (!$name_has_error && !$email_has_error && !$question_has_error) {
       // append user credentials to email
       $user_question .= "\r\n\r\nIngediend op " . date("d-m-Y H:i:s") . " door " . $user_name;

       // send email
       $sent = wp_mail($to, $subject, strip_tags($user_question), $headers);
       $_SESSION['sent'] = TRUE;

       if ($sent) {
         $_SESSION['msg-type'] = "success";
         $_SESSION['msg'] = "Je vraag is succesvol ingediend. We nemen binnenkort contact met je op.";

         // unset post data
         $_POST = [];
         $user_name = $user_email = $user_question = "";
       } else {
         $_SESSION['msg-type'] = "error";
         $_SESSION['msg'] = "Er ging iets mis tijdens het verzenden. Probeer het later nog een keer.";
       }

       //header("Location: $_SERVER[PHP_SELF]");
     }
   }
?>
<main id="contactMain">

    <h1>Contacteer ons</h1>

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

    <div class="contactGegevens">

        <div class="profile-picture">
          <img class="valencia" src="<?php echo get_theme_file_uri("img/lorenz.png"); ?>">
        </div>

        <div class="contactForm">
            <form id="contact-form" action="<?php the_permalink(); ?>" method="post">
                <div class="input-group">
                  <label for="contact-user-name">
                    Naam:
                    <span class="required">*</span>
                  </label>
                  <input class="<?php echo $name_has_error ? "error" : ""?>" type="text" placeholder="John Doe" id="contact-user-name" name="contact-user-name" value="<?php echo $user_name; ?>">
                  <span class="error-message <?php echo $name_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $username_error; ?></span>
                </div>

                <div class="input-group">
                  <label for="contact-user-email">
                    E-mailadres:
                    <span class="required">*</span>
                  </label>
                  <input class="<?php echo $email_has_error ? "error" : ""?>" type="text" placeholder="voorbeeld@hotmail.com" id="contact-user-email" name="contact-user-email" value="<?php echo $user_email; ?>">
                  <span class="error-message <?php echo $email_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $user_email_error; ?></span>
                </div>

                <div class="input-group extraMargin">
                  <label for="contact-user-question">
                    Vraag:
                    <span class="required">*</span>
                  </label>
                  <textarea class="<?php echo $question_has_error ? "error" : ""?>" type="text" placeholder="Waar kan ik je mee helpen?" id="contact-user-question" name="contact-user-question"><?php echo $user_question; ?></textarea>
                  <span class="error-message <?php echo $question_has_error ? 'disp-b' : 'disp-n'; ?>"><?php echo $user_question_error; ?></span>
                </div>

                <input class="btn-submit p-abs attach-to-bottom btn-blue" name="submit" type="submit" value="Versturen">
            </form>
        </div>

    </div>

    <div class="map">
      <iframe src="https://maps.google.com/maps?width=960&amp;height=440&amp;hl=en&amp;q=Salesianenlaan%2090+(KdG%20Hoboken%20FabLab)&amp;ie=UTF8&amp;t=&amp;z=12&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
    </div>

</main>

<?php
  get_footer();

  // do not close php tags at the end of a file
