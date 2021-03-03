<?php

/*

 *

 * Template name: Portfolio page

 *

*/
  $pageClass = "portfolio";



  wp_reset_postdata();

  $this_post = $post->ID;

  $this_cat = projects_id($post->ID);

  $paged = get_query_var( 'project' ) ? get_query_var( 'project' ) : false;



  get_header();

?>



<div class="projects-block">

  <h1 class="title text-center"><?php the_title() ?></h1>

  <div class="col-xs-12 projects-block_items">

    <?php





    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $loop = new WP_Query(

          array(

              'post_type' => 'project',

              'posts_per_page' => 9,

              'paged'=>$paged

          )

      );



      if ($loop->have_posts()): while ($loop->have_posts()) : $loop->the_post();

        ?>

      <div class="projects-block_item col-md-4 col-xs-12">

        <!-- <a href="<?php echo get_permalink(); ?>"> -->

          <a href="<?php echo get_the_post_thumbnail_url($post,'full'); ?>" class="img_gall">

            <img src="<?php echo get_the_post_thumbnail_url($post,'large'); ?>" alt="">

          </a>

          <span class="projects_item-title"><?php echo get_the_title(); ?></span>

        <!-- </a> -->

      </div>

      <?php

      endwhile; endif;

    ?>



    <ul class="col-xs-12 text-center projects_pag pagination">

        <li class="page-numbers"><?php previous_posts_link( '&laquo; Назад', $loop->max_num_pages) ?></li>

        <li class="page-numbers"><?php next_posts_link( 'Дальше &raquo;', $loop->max_num_pages) ?></li>

    </ul>

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

<?php get_footer(); ?>

