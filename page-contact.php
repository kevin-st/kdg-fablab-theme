<?php get_header(); ?>
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
?>
<main id="contactMain">

    <h1>Contacteer ons</h1>

    <div class="contactGegevens">

        <div class="profile-picture">
          <img src="<?php echo get_theme_file_uri("img/lorenz.png"); ?>">
        </div>

        <div class="contactForm">
            <form id="contact-form" action="<?php the_permalink(); ?>" method="post">
                <div class="input-group">
                  <label for="name">
                    Naam:
                    <span class="required">*</span>
                  </label>
                  <input type="text" placeholder="John Doe" id="name" name="name">
                  <span class="error-message disp-n">Vul je naam in.</span>
                </div>

                <div class="input-group">
                  <label for="email">
                    E-mailadres:
                    <span class="required">*</span>
                  </label>
                  <input type="text" placeholder="voorbeeld@hotmail.com" id="email" name="email">
                  <span class="error-message disp-n">Vul je email in.</span>
                </div>

                <div class="input-group">
                  <label for="question">
                    Vraag:
                    <span class="required">*</span>
                  </label>
                  <textarea type="text" placeholder="Waar kan ik je mee helpen?" id="question" name="question"></textarea>
                  <span class="error-message disp-n">Sorry, maar dit begrijp ik niet.</span>
                </div>

                <input class="btn-submit" type="submit" value="Versturen">
            </form>
        </div>

    </div>

    <div style="width: 960px;position: relative;">
      <iframe width="960" height="440" src="https://maps.google.com/maps?width=960&amp;height=440&amp;hl=en&amp;q=Salesianenlaan%2090+(KdG%20Hoboken%20FabLab)&amp;ie=UTF8&amp;t=&amp;z=12&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
    </div>

</main>

<?php
  get_footer();

  // do not close php tags at the end of a file
