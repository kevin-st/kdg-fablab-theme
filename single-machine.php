<?php
  kdg_fablab_reset_reservation_process();

  get_header();
?>
<main id="mainSingle">
  <div role="breadcrumbs" class="breadcrumbs">
    <a href="<?php echo site_url('/toestellen/'); ?>">Toestellen</a>
    &gt; <?php strtolower(the_title()) ?>
  </div>
  <?php
    while(have_posts()) {
      the_post();
      $title = strtolower(str_replace(" ", "-", get_the_title()));
  ?>
  <article class="disp-f">
    <div class="img-thumb">
      <a href="<?php the_permalink(); ?>" class="thumbnail valencia">
        <?php
          if (has_post_thumbnail()) {
            the_post_thumbnail();
          } else {
        ?>
        <img src="<?php echo get_theme_file_uri("img/default_machine.jpg"); ?>" alt="toestel" />
        <?php
          }
        ?>
      </a>
    </div>
    <div class="content">
      <h1 role="title" class="title"><?php the_title(); ?></h1>
      <div class="content-text">
        <?php the_content(); ?>
      </div>
      <div class="buttons disp-f col-2-of-2">
        <a class="btn btn-blue " href="<?php
          $redirect_to = esc_url(add_query_arg([
            "id" => $title,
            "type" => "machine"
          ], site_url('/reserveren/')));

          if (is_user_logged_in()) {
            // redirect to reservation page
            echo $redirect_to;
          } else {
            echo esc_url(add_query_arg("redirect_to", $redirect_to, wp_login_url()));
          }
          ?>">
          Reserveer dit toestel!
          </a>
          <a class="btn btn-dark" href="<?php echo get_post_type_archive_link("machine"); ?>">Terug naar toestellen</a>
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
