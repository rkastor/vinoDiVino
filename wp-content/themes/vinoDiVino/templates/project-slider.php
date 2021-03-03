<section class="project-slider">
  <div class="project-slider_container">
    <?php
      $args = array(
        'numberposts' => 9,
        'category'    => 0,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'include'     => array(),
        'exclude'     => array(),
        'meta_key'    => '',
        'meta_value'  =>'',
        'post_type'   => 'project',
        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
      );

      $posts = get_posts( $args );

      foreach($posts as $post){ setup_postdata($post);
        ?>
        <div class="project-slider_item">
          <a href="<?php echo get_the_post_thumbnail_url($post,'full'); ?>" class="img_gall">
            <img src="<?php echo get_the_post_thumbnail_url($post,'large'); ?>" class="project-slider_item-image" alt="">
          </a>
          <!-- <a class="project-slider_item-content">
            <p class="project-slider_item-content-title"><?php echo esc_html( get_the_title() ); ?></p>
          </a> -->
        </div>
        <?php
      }

      wp_reset_postdata(); // сброс
    ?>

    <?php
      // the_posts_pagination( array(
      //   'prev_text'          => __( 'Previous page' ),
      //   'next_text'          => __( 'Next page' ),
      //   'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'CSKA' ) . ' </span>',
      // ) );
     ?>
    <!-- <div class="project-slider_item other">
      <img class="project-slider_item-image img_gall" src="/wp-content/uploads/2018/02/slide_built-in.jpg">
      <a href="/projects" class="project-slider_item-content">
        <p class="project-slider_item-content-title">Другие работы..</p>
      </a>
    </div> -->
  </div>
  <div class="project-slider_nav-dot"></div>
  <div class="project-slider_nav-arrows"></div>

  <!-- The Modal -->
  <div id="gallery-md" class="modal">
    <!-- The Close Button -->
    <span class="close">&times;</span>
    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img01" />
    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
  </div>
</section>
