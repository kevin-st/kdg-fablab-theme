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

    <h1>Laatste nieuws</h1>
       
    <div class="nieuws1">
        
        <div class="nieuwsItem nieuwsItem1">
          
            <div class="foto">
               <img id="fotoNieuws valencia" src="<?php echo get_theme_file_uri("img/workshopLasercutten.png"); ?>">
            </div>
               
           <div class="tekstNieuws">

               <h2><span class="blauw">WORKSHOP</span> LASERCUTTEN</h2>

               <p>Altijd al gedroomd om je eigen dino te maken? Een juwelendoos? Kom leren hoe je dat allemaal kan doen met een lasercutter.</p>

               <a class="buttons" href="<?php echo site_url('reserveren') ?>">Reserveren</a>
               <a class="buttons" href="<?php echo site_url('detailNieuws') ?>">Meer details</a>
               
            </div>

        </div>

        <div class="nieuwsItem nieuwsItem2"> 
            <img id="fotoNieuws valencia" src="<?php echo get_theme_file_uri("img/openingParty.png"); ?>">

           <h2>THE OPENING <span class="blauw">PARTY</span></h2>

           <p>Iedereen is welkom op de opening van fablab.</p>
           
           <a class="buttons" href="<?php echo site_url('detailNieuws') ?>">Lees verder</a>
           <a class="buttons" href="<?php echo site_url('nieuws') ?>">Meer nieuws</a>
        </div>
        
    </div>
        
    <div class="nieuws2">

        <div class="nieuwsItem nieuwsItem3">    
           <img id="fotoNieuws valencia" src="<?php echo get_theme_file_uri("img/3dPrinter.png"); ?>">

           <h2><span class="blauw">NIEUWE</span> 3D PRINTER</h2>

           <p>Onze super coole 3D printer model Prusa blue shoe print al je creaties in no time. Kom het uittesten.</p>
           
           <a class="buttons" href="<?php echo site_url('reserveren') ?>">Reserveer me</a>
           <a class="buttons" href="<?php echo site_url('toestellen') ?>">Meer toestellen</a>
        </div>

        <div class="nieuwsItem nieuwsItem4">
           <img id="fotoNieuws valencia" src="<?php echo get_theme_file_uri("img/win.png"); ?>">

           <h2>WIN <span class="blauw">WIN</span> WIN</h2>

           <p>Doe mee aan onze wedstrijd! KdG zoekt een origineel iets en als jouw ontwerp gekozen wordt win je een gratis...</p>
               
            <a class="buttons" href="<?php echo site_url('#') ?>">Ik wil winnen</a>
           <a class="buttons" href="<?php echo site_url('#') ?>">Meer info</a>
        </div>
        
    </div>
        
    <div class="nieuws3">

        <div class="nieuwsItem nieuwsItem5">
           <img id="fotoNieuws valencia" src="<?php echo get_theme_file_uri("img/toestelReserveren.png"); ?>">

           <h2><span class="blauw">RESERVEER</span> JE TOESTEL</h2>

           <p>Vanaf nu kan je al onze 3D printers, stickermachines, lasercutters, oculus rifts, ... reserveren om er de coolste dingen mee te maken.</p>
           
           <a class="buttons" href="<?php echo site_url('reserveren') ?>">Reserveren</a>
           <a class="buttons" href="<?php echo site_url('toestellen') ?>">Meer toestellen</a>
        </div>

        <div class="nieuwsItem nieuwsItem6">
           <img id="fotoNieuws valencia" src="<?php echo get_theme_file_uri("img/vrCorner.png"); ?>">

           <h2><span class="blauw">VR</span> CORNER</h2>

           <p>Ben je het saaie uitzicht van de muren op je kot beu? Begeef je in een andere wereld aka onze VR-Corner. Visit to Hawaii? No prob!</p>
           
           <a class="buttons" href="<?php echo site_url('reserveren') ?>">Reserveer</a>
           <a class="buttons" href="<?php echo site_url('#') ?>">Meer info</a>
        </div>
        
    </div>
    
</main>

<?php
  get_footer();

  // do not close php tags at the end of a file
