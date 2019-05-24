<?php
  kdg_fablab_reset_reservation_process();

  get_header();
?>
<main id="mainSingle">
  <div role="breadcrumbs" class="breadcrumbs">
    <a href="<?php echo site_url('/nieuws/'); ?>">Laatste nieuws</a>
    > <span class="c-blue"> <?php strtolower(the_title()) ?></span>
  </div>
  <?php
    while(have_posts()) {
      the_post();
  ?>
  <article class="disp-f">
    <div class="img-thumb">
      <a href="<?php the_permalink(); ?>" class="thumbnail valencia">
        <?php
          if (has_post_thumbnail()) {
            the_post_thumbnail();
          } else {
        ?>
        <img src="<?php echo get_theme_file_uri("img/default_news.jpg"); ?>" alt="nieuwsartikel" />
        <?php
          }
        ?>
      </a>
    </div>
    <div class="content">
      <h1 role="title" class="title"><?php the_title(); ?></h1>
      <div class="content-text">
        <?php the_content(); ?>
      </div>
      <div class="buttons disp-f col-2-of-2">
        <a class="btn btn-blue btn-fw" href="<?php echo site_url('/nieuws') ?>">Terug naar nieuwsoverzicht</a>
      </div>
    </div>
  </article>
  <?php
    }
  ?>

</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
