<?php

/**

 * Template Name: About Page

 */



get_header(); ?>


<div class="about-page container-fluid">

  <div class="container сontent">



    <h1 class="sub-title text-center">• <?php the_title(); ?> •</h1>



    <div class="col-xs-12 col-md-12">

      <?php the_content(); ?>

    </div>





    <!-- The Modal -->

  <div id="gallery-md" class="modal">

    <!-- The Close Button -->

    <span class="close">&times;</span>

    <!-- Modal Content (The Image) -->

    <img class="modal-content" id="img01" />

    <!-- Modal Caption (Image Text) -->

    <div id="caption"></div>

  </div>

</div>





<!-- <div class="about-page_project projects row">

  <p class="sub-title text-center">Последние проекты</p>



  <?php/* include('project-slider.php'); */?>

</div> -->



</div>



<?php get_footer(); ?>

