<?php
get_header();
$pageClass = "news";
?>

<section class="section news-grid news-grid--big-image">
  <div class="container">

	  <?php if (is_home() && !is_front_page()) : ?>
        <h1 class="h1 section__title">
			<?php
			if (single_post_title()) :
				single_post_title();
            elseif (single_cat_title()) :
				single_cat_title();
			endif;
			?>
        </h1>
	  <?php else : ?>
        <h1 class="h1 section__title">
			<?php
			single_cat_title();
			?>
        </h1>
	  <?php endif; ?>

    <div class="news__post-types">

    </div>

    <div class="grid news-list">

		<?php if (have_posts()) : ?>

		<?php
		// Start the loop.
		while (have_posts()) : the_post();

		  include 'templates/template-parts/_newsCard.php';

			// End the loop.
		endwhile; ?>
    </div>
    <div class="text-center w-100 rel">
		<?php // Previous/next page navigation.
		the_posts_pagination(array(
			'prev_text' => __('Previous page'),
			'next_text' => __('Next page'),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'CSKA') . ' </span>',
		));
		// If no content, include the "No posts found" template.
		else :?>

          <p>Поки що на цій сторінці немає актуальних записів. Можливо, вони з'являться в майбутньому</p>

          <p>
            <a href="#0" onclick="history.back();" class="link_back">Повернутися на попередню сторінку?</a>
          </p>
		<? endif;
		?>

    </div>

  </div>
</section>

<?php get_footer(); ?>
