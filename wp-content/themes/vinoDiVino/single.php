<?php

$format = get_post_format() ? : 'standard';

get_header(); ?>

	<section class="content-area container pt-40">

		<?php while ( have_posts() ) : the_post(); ?>

					<h1 class="section__title"><?php the_title(); ?></h1>
					<br>

					<div class="content-area_content">
						<?php the_content(); ?>
					</div><!-- .content__area -->

        <?php if ($format === 'gallery') :
          $images = rwmb_meta( $format, array( 'size' => 'thumbnail' ) ); ?>
          <div class="gallery-container gallery__preview swiper-container">
            <div class="swiper-wrapper text-center">
              <?php foreach ( $images as $image ) : ?>
              <div class="swiper-slide">
                <img src="<?= $image['full_url'] ?>" data-src="<?= $image['full_url'] ?>" alt="" class="gallery-container__img">
              </div>
              <?php endforeach; ?>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>
          <div class="gallery-container gallery__thumb swiper-container mb-50">
            <div class="swiper-wrapper text-center">
              <?php foreach ( $images as $image ) : ?>
              <div class="swiper-slide">
                <img src="<?= $image['url'] ?>" data-src="<?= $image['full_url'] ?>" alt="" class="gallery-container__img">
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php elseif ($format === 'video') :
			    $videos = rwmb_meta( $format );
//          var_dump($videos);
          if (count($videos) > 1) :
            $videoList= ' grid-table';
          endif;
        ?>
          <div class="video video--container mb-50<?= $videoList ?>">
          <?php foreach ( $videos as $video ) :
            $video  = preg_replace('/[^A-Za-z0-9\-]/', ' ', $video);
	          $last_word_start = strrpos($video, ' ') + 1;
	          $video = substr($video, $last_word_start);
              ?>
            <div class="video__block">
              <img src="http://i3.ytimg.com/vi/<?= $video ?>/maxresdefault.jpg" alt="" class="video__poster" rel="nofollow">
              <div class="video__wrapper">
	              <? // echo $video; ?>
                <div class="modal__shadow"></div>
                <iframe class="video__item" src="//www.youtube.com/embed/<?= $video ?>" frameborder="0" width="100%" height="400" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            </div>
          <?php endforeach ?>
          </div>
        <?php endif; ?>

			<?php endwhile; ?>
	</section><!-- .content-area -->

<?php get_footer(); ?>
