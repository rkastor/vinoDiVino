<?php
    $args = array(
    'numberposts' => 6,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'include'     => array(),
    'exclude'     => array(),
    'meta_key'    => '',
    'meta_value'  =>'',
    'post_type'   => 'post',
    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
    );

    $posts = get_posts( $args );?>


<section class="section news-grid news-grid--big-image">

    <div class="container">

        <div class="section__title">
            Новини та події
        </div>

        <div class="grid news-list">
            <?php foreach($posts as $post){ setup_postdata($post);
                include '_newsCard.php';
            }

            wp_reset_postdata(); // сброс
            ?>
        </div>

    
    </div>
 

</section>