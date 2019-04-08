<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
  </head>
  <body class="<?php body_class(); ?>">
    <header>
      <div id="vormgeving"></div>
      <div id="vormgeving2"></div>
      <div id="logonaam">
        <a href="<?php echo site_url(); ?>">
          <img src="<?php echo get_theme_file_uri("img/logowit.png"); ?>" alt="fablab icon">
          <h1>FabLab</h1>
        </a>
      </div>
      <?php
         wp_nav_menu([
           'theme_location' => 'main_navigation'
         ]);
      ?>




    </header>
