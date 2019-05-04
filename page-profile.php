<?php
  /* Template Name: Profiel template */
  get_header();
?>
<main>
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
    </div>
  </div>
</main>
<?php
  get_footer();
?>
