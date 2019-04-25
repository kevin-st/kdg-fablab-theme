<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <header>
      <nav>
        <div id="vormgeving"></div>
        <div id="vormgeving2"></div>
        <div id="logonaam">
          <a href="<?php echo site_url(); ?>">
            <img src="<?php echo get_theme_file_uri("img/logowit.png"); ?>" alt="fablab icon">
            <h1>FabLab</h1>
          </a>
        </div>
        <div class="burgerbtn">
          <img id="menuimg" src="<?php echo get_theme_file_uri("img/onder.png"); ?>" alt="menu icon">
          <img id="menuimg2" class="zichtbaarheid" src="<?php echo get_theme_file_uri("img/boven.png"); ?>" alt="menu icon">
        </div>
        <div id="menu-container" class="zichtbaarheid">
          <?php
             wp_nav_menu([
               'theme_location' => 'main_navigation'
             ]);
          ?>
        </div>
      </nav>

      <?php kdg_fablab_get_page_banner(); ?>
    </header>
