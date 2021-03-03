<div class="slider-top swiper-container">
  <div class="slider-top__container swiper-wrapper">
    <?php
      /*$args = array(
        'numberposts' => 5,
        'category'    => 0,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'include'     => array(),
        'exclude'     => array(),
        'meta_key'    => '',
        'meta_value'  =>'',
        'post_type'   => 'slider_top',
        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
      );

      $posts = get_posts( $args );

      foreach($posts as $post){ setup_postdata($post);
        $btn = get_post_meta($post->ID, 'settings_url', 1 ) != '' ? '<a class="slider-top__link" href="'.get_post_meta($post->ID, 'settings_url', 1 ).'">Подробнее</a>' : '';
        */?>
          <div id="scene" class="slider-top__item overflow-sh swiper-slide">
            <div class="slider-top__bg" data-parallax="scroll" data-image-src="<? if (has_post_thumbnail()) { echo get_the_post_thumbnail_url($id,'full'); } else { echo "/wp-content/themes/Energy/assets/images/628.jpg"; } ?>" style="/*background:url('<? if (has_post_thumbnail()) { echo get_the_post_thumbnail_url($id,'full'); } else { echo "/wp-content/themes/Energy/assets/images/628.jpg"; } ?>') top center no-repeat;*/" data-depth="0.50"></div>
            <div class="slider-top__content container">
              <p class="slider-top__title"><?php single_post_title(); ?></p>
              <p class="slider-top__desc"><?php echo get_post_meta($post->ID, 'settings_description', 1 ); ?></p>
              <?php echo $btn; ?>
            </div>
          </div>
        <?php/*
      }

      wp_reset_postdata(); // сброс 
    */?>
  </div>
  <div class="slider-top_nav-dot"></div>
  <div class="slider-top_nav-arrows"></div>
</div>
