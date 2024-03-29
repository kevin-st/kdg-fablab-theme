<?php
  kdg_fablab_reset_reservation_process();

  get_header();
?>
<?php
  /*
    REMOVE THIS PHP TAG
    -> content of home page goes here
    -> this file is used when there is also a page which shows all posts
      -> in case of KdG Fablab: Nieuws
  */
?>
<div class="CTA">
  <?php
    $today = date("Ymd");
    $newest_workshop = new WP_Query([
      "posts_per_page" => 1, // control number of posts with this -> -1 is all posts
      "post_type" => "workshop",
      "meta_key" => "workshop_datum",
      "orderby" => "meta_value_num",
      "order" => "ASC",
      "meta_query" => [
        array(
          "key" => "workshop_datum",
          "compare" => ">=",
          "value" => $today,
          "type" => "numeric"
        )
      ]
    ]);

    // when workshops are found
    if ($newest_workshop->have_posts()) {
      while($newest_workshop->have_posts()) {
        $newest_workshop->the_post();
  ?>
    <a class="CTAtext" href="<?php the_permalink(); ?>">
      <span>Reserveer je plaats tijdens onze nieuwste workshop: <?php the_title(); ?></span>
    </a>
  <?php
      }
    } else {
      // no workshops are found, add extra query
      $random_machine = new WP_Query([
        "posts_per_page" => 1, // control number of posts with this -> -1 is all posts
        "post_type" => "machine",
        "orderby" => "rand",
        "order" => "ASC"
      ]);

      while($random_machine->have_posts()) {
        $random_machine->the_post();
  ?>
    <a class="CTAtext" href="<?php the_permalink(); ?>">
      <span>Benieuwd naar de <?php the_title(); ?>? Lees er hier meer over!</span>
    </a>
  <?php
    }
  }

  wp_reset_postdata();
  ?>
</div>
<main id="mainFrontpage" class="disp-f">

  <section role="news">
    <h1>Laatste nieuws</h1>
    <article class="disp-f">
      <?php
        $homepage_news = new WP_Query([
          "posts_per_page" => 1 // control number of posts with this -> -1 is all posts
        ]);

        while($homepage_news->have_posts()) {
          $homepage_news->the_post();
      ?>
      <div class="img-thumb">
        <a href="<?php the_permalink(); ?>" class="thumbnail valencia">
          <?php
            if (has_post_thumbnail()) {
              the_post_thumbnail();
            } else {
          ?>
          <img src="<?php echo get_theme_file_uri("img/default_news.jpg"); ?>" alt="nieuwsartikel" />
          <?php
            }
          ?>
        </a>
      </div>
      <div class="content">
        <a href="<?php the_permalink(); ?>">
          <h2 class="title disp-f"><?php echo wp_trim_words(get_the_title(), 5); ?>
            <span class="date"><?php the_date(); ?></span>
          </h2>
        </a>

        <p class="excerpt">
        <?php
          if (has_excerpt()) {
            echo get_the_excerpt();
          } else {
            echo wp_trim_words(get_the_content(), 25); // control number of words
          }
        ?>
        </p>
        <div class="buttons disp-f col-2-of-2 ">
          <a class="btn btn-dark" href="<?php the_permalink(); ?>">Lees verder</a>
          <a class="btn btn-dark" href="<?php echo get_permalink(get_option("page_for_posts")); ?>">Meer nieuws</a>
        </div>
      </div>

      <?php
        }

        wp_reset_postdata();
      ?>
    </article>
  </section>
  <section role="machines">
    <h1>Onze toestellen</h1>
    <article class="disp-f">
    <?php
      $last_added_machine = new WP_Query([
        "posts_per_page" => 1, // control number of posts with this -> -1 is all posts
        "post_type" => "machine"
      ]);

      while($last_added_machine->have_posts()) {
        $last_added_machine->the_post();
    ?>
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
      <a href="<?php the_permalink(); ?>">
        <h2 class="title"><?php the_title(); ?>
        </h2>
      </a>
      <p class="excerpt">
      <?php
        if (has_excerpt()) {
          echo get_the_excerpt();
        } else {
          echo wp_trim_words(get_the_content(), 25); // control number of words
        }
      ?>
      </p>
      <div class="buttons disp-f col-2-of-2">
        <a class="btn btn-dark" href="<?php the_permalink(); ?>">Lees meer</a>
        <a class="btn btn-dark" href="<?php echo get_post_type_archive_link("machine"); ?>">Meer toestellen</a>
      </div>

    </div>
    <?php
      }

      wp_reset_postdata();
    ?>
    </article>
  </section>
</main>

<?php
  get_footer();

  // do not close php tags at the end of a file
