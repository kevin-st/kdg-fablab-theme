<?php
  /*
    REMOVE THIS COMMENT

    -> functions necessary for theme development go here
  */

  // define hooks -> overzicht hooks: https://codex.wordpress.org/Plugin_API/Action_Reference
  add_action('init', 'kdg_fablab_start_session', 1);
  add_action('admin_init', 'kdg_fablab_redirect_to_front_end');
  add_action('wp_loaded', 'kdg_fablab_hide_admin_bar_sub');
  add_action('wp_enqueue_scripts', 'kdg_fablab_enqueue_scripts');
  add_action('login_enqueue_scripts', 'kdg_fablab_enqueue_scripts');
  add_action('after_setup_theme', 'kdg_fablab_features');
  add_action('wp_login','kdg_fablab_end_session');
  add_action('wp_logout','kdg_fablab_end_session');
  add_action('register_form', 'kdg_fablab_registration_form');
  add_action('user_register', 'kdg_fablab_user_register');
  add_action("show_user_profile", "kdg_fablab_show_custom_profile_fields");
  add_action("edit_user_profile", "kdg_fablab_show_custom_profile_fields");
  add_action('template_redirect', 'kdg_fablab_author_page_redirect');

  add_filter('manage_users_columns', 'kdg_fablab_modify_user_table');
  add_filter('manage_users_custom_column', 'kdg_fablab_modify_user_table_row', 10, 3);
  add_filter('nav_menu_css_class' , 'kdg_fablab_nav_class', 10, 2);
  add_filter('login_headerurl', 'kdg_fablab_login_headerurl');
  add_filter('login_headertitle', 'kdg_fablab_login_headertitle');
  add_filter('wp_nav_menu_items', 'kdg_fablab_loginout_menu_link', 10, 2);
  add_filter('registration_errors', 'kdg_fablab_registration_errors', 10, 3);
  add_filter("query_vars", "kdg_fablab_query_vars");
  add_filter("generate_rewrite_rules", "kdg_fablab_custom_rewrite_rules");

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
      add_theme_support('title-tag');
      add_theme_support('post-thumbnails');
      add_image_size('pageBanner', 1500, 350, true);

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

    /**
     * Recognize custom query vars
     */
    function kdg_fablab_query_vars($vars) {
      $vars[] = "id";

      return $vars;
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
        }
      }
    ?>
      <div class="page-banner p-rel">
        <img class="col-2-of-2" src="<?php echo $args['img']; ?>" alt="page-banner">
        <?php if (is_front_page()) { ?>
        <a class="introbtn" href="<?php echo site_url('login') ?>">Reserveer nu!</a>
        <?php } ?>
      </div>
    <?php
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
        $items .= '<li class="menu-item"><a href="'. wp_logout_url() .'">Mijn profiel</a></li>';
      } else {
        $items .= '<li class="menu-item"><a href="'. wp_login_url(get_permalink()) .'">'. __("Log In") .'</a></li>'; /* needs some fixing -> when on toestellen it redirects to the last added machine */
      }
     }

     return $items;
    }

    /**
     * Add custom fields to registration form.
     */
    function kdg_fablab_registration_form() {
      $first_name = (!empty($_POST['first_name'])) ? sanitize_text_field($_POST['first_name']) : '';
      $last_name = (!empty($_POST['last_name'])) ? sanitize_text_field($_POST['last_name']) : '';
      $who_are_you = !empty($_POST['who_are_you']) ? sanitize_text_field($_POST['who_are_you']) : '';
    ?>
    <!-- user name -->
    <p id="user_name_fields">
      <label id="reg_first_name_label" for="reg_first_name">
        <?php esc_html_e('Voornaam'); ?>
        <br />
        <input type="text" name="first_name" id="reg_first_name" class="input" value="<?php echo esc_attr($first_name); ?>">
      </label>

      <label id="reg_last_name_label" for="reg_last_name">
        <?php esc_html_e('Achternaam'); ?>
        <br />
        <input type="text" name="last_name" id="reg_last_name" class="input" value="<?php echo esc_attr($last_name); ?>">
      </label>
    </p>
    <!-- end of user name-->

    <!-- who are you -->
    <p>
      <label for="reg_who_are_you">
        <?php esc_html_e('Wie ben je?') ?>
        <br />
        <select id="reg_who_are_you" name="who_are_you" class="input">
          <option value="" <?php if ($who_are_you == "") echo "selected"; ?>>-- Kiezen --</option>
          <option value="student" <?php if ($who_are_you == "student") echo "selected"; ?>>Student</option>
          <option value="bedrijf" <?php if ($who_are_you == "bedrijf") echo "selected"; ?>>Bedrijf</option>
          <option value="particulier" <?php if ($who_are_you == "particulier") echo "selected"; ?>>Particulier</option>
        </select>
      </label>
    </p>
    <!-- end of who are you -->

    <?php
    }

    /**
     * Validation custom fields registration
     */
    function kdg_fablab_registration_errors($errors, $sanitized_user_login, $user_email) {
      if (empty($_POST['first_name'])) {
        $errors->add('first_name_error', __('<strong>FOUT</strong>: Vul je voornaam in.'));
      }

      if (empty($_POST['last_name'])) {
        $errors->add('last_name_error', __('<strong>FOUT</strong>: Vul je achternaam in.'));
      }

      if (empty($_POST['who_are_you'])) {
        $errors->add('who_are_you_error', __('<strong>FOUT</strong>: Vertel me wie je bent'));
      }

      return $errors;
    }

    /**
     * Save custom date when user is being registered
     */
    function kdg_fablab_user_register($user_id) {
      if (!empty($_POST['first_name'])) {
        update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['first_name']));
      }

      if (!empty($_POST['last_name'])) {
        update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['last_name']));
      }

      if (!empty($_POST['who_are_you'])) {
        update_user_meta($user_id, 'who_are_you', sanitize_text_field($_POST['who_are_you']));

        if ($_POST['who_are_you'] !== "student") {
          add_user_meta($user_id, "VAT_number", "");
        }

        add_user_meta($user_id, "address", "");
        add_user_meta($user_id, "tel_number", "");
        add_user_meta($user_id, "postal_code", "");
        add_user_meta($user_id, "city", "");
        add_user_meta($user_id, "is_initialized", 0);
      }
    }

    /**
     * Redirect to the homepage when someone tries to access the page of an author.
     */
    function kdg_fablab_author_page_redirect() {
      if (is_author()) {
        wp_redirect(home_url());
      }
    }

    /**
     * Redirect subscribers to the home page when logging in
     */
    function kdg_fablab_redirect_to_front_end() {
      $current_user = wp_get_current_user();

      if (count($current_user->roles) == 1 && $current_user->roles[0] == "subscriber") {
        $is_user_initialized = get_user_meta(get_current_user_id(), "is_initialized", true);

        if ($is_user_initialized) {
          wp_redirect(home_url());
        } else {
          wp_redirect(site_url('/registratie'));
        }

        //wp_redirect(site_url('/'));

        // if the user hasn't filled in VAT/address/tel.num.
          // then go to additional form
        // else, the user has filled in the additional information
          // redirect to profile page

        /*echo "<pre>";
        var_dump(get_user_meta(get_current_user_id()));
        echo "</pre>";*/
        exit;
      }
    }

    /**
     * Redirect subscribers to the home page when logging in
     */
    function kdg_fablab_hide_admin_bar_sub() {
      $current_user = wp_get_current_user();

      if (count($current_user->roles) == 1 && $current_user->roles[0] == "subscriber") {
        show_admin_bar(false);
      }
    }

    /**
     * Show custom profile fields when admin is editing or looking up a profile
     */
    function kdg_fablab_show_custom_profile_fields($user) {
     ?>
     <h3><?php esc_html_e("Extra informatie"); ?></h3>
     <table class="form-table">
       <tr>
         <th>
           <label for="who_are_you"><?php esc_html_e("Wie ben je?"); ?></label>
           <td>
             <?php echo esc_html(get_the_author_meta("who_are_you", $user->ID)); ?>
           </td>
         </th>
       </tr>

       <tr>
         <th>
           <label for="address"><?php esc_html_e("Adres"); ?></label>
           <td>
             <?php echo esc_html(get_the_author_meta("address", $user->ID)); ?>
           </td>
         </th>
       </tr>

       <tr>
         <th>
           <label for="tel_number"><?php esc_html_e("Telefoonnummer"); ?></label>
           <td>
             <?php echo esc_html(get_the_author_meta("tel_number", $user->ID)); ?>
           </td>
         </th>
       </tr>

       <tr>
         <th>
           <label for="postal_code"><?php esc_html_e("Postcode"); ?></label>
           <td>
             <?php echo esc_html(get_the_author_meta("postal_code", $user->ID)); ?>
           </td>
         </th>
       </tr>

       <tr>
         <th>
           <label for="city"><?php esc_html_e("Gemeente"); ?></label>
           <td>
             <?php echo esc_html(get_the_author_meta("city", $user->ID)); ?>
           </td>
         </th>
       </tr>

       <?php if(metadata_exists("user", $user->ID, "VAT-number")) { ?>
       <tr>
         <th>
           <label for="VAT_number"><?php esc_html_e("BTW-nummer"); ?></label>
           <td>
             <?php echo esc_html(get_the_author_meta("VAT_number", $user->ID)); ?>
           </td>
         </th>
       </tr>
      <?php } ?>
     </table>
     <?php
    }

    /**
     * Generate custom rewrite rules
     */
    function kdg_fablab_custom_rewrite_rules($wp_rewrite) {
      $wp_rewrite->rules = array_merge(
        ["reserveren\/([a-z]+-[a-z]+)/?$" => 'index.php?id=$matches[1]'],
        $wp_rewrite->rules
      );
    }

    add_action("template_redirect", function() {
      $machine_id = sanitize_text_field(get_query_var('id'));

      if ($machine_id !== "") {
        include(get_template_directory() . "/templates/template-reserveren.php");
        die();
      }
    });


    function kdg_fablab_modify_user_table( $column ) {
      $column['who_are_you'] = "Wie ben je?";
      $column['address'] = 'Adres';
      $column['postal_code'] = 'Postcode';
      $column['city'] = 'Gemeente';
      $column['tel_number'] = 'Telefoonnummer';
      $column['VAT_number'] = 'BTW-nummer';

      return $column;
    }


    function kdg_fablab_modify_user_table_row( $val, $column_name, $user_id ) {
      global $wpdb;

      if ($column_name == 'who_are_you') {
        $who_are_you = $wpdb->get_var($wpdb->prepare("SELECT meta_value FROM $wpdb->usermeta WHERE meta_key = 'who_are_you' AND user_id = %s", $user_id));
        return $who_are_you;
      }

      if ($column_name == 'address') {
        $address = $wpdb->get_var($wpdb->prepare( "SELECT meta_value FROM $wpdb->usermeta WHERE meta_key = 'address' AND user_id = %s", $user_id));
        return $address;
      }

      if ($column_name == 'postal_code') {
        $postal_code = $wpdb->get_var($wpdb->prepare( "SELECT meta_value FROM $wpdb->usermeta WHERE meta_key = 'postal_code' AND user_id = %s", $user_id));
        return $postal_code;
      }

      if ($column_name == 'city') {
        $city = $wpdb->get_var($wpdb->prepare( "SELECT meta_value FROM $wpdb->usermeta WHERE meta_key = 'city' AND user_id = %s", $user_id));
        return $city;
      }

      if ($column_name == 'tel_number') {
        $tel_number = $wpdb->get_var($wpdb->prepare( "SELECT meta_value FROM $wpdb->usermeta WHERE meta_key = 'tel_number' AND user_id = %s", $user_id));
        return $tel_number;
      }

      if ($column_name == 'VAT_number') {
        $VAT_number = $wpdb->get_var($wpdb->prepare( "SELECT meta_value FROM $wpdb->usermeta WHERE meta_key = 'VAT_number' AND user_id = %s", $user_id));
        return $VAT_number;
      }

      return $val;
    }

    // do not close php tags at the end of a file
