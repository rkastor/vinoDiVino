<?php

include('inc/metabox.php');
include('inc/post-types.php');
// include('inc/thumbnails.php');
include('inc/theme-options.php');
include('inc/photo-videoGallery.php');
include('inc/taxonomyImages.php');

add_theme_support('post-thumbnails');

add_theme_support('post-formats', array('aside', 'gallery', 'video', 'chat'));
if (version_compare($GLOBALS['wp_version'], '4.1-alpha', '<')) {
	require get_template_directory() . '/inc/back-compat.php';
}

add_action('after_setup_theme', 'theme_register_nav_menu');

function theme_register_nav_menu()
{
	register_nav_menu('main', 'Main menu');
	register_nav_menu('menu-advanced', 'Footer Menu advanced');
	register_nav_menu('menu-information', 'Footer Menu information');
}

add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function special_nav_class($classes, $item)
{
	if (in_array('current-menu-item', $classes)) {
		$classes[] = 'active ';
	}
	return $classes;
}


/**
 * Enqueue scripts and styles.
 */

function theme_styles()
{
	wp_enqueue_style('style', get_stylesheet_uri());
	// wp_enqueue_style( 'slick', get_template_directory_uri().'/css/slick.css' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/dist/font/fontawesome/css/all.css' );
	// wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/css/slick-theme.css' );
	// wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css' );
	wp_enqueue_style('style-vendor', get_template_directory_uri() . '/dist/css/vendor.min.css');
	wp_enqueue_style('style-main', get_template_directory_uri() . '/dist/css/style.min.css?v1' . rand(100, 999));

}

add_action('wp_enqueue_scripts', 'theme_styles');


// My custom icons upload to theme
function wmpudev_enqueue_icon_stylesheet()
{
	// wp_register_style( 'fontawesome', get_template_directory_uri().'/css/font-awesome.min.css' );
}
add_action('wp_enqueue_scripts', 'wmpudev_enqueue_icon_stylesheet');
add_action('wp_enqueue_scripts', 'my_scripts_method');

function my_scripts_method()
{
	wp_deregister_script('jquery');
	// wp_register_script( 'jquery', '//code.jquery.com/jquery-2.2.4.min.js');
	wp_enqueue_script('jquery');
}


add_action('wp_footer', 'theme_scripts');


function theme_scripts()
{
	// wp_enqueue_script( 'slick-js', get_template_directory_uri().'/js/slick.min.js' );
	// wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js' );
	// wp_enqueue_script( 'functions', get_template_directory_uri() . '/js/functions.js' );
	wp_enqueue_script('vendors', get_template_directory_uri() . '/dist/js/libs.min.js');
	wp_enqueue_script('main', get_template_directory_uri() . '/dist/js/main.min.js');
	// wp_enqueue_script( 'paralax', get_template_directory_uri() . '/js/parallax.js' );
}


// icon for menu

add_filter('menu_image_default_sizes', function ($sizes) {
	// remove the default 36x36 size
	unset($sizes['menu-36x36']);
	// add a new size
	$sizes['menu-50x50'] = array(50, 50);
	// return $sizes (required)
	return $sizes;
});


function themename_custom_logo_setup()
{
	$defaults = array(
		'height' => 100,
		'width' => 250,
		'flex-height' => true,
		'flex-width' => true,
		'header-text' => array('site-title', 'site-description'),
	);
	add_theme_support('custom-logo', $defaults);
}

add_action('after_setup_theme', 'themename_custom_logo_setup');


// featured img of pages

function page_featured_image()
{

	//Execute if singular

	if (is_singular()) {

		$id = get_queried_object_id();
		// Check if the post/page has featured image
		if (has_post_thumbnail($id)) {
			// Change thumbnail size, but I guess full is what you'll need
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($id), 'full');
			$url = $image[0];
		} else {
			//Set a default image if Featured Image isn't set
			$url = '';
		}
	}
	return $url;
}


// excerpt text limit
function excerpt($limit)
{
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt) . '...';
	} else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
	return $excerpt;
}

// content text limit
function content($limit)
{
	$content = explode(' ', get_the_content(), $limit);
	if (count($content) >= $limit) {
		array_pop($content);
		$content = implode(" ", $content) . '...';
	} else {
		$content = implode(" ", $content);
	}
	$content = preg_replace('/[.+]/', '', $content);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;

}


class_exists('Kama_Post_Meta_Box') && new Kama_Post_Meta_Box(array(
	'id' => 'settings',
	'title' => 'Настройки',
	'post_type' => 'partner',
	'fields' => array(
		'description' => array(
			'type' => 'text', 'title' => 'Підпис кнопки', 'desc' => '', 'attr' => 'style="width:99%;"'
		),
		'url' => array(
			'type' => 'text', 'title' => 'URL кнопки', 'desc' => '', 'attr' => 'style="width:99%;"'
		),
	),
));


function arphabet_widgets_init()
{
	register_sidebar(array(
		'name' => 'Foter Widget Area',
		'id' => 'footer_widhet-area_contact',
		'before_widget' => '<div class="footer__col footer__col--widget">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer_title">',
		'after_title' => '</p>',
	));
}

add_action('widgets_init', 'arphabet_widgets_init');

function after($this, $inthat)
{
	if (!is_bool(strpos($inthat, $this)))
		return substr($inthat, strpos($inthat,$this)+strlen($this));
}
function after_last($this, $inthat)
{
	if (!is_bool(strrevpos($inthat, $this)))
		return substr($inthat, strrevpos($inthat, $this)+strlen($this));
}



