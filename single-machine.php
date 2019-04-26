<?php get_header() ?>
<?php
  /*
    used for displaying a single post

    in this case: a post with type of machine
  */
?>
<main id="singleMachine">
  <?php
    while(have_posts()) {
      the_post();
      $title = strtolower(str_replace(" ", "-", get_the_title()));
  ?>
  <h1 role="title"><?php the_title(); ?></h1>
  <div role="thumbnail">
    <?php
      if (has_post_thumbnail()) {
        echo the_post_thumbnail();
      } else {
    ?>
    <img src="<?php echo get_theme_file_uri("img/default_machine.jpg"); ?>" alt="machine"/>
    <?php
      }
    ?>
  </div>
  <div role="content">
    <p><?php the_content(); ?></p>
  </div>
  <div role="button">
    <a href="<?php echo esc_url(add_query_arg("machine", $title, site_url('/reserveren'))); ?>">Reserveren</a> <!-- Moet nog nagekeken worden, reservatie plugin -->
  </div>
  <?php
    }
  ?>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
