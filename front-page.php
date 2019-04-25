<?php get_header(); ?>
  <?php
    /*
      REMOVE THIS PHP TAG
      -> content of home page goes here
      -> this file is used when there is also a page which shows all posts
        -> in case of KdG Fablab: Nieuws
    */
  ?>
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

          <?php if (has_post_thumbnail()) { ?>
           <div class="thumbnail">
             <?php the_post_thumbnail(); ?>
           </div>
           <?php } else { ?>
           <img class="thumbnail" src="<?php echo get_theme_file_uri("img/default_news.jpg"); ?>" alt="news">
          <?php } ?>
          <div class="content">
            <h2 class="title"><?php the_title(); ?></h2>

             <p class="excerpt">
              <?php
                if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 40); // control number of words
                }
              ?>
             </p>
             <div class="buttons ">
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
           <?php if (has_post_thumbnail()) { ?>
            <div class="thumbnail">
              <?php the_post_thumbnail(); ?>
            </div>
            <?php } else { ?>
            <img class="thumbnail" src="<?php echo get_theme_file_uri("img/default_machine.jpg"); ?>" alt="machine">
           <?php } ?>
           <div class="content">
           <h2 class="title"><?php the_title(); ?></h2>
           <p class="excerpt">
            <?php
              if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 40); // control number of words
              }
            ?>
           </p>
           <div class="buttons">
             <a class="btn btn-dark" href="<?php the_permalink(); ?>">Reserveer me</a>
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
