<?php
  if (function_exists(array("KdGFablab_RS_Constants", "kdg_fablab_rs_reset_reservation_process"))) {
    KdGFablab_RS_Constants::kdg_fablab_rs_reset_reservation_process();
  } else {
    kdg_fablab_reset_reservation_process();
  }

  get_header();
?>
<main id="main404">
  <div class="error404 disp-f">
    <div class="img404">
      <img class="img_404" src="<?php echo get_theme_file_uri("img/iconStop.png"); ?>">
    </div>
    <div class="tekst404">
      <h1>Error 404: Pagina niet gevonden</h1>
      <p>Helaas kunnen we de pagina die u zoekt niet vinden. Dit kan komen doordat de pagina niet meer bestaat, of doordat een typefout is gemaakt bij het invoeren van het adres.</p>
    </div>
  </div>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
