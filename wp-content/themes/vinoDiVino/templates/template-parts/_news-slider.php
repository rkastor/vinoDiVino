<?php
    $args = array(
    'numberposts' => 4,
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

<section class="news-slider">

    <div class="container">
    
        <div class="news-slider__preview swiper-container news-list">

            <div class="swiper-wrapper">

                <?php foreach($posts as $post){ setup_postdata($post);?>
                <div class="swiper-slide">
                    <div class="card">
                        <div class="card__info">
                            <?php foreach (get_the_category() as $category) {
                              echo '<a class="card__category" href="/' . $category->slug . '">' . $category->cat_name . '</a>';
                            } ?>

                            <span class="card__title"><?php the_title(); ?></span>
                            <p class="card__date"><?php echo get_the_date() ?></p>
                            <a class="card__btn btn" href="<?php the_permalink(); ?>">Переглянути</a>
                        </div> 
                        <div class="card__thumb">
                            <?php if (get_the_post_thumbnail_url()) :
                                echo '<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">';
                            else :
                                echo '<img src="' . get_template_directory_uri() . '/dist/images/placeholder.jpg" alt="' . the_title() . '">';
                            endif; ?>
                        </div>
                    </div>
                </div>
                    <?php
                }

                wp_reset_postdata(); // сброс
                ?>
            </div>

            <div class="swiper-pagination"></div>
        </div>

    


        <div class="news-slider__thumb swiper-container news-list">

            <div class="swiper-wrapper">
                
                <?php foreach($posts as $post){ setup_postdata($post);?>
                <div class="swiper-slide">
                    <div class="card">
                        <div class="card__info">
                            <?php foreach (get_the_category() as $category) {
                              echo '<a class="card__category" href="/' . $category->slug . '">' . $category->cat_name . '</a>';
                            } ?>

                            <a class="card__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <p class="card__date"><?php echo get_the_date() ?></p>
                        </div>
                        <div class="status-bar"></div>
                    </div>
                </div>
                <?php
                }

                wp_reset_postdata(); // сброс
                ?>
            </div>
        </div>
    </div>


</section>
