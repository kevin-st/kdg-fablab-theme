<?php
  /*
    REMOVE THIS COMMENT

    -> functions necessary for theme development go here
  */

  // define hooks -> overzicht hooks: https://codex.wordpress.org/Plugin_API/Action_Reference
  add_action('wp_enqueue_scripts', 'kdg_fablab_enqueue_scripts');
  add_action('after_setup_theme', 'kdg_fablab_features');

  /**
   * Load recources necessary for the theme.
   */
   function kdg_fablab_enqueue_scripts() {
     /*
      Load styles: wp_enqueue_style(random_name, resource);
      Load scripts: wp_enqueue_script(random_name, resource);

      -> e.g.
        wp_enqueue_style('custom-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        wp_enqueue_style('font-awesome', ''//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'');
     */

     wp_enqueue_style('kdg_fablab_main_styles', get_stylesheet_uri());

     wp_enqueue_script('kdg_fablab_js', get_theme_file_uri('js/scripts-bundled.js'), NULL, '1.0', true);
   }

   /**
    * Enable specific features for the theme
    */
    function kdg_fablab_features() {
      add_theme_support('title-tag');

      // function(name_for_wordpress, human_readable_name);
      register_nav_menu('main_navigation', 'Hoofdnavigatie');
      /*
        if multiple navigations are needed:
        -> e.g.
          register_nav_menu('footer_menu_1', 'Footer menu 1');
          register_nav_menu('footer_menu_2', 'Footer menu 2');

          to use in theme related files (e.g. footer.php):
          -> "<?php
            wp_nav_menu([
              'theme_location' => 'footer_menu_1'
            ]);
          ?>"
      */
    }

    // do not close php tags at the end of a file
