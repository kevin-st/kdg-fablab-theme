<?php
  kdg_fablab_reset_reservation_process();

  get_header();
?>

<main id="mainArchive">
    <h1>Onze workshops</h1>
    <div role="workshops" class="disp-f">
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
      <article class="workshop disp-f">
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
          <h2 class="title disp-f"><?php the_title(); ?><span class="date"><?php echo $date_nice_format; ?></span></h2>
          <p class="excerpt">
            <?php
              if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 20); // control number of words
              }
            ?>
          </p>
          <div class="buttons disp-f col-2-of-2">
            <a class="btn <?php echo ($date <= $today) ? "btn-fw" : "" ; ?> btn-dark" href="<?php the_permalink(); ?>">Meer info</a>
            <?php if ($date >= $today) { ?>
            <a class="btn btn-dark " href="<?php
              $redirect_to = esc_url(add_query_arg([
                "id" => $title,
                "type" => "workshop"
              ], site_url('/reserveren/')));

              if (is_user_logged_in()) {
                // redirect to reservation page
                echo $redirect_to;
              } else {
                echo esc_url(add_query_arg("redirect_to", $redirect_to, wp_login_url()));
              }
            ?>">Reserveren</a>
            <?php } ?>
          </div>
        </div>
      </article>
      <?php
        }
      ?>
    </div>
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
