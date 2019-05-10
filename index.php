<?php get_header(); ?>
<?php
  /*
    REMOVE THIS COMMENT

    content for showing blog posts goes here
    -> in the case of KdG Fablab: Nieuws
   */
?>
<main id="mainToestellen"  class="disp-f">
  <section role="machines">
  <h1>Laatste nieuws</h1>
  <article class="disp-f">
  <?php
    while(have_posts()) {
      the_post();
  ?>
<div class="toestelContent">
    <div class="img-thumb">
        <a href="<?php the_permalink(); ?>" class="thumbnail">
        <?php if (has_post_thumbnail()) {
          the_post_thumbnail();
        } else {
        ?>
          <img class="valencia" src="<?php echo get_theme_file_uri("img/default_news.jpg"); ?>" alt="news">
        <?php } ?>
        </a>
    </div>
    
    <div class="content">
        <h2 class="title">
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
        <div class="buttons disp-f col-2-of-2">
          <a class="btn btn-dark " href="<?php the_permalink(); ?>">Lees verder</a>
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
