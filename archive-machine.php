<?php get_header(); ?>
<?php
  /*
    used for showing an archive of blog posts

    to show an archive of custom posts (like machines):
      - create extra .php file -> e.g. archive-machine.php
  */
?>
<main>
  <h2>Onze toestellen</h2>
  <?php
    while(have_posts()) {
      the_post();

      $title = strtolower(str_replace(" ", "-", get_the_title()));
  ?>
  <div class="machine-item small"> <!-- change classes if needed -->
     <h2 class="title"><?php the_title(); ?></h2>
     <?php if (has_post_thumbnail()) { ?>
      <div class="thumbnail">
        <?php the_post_thumbnail(); ?>
      </div>
      <?php } else { ?>
      <img class="thumbnail" src="<?php echo get_theme_file_uri("img/default_machine.jpg"); ?>" alt="machine">
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
     <a href="<?php echo esc_url(add_query_arg("machine", $title, site_url('/reserveren'))); ?>">Reserveren</a> <!-- Moet nog nagekeken worden, reservatie plugin -->
     <a href="<?php the_permalink(); ?>">Meer info</a>
  </div>
  <?php
    }

    echo paginate_links();
  ?>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
