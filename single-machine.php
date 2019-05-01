<?php get_header() ?>
<?php
  /*
    used for displaying a single post

    in this case: a post with type of machine
  */
?>
<main class="detail ">
  <?php
    while(have_posts()) {
      the_post();
      $title = strtolower(str_replace(" ", "-", get_the_title()));
  ?>
  <div role="breadcrumbs" class="breadcrumbs">
    <a href="<?php echo site_url('/toestellen/'); ?>">Toestellen</a>
    > <?php strtolower(the_title()) ?>
  </div>

  <div class="contentdetail">
    <div role="thumbnail" class="thumbnail">
      <?php
        if (has_post_thumbnail()) {
          echo the_post_thumbnail();
        } else {
      ?>
      <img src="<?php echo get_theme_file_uri("img/default_machine.jpg"); ?>" alt="machine"/>
      <?php
        }
      ?>
    </div>
    <div class="opdeling">
      <h1 role="title" class="title"><?php the_title(); ?></h1>

    <div role="content" class="content">
      <p><?php the_content(); ?></p>
    </div>
    <div role="button" class="detailBtn">
      <!-- url fix redirect when not logged in -->
      <a class="btn btn-dark " href="<?php
        $redirect_to = esc_url(add_query_arg("id", $title, site_url('/reserveren/')));
        if (is_user_logged_in()) {
          // redirect to reservation page
          echo $redirect_to;
        } else {
          echo esc_url(add_query_arg("redirect_to", $redirect_to, wp_login_url()));
        }
      ?>">Reserveer dit toestel!</a> <!-- Moet nog nagekeken worden, reservatie plugin -->
      <a class="btn btn-dark " href="<?php echo get_post_type_archive_link("machine"); ?>">Terug naar toestellen</a>
    </div>
    </div>
  </div>

  <?php
    }
  ?>
</main>
<?php
  get_footer();

  // do not close php tags at the end of a file
