<?php
//	Template Name: Photo Gallery
$pageSlug = get_page_by_path('gallery'); // contact page slug
$pageID = get_post($pageSlug->ID);
$content = $pageID->post_content;
$title = $pageID->post_title;

	$args = array(
		'numberposts' => 18,
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

	$posts = get_posts( $args );
	$galleryMode = true;

	get_header(); ?>

	<section class="section container">
		<h1 class="section__title"><?= the_title(); ?></h1>

		<div class="news-grid news-grid--big-image">
      <div class="grid news-list">

	      <?php
	      foreach($posts as $post) {
		      $format = get_post_format() ? : 'standard';
		      setup_postdata($post);

		      if ($format === 'gallery') :
			      include 'template-parts/_newsCard.php';
		      endif;
	      }
	      wp_reset_postdata(); // сброс
	      ?>

      </div>

		</div>
	</section>

<?php get_footer(); ?>
