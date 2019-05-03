<?php get_header(); ?>
<?php
  /*
    REMOVE THIS COMMENT

    content for showing blog posts goes here
    -> in the case of KdG Fablab: Nieuws
   */
?>
<main id="mainToestellen"  class="mainNews disp-f">
  <section role="news">
  <h1>Laatste nieuws</h1>
  <article class="disp-f">
  <?php
    while(have_posts()) {
      the_post();
  ?>
<div class="toestelContent newsContent">
        <?php if (has_post_thumbnail()) { ?>
     <a href="<?php the_permalink(); ?>" class="thumbnail">
       <?php the_post_thumbnail(); ?>
     </a>
     <?php } else { ?>
     <img
      class="thumbnail"
      src="<?php echo get_theme_file_uri("img/default_news.jpg"); ?>"
      alt="news" />
    <?php } ?>
    <div class="content">


    <h2 class="title">
      <span role="accentuation">
        <?php
          $post_type = get_post_type();
          $accent = "";
        ?>
      </span>
      <?php echo strtoupper(get_the_title()); ?>
    </h2>
    <p class="excerpt">
     <?php
       if (has_excerpt()) {
         echo get_the_excerpt();
       } else {
         echo wp_trim_words(get_the_content(), 25); // control number of words
       }
     ?>
    </p>
    <div class="buttons newsButtons p-rel">
      <a class="btn btn-dark morenewsBtn " href="<?php the_permalink(); ?>">Lees verder</a>
    </div>

    </div>
  </div>
  <?php
    }
    wp_reset_postdata();

  ?>
  </article>
  <div class="pagination">
    <?php
      echo paginate_links();
    ?>
  </div>
  </section>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
