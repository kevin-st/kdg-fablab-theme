<?php get_header(); ?>
<?php
  /*
    REMOVE THIS COMMENT

    content for a single item goes here:
    - this template is used for a single blog post
    - can also include custom items
      -> e.g. machines for a "single-machine(.php)"
   */
?>
<main>
  <?php
    while(have_posts()) {
      the_post();
      $title = strtolower(str_replace(" ", "-", get_the_title()));
  ?>
  <div role="breadcrumbs">
    <a href="<?php echo site_url('/nieuws/'); ?>">Laatste nieuws</a>
    > <?php strtolower(the_title()) ?>
  </div>
  <div role="title">
    <h1 role="title-content"><?php the_title(); ?></h1>
    <p>
      <span role="date"><?php the_field('workshop_datum'); ?></span>
      <span role="time"><?php the_field('start_tijd'); ?> - <?php the_field('eind_tijd'); ?></span>
    </p>
  </div>
  <div role="thumbnail">
    <?php
      if (has_post_thumbnail()) {
        echo the_post_thumbnail();
      } else {
    ?>
    <img src="<?php echo get_theme_file_uri("img/default_news.jpg"); ?>" alt="news"/> <!-- default_workshop.jpg? -->
    <?php
      }
    ?>
  </div>
  <div role="content">
    <p><?php the_content(); ?></p>
  </div>
  <div role="button"> <!-- only display when user is logged in? -->
    <a href="<?php echo esc_url(add_query_arg("workshop", $title, site_url('/reserveren'))); ?>">Schrijf nu in</a>
  </div>
  <?php
    }
  ?>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
