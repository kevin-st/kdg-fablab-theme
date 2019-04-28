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
<main class="detail">
  <?php
    while(have_posts()) {
      the_post();
  ?>
  <div role="breadcrumbs" class="breadcrumbs">
    <a href="<?php echo site_url('/nieuws/'); ?>">Laatste nieuws</a>
    > <?php strtolower(the_title()) ?>
  </div>
  <div class="contentdetail">
    <div role="thumbnail" class="thumbnail">
      <?php
        if (has_post_thumbnail()) {
          echo the_post_thumbnail();
        } else {
      ?>
      <img src="<?php echo get_theme_file_uri("img/default_news.jpg"); ?>" alt="news"/>
      <?php
        }
      ?>
    </div>
    <div class="opdeling">
      <div role="title" class="title">
        <h1 role="title-content" ><?php the_title(); ?></h1>
        <p>
          <span role="date"><?php the_date(); ?></span>
          <span role="time"><?php the_time(); ?></span>
        </p>
      </div>
      <div role="content" class="content">
        <p><?php the_content(); ?></p>
      </div>
      <div role="button" class="detailBtn">
        <a class="btn btn-dark " href="<?php echo site_url('/nieuws/'); ?>">Terug naar nieuwsberichten</a>
      </div>
    </div>
  </div>




  <?php
    }
  ?>

</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
