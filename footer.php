    <footer>
      <?php /* footer content goes here */ ?>
      <div id="adres">
        <h2>Adres</h2>
        <div class="adrestext">
          <h1>KdG Fablab</h1>
          <p>Salesianenlaan 90</p>
          <p>2660 Hoboken</p>
        </div>
      </div>
      <div class="openingsuren disp-f">
        <div class="opening">
          <h2>Openingsuren</h2>
          <ul>
          <?php
            $opening_hours = get_option('kdg_fablab_rs_opening_hours');

            foreach($opening_hours as $opening_hour => $opening_hour_value) {
          ?>
            <li>
              <?php
                echo (date_i18n("l", strtotime($opening_hour)));

                if (isset($opening_hour_value["is_closed"])) {
              ?>
              <span>Gesloten</span>
              <?php
                } else {
              ?>
              <span><?php echo $opening_hour_value["start"]; ?> - <?php echo $opening_hour_value["end"]; ?></span>
              <?php
                }
              ?>
            </li>
          <?php
            }
          ?>
          </ul>
        </div>
      </div>
      <div id="socials" class="disp-f" >
        <div>
          <h2>Social Media</h2>
          <a href="https://www.facebook.com/kareldegrotehogeschool/">
            <img src="<?php echo get_theme_file_uri("img/fbWhite2.png"); ?>" alt="facebook icon">
          </a>
          <a href="https://www.instagram.com/kdghogeschool/?hl=nl">
            <img src="<?php echo get_theme_file_uri("img/igWhite.png"); ?>" alt="instagram icon">
          </a>
        </div>

      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
