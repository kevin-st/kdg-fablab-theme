   <?php
   get_header(); ?>
   <div class="intro404">
     <h1 class="page-title">Error404: Helaas kunnen we  de pagina die u zoekt niet vinden.</h1>
     <p>Dit kan komen doordat de pagina niet meer bestaat, of doordat eeen typefout is gemaakt bij het invoeren van het adres. U kunt het via de navigatie de weg vinden.</p>
     <p id="p_404">Of zocht u toevallig een van de onderstaande dingen?</p>
   </div>

    <main id="mainFrontpage" class="disp-f content404">

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
             <img class="thumbnail" src="<?php echo get_theme_file_uri("img/default_news.jpg"); ?>" alt="news">
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
              <img class="thumbnail" src="<?php echo get_theme_file_uri("img/default_machine.jpg"); ?>" alt="machine">
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
   <?php get_footer(); ?>
