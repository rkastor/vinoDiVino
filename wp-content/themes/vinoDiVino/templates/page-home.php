<?php

//  Template name: Home page

  $pageClass = "home";
  $pageSlug = get_page_by_path('home'); // contact page slug
  $pageID = get_post($pageSlug->ID);
  $content = $pageID->post_content;
  $title = $pageID->post_title;

 ?>

<?php get_header(); ?>

    <? // home slider  ?>
    <?php include 'template-parts/_home-top-slider.php'; ?>


<?php get_footer(); ?>

