<?php
  /* Template Name: Showcase template */
  kdg_fablab_reset_reservation_process();
  
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

<main class="content-show">

  <?php
    while(have_posts()) {
      the_post();
  ?>
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
  <?php } ?>

    <div class="feed">
        <!-- <div>tag needs to be here for now - don't delete -->
        <div id="curator-feed"><a href="https://curator.io" target="_blank" class="crt-logo crt-tag">Powered by Curator.io</a></div>

        <!-- Javascript for the #kdgfablab in grid style -->
        <script type="text/javascript">
        /* curator-feed */
        (function(){
        var i, e, d = document, s = "script";i = d.createElement("script");i.async = 1;
        i.src = "https://cdn.curator.io/published/123fbe1f-fe03-4bfd-881c-a8d4fe5092fa.js";
        e = d.getElementsByTagName(s)[0];e.parentNode.insertBefore(i, e);
        })();
        </script>
    </div>

</main>

<?php
  get_footer();

  // do not close php tags at the end of a file
