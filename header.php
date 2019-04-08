<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php wp_head(); ?>
  </head>
  <body class="<?php body_class(); ?>">
    <header>
      <?php
        /*
          REMOVE THIS COMMENT
          Header related code goes here

          to define multiple headers: https://codex.wordpress.org/Function_Reference/get_header#Multiple_Headers
         */
         wp_nav_menu([
           'theme_location' => 'main_navigation'
         ]);
      ?>
      

    </header>
