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


<body>
<main class="content-show">

    <h1>Showcase</h1>
    
    <p>Zoek je inspiratie? Kijk dan even hieronder.</p>
    <p>Heb je zelf iets leuks gemaakt dat je wil delen? Zet je post dan op Instagram met <a href="https://www.instagram.com/explore/tags/kdgfablab/">#kdgfablab</a> en inspireer anderen.</p><br>
    
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


   <!--
    <div class="testDiv">

        <div class="imgShowcase1">

            <img id="showcaseImg1" class="showcase" src="<//?php echo get_theme_file_uri("img/showcase1.png"); ?>" alt="showcase">

            <img id="showcaseImg2" class="showcase" src="<//?php echo get_theme_file_uri("img/showcase2.png"); ?>" alt="showcase">

        </div>

        <div class="imgShowcase2">

            <img id="showcaseImg3" class="showcase" src="<//?php echo get_theme_file_uri("img/showcase3.png"); ?>" alt="showcase">

            <img id="showcaseImg4" class="showcase" src="<//?php echo get_theme_file_uri("img/showcase4.png"); ?>" alt="showcase">

        </div>

        <div class="imgShowcase3">

            <img id="showcaseImg5" class="showcase" src="<//?php echo get_theme_file_uri("img/showcase5.png"); ?>" alt="showcase">

            <img id="showcaseImg6" class="showcase" src="<//?php echo get_theme_file_uri("img/showcase6.png"); ?>" alt="showcase">

        </div>

    </div>
    -->

</main>
</body>

<?php
  get_footer();

  // do not close php tags at the end of a file
