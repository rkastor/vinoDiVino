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

<section class="slider-top">
    <div class="slider-top_container">
    <?php
        foreach($posts as $post){ setup_postdata($post);
        $btn = get_post_meta($post->ID, 'settings_url', 1 ) != '' ? '<a class="slider-top_item-content-link" href="'.get_post_meta($post->ID, 'settings_url', 1 ).'">Подробнее</a>' : '';
        ?>
            <div class="slider-top_item overflow-sh" style="background:url('<?php echo get_the_post_thumbnail_url($post,'full'); ?>') top center no-repeat;background-size: cover;">
            <div class="slider-top_item-content">
                <p class="slider-top_item-content-title"><?php echo esc_html( get_the_title() ); ?></p>
                <p class="slider-top_item-content-discription"><?php echo get_post_meta($post->ID, 'settings_description', 1 ); ?></p>
                <?php echo $btn; ?>
            </div>
            </div>
        <?php
        }

        wp_reset_postdata(); // сброс
    ?>
    </div>
    <div class="slider-top_nav-dot"></div>
    <div class="slider-top_nav-arrows"></div>
</section>

<?php endif; ?>