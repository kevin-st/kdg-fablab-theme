<?php get_header(); ?>
<?php
  /*
    REMOVE THIS COMMENT

    content for generic page goes here (layout can be used accross multiple pages):
    -> e.g.
      - About us
      - Biography of an author
      - ...

    creating a custom page:
    -> https://developer.wordpress.org/themes/template-files-section/page-template-files/#creating-custom-page-templates-for-global-use
   */
?>

<main id="contactMain">

    <img id="" src="<?php echo get_theme_file_uri("img/lorenz.png"); ?>">

    <form>
        <label for="naam">Naam:</label></br>
        <input type="text" placeholder="John Doe" name="naam" required></br>

        <label for="email">E-mailadres:</label></br>
        <input type="text" placeholder="voorbeeld@hotmail.com" name="email" required></br>

        <label for="vraag">Vraag:</label></br>
        <textarea type="text" placeholder="Waar kan ik je mee helpen?" name="vraag" required></textarea></br>

        <input type="submit" value="Versturen">
    </form>

    <div style="width: 960px;position: relative;"><iframe width="960" height="440" src="https://maps.google.com/maps?width=960&amp;height=440&amp;hl=en&amp;q=Salesianenlaan%2090+(KdG%20Hoboken%20FabLab)&amp;ie=UTF8&amp;t=&amp;z=12&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div style="position: absolute;width: 80%;bottom: 10px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;text-align: center;"><small style="line-height: 1.8;font-size: 2px;background: #fff;">Powered by <a href="http://www.googlemapsgenerator.com/zh/">gmapgen zh</a> & <a href="https://huisverkopenervaringen.nl/">www.huisverkopenervaringen.nl/</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><br />

</main>

<?php
  get_footer();

  // do not close php tags at the end of a file
