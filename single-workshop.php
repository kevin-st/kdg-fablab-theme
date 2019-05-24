<?php
  kdg_fablab_reset_reservation_process();

  get_header();
?>
<main id="mainSingle">
  <div role="breadcrumbs" class="breadcrumbs">
    <a href="<?php echo site_url('/workshops/'); ?>">Workshops</a>
    &gt; <?php strtolower(the_title()) ?>
  </div>
  <?php
    while(have_posts()) {
      the_post();
      $title = strtolower(str_replace(" ", "-", get_the_title()));
      // get the date of the workshop formatted as Ymd
      $date = DateTime::createFromFormat("Ymd", get_field("workshop_datum", $post->ID, FALSE));
      // convert date to readable format
      $date_nice_format = $date->format("d/m/Y");
      $today = new DateTime();
  ?>
  <article class="disp-f">
    <div class="img-thumb">
      <a href="<?php the_permalink(); ?>" class="thumbnail valencia">
        <?php
          if (has_post_thumbnail()) {
            the_post_thumbnail();
          } else {
        ?>
        <img src="<?php echo get_theme_file_uri("img/default_workshop.jpg"); ?>" alt="workshop" />
        <?php
          }
        ?>
      </a>
    </div>
    <div class="content">
      <h1 role="title" class="title disp-f">
        <?php the_title(); ?>
        <span class="date"><?php echo $date_nice_format; ?></span>
      </h1>
      <div class="content-text">
        <?php the_content(); ?>
      </div>
      <div class="buttons disp-f col-2-of-2">
        <?php if ($date >= $today) { ?>
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
          Schrijf nu in!
          </a>
          <?php } ?>
          <a class="btn btn<?php echo ($date <= $today) ? "-fw btn-blue" : "-dark" ; ?>" href="<?php echo get_post_type_archive_link("workshop"); ?>">Terug naar workshops</a>
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
