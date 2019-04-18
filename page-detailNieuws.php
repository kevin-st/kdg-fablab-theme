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

<img id="frontpageImg" src="<?php echo get_theme_file_uri("img/detailNieuws_header.jpg"); ?>" alt="fablab workarea">

<main>
   
   <img src="">
    
    <h1>Workshop Lasercutten</h1>
    
        <p>17/05/2020 14u-16u</p>
        
        <p>Altijd al gedroomd om je eigen dino te maken? Een juwelendoos? Kom leren hoe je dat allemaal kan doen met een lasercutter.</p>
        <p>Om 14u zal je leren hoe je kan graveren en snijden met de machine. Laat je inspiratie op de vrije loop.</p>
        <p>Aarzel niet en schrij je nu nog in!</p>
        
        <a href="page-reserveren.php">Reserveer nu je plek</a>
    
    
</main>

<?php
  get_footer();

  // do not close php tags at the end of a file
