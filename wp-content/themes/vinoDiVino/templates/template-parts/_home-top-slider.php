<?php 
    $args = array(
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

    if (count($posts) > 0) :
?>

<section class="slider-top swiper-container">
    <div class="slider-top__container swiper-wrapper">
    <?php
        foreach($posts as $post){ setup_postdata($post);
        $btn = get_post_meta($post->ID, 'settings_url', 1 ) != '' ? '<a class="slider-top_item-content-link" href="'.get_post_meta($post->ID, 'settings_url', 1 ).'">Подробнее</a>' : '';
        ?>
            <div class="slider-top__item overflow-sh swiper-slide">
                <div class="slider-item__poster" style="background:url('<?php echo get_the_post_thumbnail_url($post,'full'); ?>') top center no-repeat;background-size: cover;"></div>
                <div class="slider-item__content">
                    <p class="slider-item__content-title"><?php echo esc_html( get_the_title() ); ?></p>
                    <p class="slider-item__content-discription"><?php echo get_post_field('post_content', $post->ID); ?></p>
                    <?php echo $btn; ?>
                </div>
            </div>
        <?php
        }

        wp_reset_postdata(); // сброс
    ?>
    </div>
    <div class="slider-top__nav-dot"></div>
    <div class="slider-top__nav-arrows"></div>
</section>

<?php endif; ?>