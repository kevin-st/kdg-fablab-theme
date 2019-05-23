<?php
  kdg_fablab_reset_reservation_process();

  get_header();
?>

<main id="mainArchive">
  <h1>Laatste nieuws</h1>
  <div role="news" class="disp-f">
    <?php
      while(have_posts()) {
        the_post();
    ?>
    <article class="nieuwsartikel disp-f">
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
        <h2 class="title disp-f"><?php echo wp_trim_words(get_the_title(), 5); ?><span class="date"><?php echo get_the_date(); ?></span></h2>
        <p class="excerpt">
        <?php
          if (has_excerpt()) {
            echo get_the_excerpt();
          } else {
            echo wp_trim_words(get_the_content(), 20); // control number of words
          }
        ?>
        </p>
        <div class="buttons disp-f col-2-of-2">
          <a class="btn btn-dark " href="<?php the_permalink(); ?>">Lees verder</a>
        </div>
      </div>
    </article>
  <?php
    }
    wp_reset_postdata();

  ?>
  </div>
  <div class="pagination">
    <?php
      echo paginate_links();
    ?>
  </div>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
