<?php get_header(); ?>

<main id="mainToestellen" class=" disp-f">
  <section role="machines">
    <h1>Onze toestellen</h1>
    <article class="disp-f">
      <?php
        while(have_posts()) {
          the_post();
          $title = strtolower(str_replace(" ", "-", get_the_title()));
      ?>
      <div class="toestelContent">
        <a href="<?php the_permalink(); ?>" class="thumbnail">
        <?php if (has_post_thumbnail()) {
          the_post_thumbnail();
        } else {
        ?>
          <img class="valencia" src="<?php echo get_theme_file_uri("img/default_machine.jpg"); ?>" alt="machine">
        <?php } ?>
      </a>
        <div class="content">
          <h2 class="title"><?php the_title(); ?></h2>
          <p class="excerpt">
            <?php
              if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 35); // control number of words
              }
            ?>
          </p>
          <div class="buttons disp-f col-2-of-2">
            <a class="btn btn-dark" href="<?php the_permalink(); ?>">Meer info</a>
            <a class="btn btn-dark " href="<?php
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
            ?>">Reserveren</a> <!-- Moet nog nagekeken worden, reservatie plugin -->

          </div>
        </div>
      </div>
      <?php
        }
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
