<?php
// Template name: 404
  $pageClass = 'not-found';
  $pageTitle = "404";
 ?>
<?php get_header(); ?>

  <section class="section section--<?= $pageClass; ?> flex flex--center">
    <div class="container not-found text">
      <h1 class="section__title mb-20">Страница не найдена</h1>

	    <?php the_content(); ?>

      <p>Извините, данная страница недоступна или ее нету на сайте.</p>
      <p> <a onclick="history.back();" class="link_back">Вернутся на предыдущую страницу?</a> </p>
    </div>
  </section>



<?php get_footer(); ?>
