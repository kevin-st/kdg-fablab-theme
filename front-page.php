<?php get_header(); ?>
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
      $newest_workshop = new WP_Query([
        "posts_per_page" => 1, // control number of posts with this -> -1 is all posts
        "post_type" => "workshop"
      ]);

      while($newest_workshop->have_posts()) {
        $newest_workshop->the_post();
    ?>
      <a class="CTAtext" href="<?php the_permalink(); ?>">
        <span>Reserveer je plaats tijdens onze nieuwste workshop: <?php the_title(); ?></span>
          <?php
            }
          ?>
      </a>
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
        <a class="thumbnaillink" href="<?php the_permalink(); ?>">
          <?php if (has_post_thumbnail()) { ?>
           <div class="thumbnail">
             <?php the_post_thumbnail(); ?>
           </div>
           <?php } else { ?>
           <img class="thumbnail valencia" src="<?php echo get_theme_file_uri("img/default_news.jpg"); ?>" alt="news">
          <?php } ?>
        </a>
          <div class="content">
            <h2 class="title"><?php the_title(); ?></h2>

             <p class="excerpt">
              <?php
                if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 30); // control number of words
                }
              ?>
             </p>
             <div class="buttons-frontpage disp-f col-2-of-2 ">
               <a class="btn btn-dark" href="<?php the_permalink(); ?>">Lees verder</a>
               <a class="btn btn-dark" href="<?php echo get_permalink(get_option("page_for_posts")); ?>">Meer nieuws</a>
             </div>

           </div>

        <?php
          }
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
        <a class="thumbnaillink" href="<?php the_permalink(); ?>">
           <?php if (has_post_thumbnail()) { ?>
            <div class="thumbnail">
              <?php the_post_thumbnail(); ?>
            </div>
            <?php } else { ?>
            <img class="thumbnail valencia" src="<?php echo get_theme_file_uri("img/default_machine.jpg"); ?>" alt="machine">
           <?php } ?>
          </a>
           <div class="content">
           <h2 class="title"><?php the_title(); ?></h2>
           <p class="excerpt">
            <?php
              if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 30); // control number of words
              }
            ?>
           </p>
           <div class="buttons-frontpage disp-f col-2-of-2">
             <a class="btn btn-dark" href="<?php the_permalink(); ?>">Lees meer</a>
             <a class="btn btn-dark" href="<?php echo get_post_type_archive_link("machine"); ?>">Meer toestellen</a>
           </div>

           </div>
        <?php
          }
        ?>
      </article>
    </section>


  </main>

<?php
  get_footer();

  // do not close php tags at the end of a file
