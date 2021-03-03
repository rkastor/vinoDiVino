<?php
get_header(); ?>

	<section class="content-area container">

		<?php while ( have_posts() ) : the_post(); ?>

        <div class="content-area_content">
          <?php the_content(); ?>
        </div>
        <!-- .content__area -->

			<?php endwhile; ?>
	</section><!-- .content-area -->

<?php get_footer(); ?>
