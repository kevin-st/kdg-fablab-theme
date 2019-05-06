<?php
  /* Template Name: Reserveren Template */
  $step = 0;

  if ($_POST === []) {
    echo "POST is leeg";
  } else {
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
  }

  get_header();
?>
<?php
  /*
    REMOVE THIS COMMENT

    content for generic page goes here (layout can be used accross multiple pages):
    -> e.g.
      - About us
      - Biography of an author
      - ...

    creating a custom page:
    -> https://developer.wordpress.org/themes/template-files-section/page-template-files/#creating-custom-page-templates-for-global-use
   */
?>
<main>
  <div class="title-content">
    <?php
      while(have_posts()) {
        the_post();
    ?>
    <h1><?php the_title(); ?></h1>
    <?php
        the_content();
      }
    ?>
  </div>
  <div class="page-reserveren-content">
    <form id="reservation-form" action="<?php the_permalink(); ?>" method="post">

      <?php if ($step === 0) { ?>
        <div class="input-group">
          <label for="reservation-item">Wat wilt u reserveren?</label>
          <select name="reservation-item">
            <optgroup label="Toestellen">
              <?php
                $machines_query = new WP_Query([
                  "posts_per_page" => -1,
                  "post_type" => "machine"
                ]);

                while($machines_query->have_posts()) {
                  $machines_query->the_post();
              ?>
              <option><?php the_title(); ?></option>
              <?php
                }
              ?>
            </optgroup>
            <optgroup label="Workshops">
              <?php
                $workshops_query = new WP_Query([
                  "posts_per_page" => -1,
                  "post_type" => "workshop"
                ]);

                while($workshops_query->have_posts()) {
                  $workshops_query->the_post();
              ?>
              <option><?php the_title(); ?></option>
              <?php
                }
              ?>
            </optgroup>
          </select>
        </div>
        <div class="input-group">
          <input type="date" name="reservation-date" value="" />
        </div>

        <input class="btn btn-submit" type="submit" name="submit" value="Volgende" />
      <?php } ?>


    </form>
  </div>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
