<?php
  /* Template Name: Profiel template */
  get_header();
?>
<main id="profielMain">
  <div class="disp-f">
    <?php get_sidebar("profile"); ?>
    <div role="content-van-profielpagina">
      <?php
        while(have_posts()) {
          the_post();
        ?>
        <h1><?php the_title(); ?></h1>
        <p><?php the_content(); ?></p>
        <?php
        }
      ?>
      
      <div class="content-profile">
          <p>Naam:</p>
          <p>Voornaam:</p>
          <p>Wie je bent:</p>
          <p>BTW-nummer:</p>
          <p>E-mailadres:</p>
          <p>Telefoonnummer:</p>
          <p>Adres + nummer:</p>
          <p>Postcode:</p>
          <p>Gemeente:</p>
          <p>Wachtwoord:</p>
      </div>
      
    </div>
  </div>
</main>
<?php
  get_footer();
?>
