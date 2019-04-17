<?php get_header(); ?>
<?php
  /*
    REMOVE THIS COMMENT

    content for showing blog posts goes here
    -> in the case of KdG Fablab: Nieuws
   */
?>
<main>
  <h2>Laatste nieuws</h2>
  <?php
    while(have_posts()) {
      the_post();
  ?>
  <article class="news_item">
    <h2>
      <span role="accentuation">
        <?php
          $post_type = get_post_type();
          $accent = "";
        ?>
      </span>
      <?php echo strtoupper(get_the_title()); ?>
    </h2>
    <?php if (has_post_thumbnail()) { ?>
     <div class="thumbnail">
       <?php the_post_thumbnail(); ?>
     </div>
     <?php } else { ?>
     <img
      class="thumbnail"
      src="<?php echo get_theme_file_uri("img/default_news.jpg"); ?>"
      alt="news" />
    <?php } ?>
    <p class="excerpt">
     <?php
       if (has_excerpt()) {
         echo get_the_excerpt();
       } else {
         echo wp_trim_words(get_the_content(), 20); // control number of words
       }
     ?>
    </p>
    <a href="<?php the_permalink(); ?>">Meer info</a>
  </article>
  <?php
    }

    wp_reset_postdata();
    echo paginate_links();
  ?>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
