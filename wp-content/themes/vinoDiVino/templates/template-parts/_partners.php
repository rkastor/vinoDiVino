<?php
  $args = array(
    'numberposts' => 5,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'include'     => array(),
    'exclude'     => array(),
    'meta_key'    => '',
    'meta_value'  => '',
    'post_type'   => 'partner',
    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
  );
  $posts = get_posts( $args );
?>
<? if (!empty($posts)) : ?>
<section class="section partners">
	<div class="container">
		<div class="section__title text-center mb-40">
			Наші партнери
		</div>

		<div class="partners__block text-center flex flex--justify-around flex--3">
      <?php
      foreach($posts as $post) {
	      setup_postdata($post); ?>
        <a class="partners__item" href="<?php get_post_meta($post->ID, 'settings_url', 1) ?>" rel="nofollow" target="_blank">
          <?php
          if (has_post_thumbnail()) :
            echo '<img class="partners__img" src="'. get_the_post_thumbnail_url() .'" alt="'. get_the_title() .'" title="'. get_the_title() .'">';
          else :
            echo '<img class="partners__img" src="' . get_template_directory_uri() . '/dist/images/placeholder.jpg" alt="' . get_the_title() . '" title="'. get_the_title() .'">';
          endif; ?>
        </a>
	      <?php
      }
      wp_reset_postdata(); // сброс
      ?>
		</div>
	</div>
</section>
<? endif; ?>