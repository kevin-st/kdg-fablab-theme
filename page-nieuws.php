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

.nieuwsItem {
    
}
    
.buttons{
    width: 200px;
    text-decoration: none;
    background-color: #1d1d1b;
    color: #ffffff;
    padding: 20px;
    font-weight: 900;
    letter-spacing: 1.5px;
    font-size: 25px;
}

</style>

<img id="frontpageImg" src="<?php echo get_theme_file_uri("img/nieuws_header.jpg"); ?>">

<main>

    <h1>Laatste nieuws</h1>
        
        <div class="nieuwsItem">
           <img src="">

           <h2>Workshop lasercutten</h2>

           <p>Altijd al gedroomd om je eigen dino te maken? Een juwelendoos? Kom leren hoe je dat allemaal kan doen met een lasercutter.</p>
           
           <a class="buttons" href="<?php echo site_url('reserveren') ?>">Reserveren</a>
           <a class="buttons" href="<?php echo site_url('detailNieuws') ?>">Meer details</a>

        </div>

        <div class="nieuwsItem"> 
           <img src="">

           <h2>De opening party</h2>

           <p>Iedereen is welkom op de opening van fablab.</p>
           
           <a class="buttons" href="<?php echo site_url('detailNieuws') ?>">Lees verder</a>
           <a class="buttons" href="<?php echo site_url('nieuws') ?>">Meer nieuws</a>
        </div>

        <div class="nieuwsItem">    
           <img src="">

           <h2>Nieuwe 3D printer</h2>

           <p>Onze super coole 3D printer model Prusa blue shoe print al je creaties in no time. Kom het uittesten.</p>
           
           <a class="buttons" href="<?php echo site_url('reserveren') ?>">Reserveer me</a>
           <a class="buttons" href="<?php echo site_url('toestellen') ?>">Meer toestellen</a>
        </div>

        <div class="nieuwsItem">
           <img src="">

           <h2>Win win win</h2>

           <p>Doe mee aan onze wedstrijd! KdG zoekt een origineel iets en als jouw ontwerp gekozen wordt win je een gratis...</p>
               
            <a class="buttons" href="<?php echo site_url('#') ?>">Ik wil winnen</a>
           <a class="buttons" href="<?php echo site_url('#') ?>">Meer info</a>
        </div>

        <div class="nieuwsItem">
           <img src="">

           <h2>Reserveer je toestel</h2>

           <p>Vanaf nu kan je al onze 3D printers, stickermachines, lasercutters, oculus rifts, ... reserveren om er de coolste dingen mee te maken.</p>
           
           <a class="buttons" href="<?php echo site_url('reserveren') ?>">Reserveren</a>
           <a class="buttons" href="<?php echo site_url('toestellen') ?>">Meer toestellen</a>
        </div>

        <div class="nieuwsItem">
           <img src="">

           <h2>VR corner</h2>

           <p>Ben je het saaie uitzicht van de muren op je kot beu? Begeef je in een andere wereld aka onze VR-Corner. Visit to Hawaii? No prob!</p>
           
           <a class="buttons" href="<?php echo site_url('reserveren') ?>">Reserveer</a>
           <a class="buttons" href="<?php echo site_url('#') ?>">Meer info</a>
        </div>
    
</main>

<?php
  get_footer();

  // do not close php tags at the end of a file
