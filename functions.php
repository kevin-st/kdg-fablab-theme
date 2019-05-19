<?php
  /*
    REMOVE THIS COMMENT

    -> functions necessary for theme development go here
  */

  // define hooks -> overzicht hooks: https://codex.wordpress.org/Plugin_API/Action_Reference
  add_action('init', 'kdg_fablab_start_session', 1);
  add_action('wp_enqueue_scripts', 'kdg_fablab_enqueue_scripts');
  add_action('login_enqueue_scripts', 'kdg_fablab_enqueue_scripts');
  add_action('after_setup_theme', 'kdg_fablab_features');
  add_action('wp_login','kdg_fablab_end_session');
  add_action('wp_logout','kdg_fablab_end_session');

  add_filter('nav_menu_css_class' , 'kdg_fablab_nav_class', 10, 2);
  add_filter('login_headerurl', 'kdg_fablab_login_headerurl');
  add_filter('login_headertitle', 'kdg_fablab_login_headertitle');
  add_filter('wp_nav_menu_items', 'kdg_fablab_loginout_menu_link', 10, 2);

  /**
   * Start a session.
   */
  function kdg_fablab_start_session() {
    if (!session_id()) {
      session_start();
    }
  }

  /**
   * End a session.
   */
  function kdg_fablab_end_session() {
    session_destroy();
  }

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

     wp_enqueue_style('kdg_fablab_main_styles', get_stylesheet_uri(), NULL, microtime());

     wp_enqueue_script('kdg_fablab_js', get_theme_file_uri('js/scripts-bundled.js'), NULL, microtime()/*'1.0'*/, true);
   }

   /**
    * Enable specific features for the theme
    */
    function kdg_fablab_features() {
      add_theme_support("title-tag");
      add_theme_support("post-thumbnails");
      add_theme_support("customize-selective-refresh-widgets");
      add_image_size('pageBanner', 1500, 550, true);

      // function(name_for_wordpress, human_readable_name);
      register_nav_menu('main_navigation', 'Hoofdnavigatie');
      register_nav_menu("profile_navigation", "Profielnavigatie");
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

    /**
     * Fix navigation menu hightlighting
     */
    function kdg_fablab_nav_class($classes, $item, $post = null){
      $current_post_type = get_post_type();

      if ((is_post_type_archive('machine') || $current_post_type == 'machine') && strtolower($item->title) == "toestellen"){
        $classes[] = "current-menu-item";
      } else if ((is_post_type_archive('workshop') || $current_post_type == 'workshop') && strtolower($item->title) == "workshops"){
        $classes[] = "current-menu-item";
      } else if ((is_post_type_archive('post')|| $current_post_type == 'post') && strtolower($item->title) == "nieuws"){
        $classes[] = "current-menu-item";
      }

      return $classes;
    }

    /**
     * Get page banner
     */
    function kdg_fablab_get_page_banner($args = []) {
      if (!isset($args['img'])) {
        if (get_field('pagina_banner')) {
          $args['img'] = get_field('pagina_banner')['sizes']['pageBanner'];
    ?>
      <div class="page-banner p-rel">
        <img class="col-2-of-2 valencia" src="<?php echo $args['img']; ?>" alt="page-banner">
        <?php if (is_front_page()) { ?>
        <a
        class="introbtn"
        href="<?php echo is_user_logged_in() ? site_url('reserveren') : site_url('login'); ?>">
        Reserveer nu!
        </a>
        <?php } ?>
      </div>
    <?php
        }
      }
    }

    /**
     * Change login header url
     */
    function kdg_fablab_login_headerurl() {
      return esc_url(site_url('/'));
    }

    /**
     * Change login header title
     */
    function kdg_fablab_login_headertitle() {
      return get_bloginfo('name');
    }

    /**
     * Add login/out icon programmaticly to nav menu
     */
    function kdg_fablab_loginout_menu_link($items, $args) {
      if ($args->theme_location == 'main_navigation') {
        if (is_user_logged_in()) {
          // change url to dashboard
          $items .= '<li class="menu-item"><a href="'. site_url("/mijn-profiel/") .'">Mijn profiel</a></li>';
        } else {
          $items .= '<li class="menu-item"><a href="'. wp_login_url(get_permalink()) .'">'. __("Log In") .'</a></li>'; /* needs some fixing -> when on toestellen it redirects to the last added machine */
        }
      }

      return $items;
    }

    // do not close php tags at the end of a file
