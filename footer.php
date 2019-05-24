    <footer>
      <?php /* footer content goes here */ ?>
      <div id="adres">
        <h2>Adres</h2>
        <h1>KdG Fablab</h1>
        <p>Salesianenlaan 90</p>
        <p>2660 Hoboken</p>
      </div>
      <div class="openingsuren">
        <h2>Openingsuren</h2>
        <?php $openinghours = get_option('kdg_fablab_rs_opening_hours');
        var_dump($openinghours);
        ?>
        <ul>
          <li>lalala</li>
          <li>lololo</li>
        </ul>
      </div>
      <div id="socials">
        <h2>Social Media</h2>
        <a href="https://www.facebook.com/kareldegrotehogeschool/">
          <img src="<?php echo get_theme_file_uri("img/fbWhite2.png"); ?>" alt="facebook icon">
        </a>
        <a href="https://www.instagram.com/kdghogeschool/?hl=nl">
          <img src="<?php echo get_theme_file_uri("img/igWhite.png"); ?>" alt="instagram icon">
        </a>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
