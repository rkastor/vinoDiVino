<?php
// Single Information page
$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
$pageClass = "inform";

$args = array(
	'numberposts' => 9,
	'orderby'     => 'date',
	'order'       => 'DESC',
	'include'     => array(),
	'post_type'   => 'information',
	'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
	'tax_query' => array(
		array(
			'taxonomy' => $term->taxonomy,
      'field' => 'slug',
      'terms' => $term->slug
		)
	)
);

$posts = get_posts( $args );
get_header(); ?>

  <div class="section section--headline">
    <h1 class="section__title">
      <?php
      echo $term->name;
      ?>
    </h1>
  </div>
	<section class="section">

	  <?php
	  var_dump($term);
	  ?>


    <div class="flex flex--justify-between flex--wrap">
      <?php if ($term->count > 1) : ?>
      <div class="inform__navigation">


      </div>
      <?php endif; ?>

      <div class="inform__content">

        <div class="container">
	        <?php
	        foreach($posts as $post) {
		        setup_postdata($post) ?>
		        <?php var_dump($post->post_title); ?>
	        <?php  }
	        wp_reset_postdata(); // сброс
	        ?>
        </div>
      </div>

    </div>
	</section>

<?php get_footer(); ?>
