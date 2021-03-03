<?php
//	Template Name: Information
$pageSlug = get_page_by_path('information'); // contact page slug

$pageID = get_post($pageSlug->ID);
$content = $pageID->post_content;
$title = $pageID->post_title;
global $title;

$taxonomies = get_terms('docs');

$taxDocs     = get_terms('docs');
$taxLink     = get_terms('link');
$taxPolitics = get_terms('politics');
$taxCoach    = get_terms('coach');

	get_header(); ?>

<div class="section section--headline box-shadow--big">
    <h1 class="section__title">
	    <? if ($title) {
		    echo $title;
	    } else {
		    echo post_type_archive_title();
	    }  ?>
    </h1>
</div>

<section class="section section--inform inform">
  <div class="">
	  <?php
//	  print_r($taxonomies);
	  ?>

    <div class="inform__terms grid grid-2">
      <?php //var_dump($taxDocs[0]) ?>


      <a class="inform__term-item" href="<?= get_term_link($taxDocs[0], $taxDocs[0]->taxonomy) ?>" style="background-image: url('<?= get_template_directory_uri()?>/dist/images/inform/<?php echo $taxDocs[0]->taxonomy?>.png')">
        <span>
          <span>
            <span class="inform__term-inner">
                <?php _e("Документи"); ?>
            </span>
          </span>
        </span>
      </a>
      <a class="inform__term-item" href="" style="background-image: url('<?= get_template_directory_uri()?>/dist/images/inform/link.png')">
        <span class="inform__term-inner" href="<?php //echo get_term_link($taxLink[0], $taxLink[0]->taxonomy) ?>"></span>
      </a>
      <a class="inform__term-item" href="" style="background-image: url('<?= get_template_directory_uri()?>/dist/images/inform/politics.png')">
        <span class="inform__term-inner" href="<?php //echo get_term_link($taxPolitics[0], $taxPolitics[0]->taxonomy) ?>"></span>
      </a>
      <a class="inform__term-item" href="" style="background-image: url('<?= get_template_directory_uri()?>/dist/images/inform/coach.png')">
        <span class="inform__term-inner" href="<?php //echo get_term_link($taxCoach[0], $taxCoach[0]->taxonomy) ?>"></span>
      </a>

    </div>

  </div>

	<div class="contact__content">

		<?php the_content(); ?>

	</div>

</section>

<?php include 'template-parts/_partners.php'; ?>


<?php get_footer(); ?>
