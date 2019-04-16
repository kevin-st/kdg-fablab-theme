<?php get_header(); ?>
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
    
    <h1>Showcase</h1>
    
        <img id="showcaseImg" src="<?php echo get_theme_file_uri("img/showcase1.png"); ?>" alt="showcase">
        
        <img id="showcaseImg" src="<?php echo get_theme_file_uri("img/showcase2.png"); ?>" alt="showcase">
        
        <img id="showcaseImg" src="<?php echo get_theme_file_uri("img/showcase3.png"); ?>" alt="showcase">
        
        <img id="showcaseImg" src="<?php echo get_theme_file_uri("img/showcase4.png"); ?>" alt="showcase">
        
        <img id="showcaseImg" src="<?php echo get_theme_file_uri("img/showcase5.png"); ?>" alt="showcase">
        
        <img id="showcaseImg" src="<?php echo get_theme_file_uri("img/showcase6.png"); ?>" alt="showcase">
    
</main>

<?php
  get_footer();

  // do not close php tags at the end of a file
