<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
  </head>
  <body class="<?php body_class(); ?>">
    <header>
      <div>
        <img src="img/KdG_icon-functioneel-diverse_vormen.svg" alt="fablab icon">
        <h1>FabLab</h1>
      </div>
      <?php
         wp_nav_menu([
           'theme_location' => 'main_navigation'
         ]);
      ?>


    </header>
