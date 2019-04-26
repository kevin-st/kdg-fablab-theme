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
  <div class="introMachine">
    <div role="thumbnail" class="thumbnail">
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
    <div class="flexdiv">
      <h1 role="title" class="title"><?php the_title(); ?></h1>
    </div>

  </div>
  <div role="content" class="content">
    <p><?php the_content(); ?></p>
  </div>
  <div role="button" class="detailBtn">
    <a class="btn btn-dark " href="<?php echo esc_url(add_query_arg("machine", $title, site_url('/reserveren'))); ?>">Reserveer dit toestel!</a> <!-- Moet nog nagekeken worden, reservatie plugin -->
    <a class="btn btn-dark " href="<?php echo get_post_type_archive_link("machine"); ?>">Terug naar toestellen</a>
  </div>
  <?php
    }
  ?>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
