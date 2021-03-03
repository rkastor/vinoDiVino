<?php
  $format = get_post_format() ? : 'standard';
?>

<div class="card">
	<a class="card__thumb" href="<?php the_permalink(); ?>">
    <?php if ($format !== 'standard') : ?>
      <span class="card__post-format post-format--<?=$format; ?>">
      </span>
		<?php endif;
		if (get_the_post_thumbnail_url()) :
			echo '<img src="' . get_the_post_thumbnail_url() .'" alt="' . get_the_title() . '">';
		else :
			echo '<img src="' . get_template_directory_uri() . '/dist/images/placeholder.jpg" alt="' . get_the_title() . '">';
		endif; ?>
	</a>
	<div class="card__info">
		<div>
			<?php foreach (get_the_category() as $category) {
				echo '<a class="card__category" href="/' . $category->slug . '">' . $category->cat_name . '</a>';
			}
			?>
		</div>

		<a class="card__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p class="card__date"><?php echo get_the_date() ?></p>
	</div>
</div>