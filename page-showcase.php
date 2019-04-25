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

<style>

.imgShowcase1, .imgShowcase2, .imgShowcase3 {
    display: flex;
}
    
#showcaseImg1, #showcaseImg3, #showcaseImg5 {
   padding-right: 15px;
}
    
.showcase {
    padding-bottom: 15px;
}
    

@media screen and (max-width: 992px) {
    
    main {
        padding-left: 50px;
        padding-right: 50px;
        height: 2700px;
    }
    
    .imgShowcase1, .imgShowcase2, .imgShowcase3 {
        position: relative;
        top: 0;
        left: 0;
    }
    
    .imgShowcase2, .imgShowcase3, .imgShowcase5 {
        top: 515px;
    }
    
    
    #showcaseImg1, #showcaseImg3, #showcaseImg5 {
        position: relative;
    }

    #showcaseImg2, #showcaseImg4, #showcaseImg6 {
        position: absolute;
        top: 515px;
    }

}

@media screen and (max-width: 600px) {
    
   
    
}

</style>

<img id="frontpageImg" src="<?php echo get_theme_file_uri("img/showcase_header.jpg"); ?>">

<main>
    
    <h1>Showcase</h1>
    
    <div class="testDiv">
    
        <div class="imgShowcase1">
    
            <img id="showcaseImg1" class="showcase" src="<?php echo get_theme_file_uri("img/showcase1.png"); ?>" alt="showcase">

            <img id="showcaseImg2" class="showcase" src="<?php echo get_theme_file_uri("img/showcase2.png"); ?>" alt="showcase">
            
        </div>
            
        <div class="imgShowcase2">

            <img id="showcaseImg3" class="showcase" src="<?php echo get_theme_file_uri("img/showcase3.png"); ?>" alt="showcase">

            <img id="showcaseImg4" class="showcase" src="<?php echo get_theme_file_uri("img/showcase4.png"); ?>" alt="showcase">
            
        </div>
            
        <div class="imgShowcase3">

            <img id="showcaseImg5" class="showcase" src="<?php echo get_theme_file_uri("img/showcase5.png"); ?>" alt="showcase">

            <img id="showcaseImg6" class="showcase" src="<?php echo get_theme_file_uri("img/showcase6.png"); ?>" alt="showcase">
        
        </div>
        
    </div>
    
</main>

<?php
  get_footer();

  // do not close php tags at the end of a file
