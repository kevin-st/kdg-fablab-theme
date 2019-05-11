<?php get_header(); ?>
<main id="mainSingle">
  <div role="breadcrumbs" class="breadcrumbs">
    <a href="<?php echo site_url('/nieuws/'); ?>">Laatste nieuws</a>
    > <?php strtolower(the_title()) ?>
  </div>
  <?php
    while(have_posts()) {
      the_post();
  ?>
  <article class="disp-f">
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
      <h1 role="title" class="title"><?php the_title(); ?></h1>
      <div class="content-text">
        <?php the_content(); ?>
      </div>
      <div class="buttons disp-f col-2-of-2">
        <a class="btn btn-blue btn-fw" href="<?php echo site_url('/nieuws') ?>">Terug naar nieuwsoverzicht</a>
      </div>
    </div>
  </article>




  <?php
    }
  ?>

</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
