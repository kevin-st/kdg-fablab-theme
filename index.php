<?php get_header(); ?>

<main id="mainArchive">
  <h1>Laatste nieuws</h1>
  <div role="news" class="disp-f">
    <?php
      while(have_posts()) {
        the_post();
    ?>
    <article class="nieuwsartikel disp-f">
      <div class="img-thumb">
        <?php $post_thumbnail_url = get_the_post_thumbnail_url(); ?>
        <a
          href="<?php the_permalink(); ?>"
          class="thumbnail valencia"
          style="background-image: url('<?php echo ($post_thumbnail_url) ? $post_thumbnail_url : get_theme_file_uri('img/default_news.jpg'); ?>');"
        >
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
