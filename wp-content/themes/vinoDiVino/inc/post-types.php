<?php

add_action( 'init', 'new_post_types' );
function new_post_types() {

	// partners
	register_post_type('sobytie', array(
		'label'               => 'События',
		'labels'              => array(
			'name'          => 'События',
			'singular_name' => 'Событие',
			'menu_name'     => 'События',
			'all_items'     => 'Все события',
			'add_new'       => 'Добавить',
			'add_new_item'  => 'Добавить событие',
			'edit'          => 'Редактировать',
			'edit_item'     => 'Редактировать событие',
			'new_item'      => 'Новое событие',
		),
		'description'         => 'Последние или будущие события с галереей внутри (если понадобится) ',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug'=>'sobytie', 'with_front'=>false, 'pages'=>false, 'feeds'=>true, 'feed'=>true ),
		'has_archive'         => 'sobytiya',
		'query_var'           => true,
		'supports' => array('title', 'thumbnail', 'editor', 'revisions'),
		'menu_icon' => 'dashicons-format-gallery'
	) );

	// Home top slider
	register_post_type('slider_top', array(
		'label'               => 'Слайдер на главной',
		'labels'              => array(
			'name'          => 'Слайды',
			'singular_name' => 'Слайд',
			'menu_name'     => 'Слайдер на главной',
			'all_items'     => 'Все слайды',
			'add_new'       => 'Добавить слайд',
			'add_new_item'  => 'Добавить новый слайд',
			'edit'          => 'Редактировать',
			'edit_item'     => 'Редактировать слайд',
			'new_item'      => 'Новый слайд',
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'show_in_menu'        => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array( 'slug'=>'slider_top', 'with_front'=>false, 'pages'=>false, 'feeds'=>true, 'feed'=>true ),
		'has_archive'         => 'cats',
		'query_var'           => true,
		'supports' => array('title', 'thumbnail', 'editor'),
		'menu_icon' => 'dashicons-images-alt'
	) );

};

// Taxonomies
print apply_filters( 'taxonomy-images-queried-term-image', '' );
add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){

// 	// taxonomy for Information. Books
// 	register_taxonomy( 'docs', [ 'information' ], [
// 		'label'                 => 'Документы',
// 		'labels'                => [
// 			'name'              => 'Документы',
// 			'singular_name'     => 'Документ',
// 			'search_items'      => 'Найти Документ',
// 			'all_items'         => 'Всі Документы',
// 			'view_item '        => 'Посмотреть Документ',
// //			'parent_item'       => 'Информация',
// //			'parent_item_colon' => 'До всіх типів інформації',
// 			'edit_item'         => 'Edit Документ',
// 			'update_item'       => 'Update Документ',
// 			'add_new_item'      => 'Add New Документ',
// 			'new_item_name'     => 'New Документ',
// 			'menu_name'         => 'Документы',
// 		],
// 		'public'                => true,
// 		'hierarchical'          => true,

// 		'rewrite'               => true,
// 		//'query_var'             => $taxonomy, // название параметра запроса
// 		'capabilities'          => array(),
// 		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
// 		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
// 		'show_in_rest'          => null, // добавить в REST API
// 		'rest_base'             => null, // $taxonomy
// 		'menu_icon'             => 'dashicons-book'
// 		// '_builtin'              => false,
// 		//'update_count_callback' => '_update_post_term_count',
// 	] );
	
}


add_filter('template_include', 'templates');
function templates( $template ) {

	global $post;
//	if( is_home() ){
//		$template = get_stylesheet_directory() . '/templates/page-home.php';
//	};
// ____________________________________________________________
	if( is_singular('sobytie') || is_tax() ) {
		$template = get_stylesheet_directory() . '/templates/page-sobytie_single.php';
	}
// ____________________________________________________________
	elseif( is_post_type_archive('sobytie') ){
		$template = get_stylesheet_directory() . '/templates/page-sobytie.php';
	}
// ____________________________________________________________
	// if( is_tax() ){
	// 	$template = get_stylesheet_directory() . '/templates/sobytie.php';
	// }
//	// ____________________________________________________________
	elseif (is_archive() && $post->post_type == 'post' ) {
		$template = get_stylesheet_directory() . '/index.php';
	}
	// ____________________________________________________________
	if( is_search()){
		$template = get_stylesheet_directory() . '/templates/page-search.php';
	}
	if( is_404()){
		$template = get_stylesheet_directory() . '/templates/page-404.php';
	}

	return $template;

}

function get_the_cats( $id = 0, $cat ) {
	$tags = apply_filters( 'get_the_cats', get_the_terms( $id, $cat ) );
	$html = '';
  if ($tags) {
    foreach ($tags as $tag){
      $tag_link = get_tag_link($tag->term_id);
      $html .= $tag->name.', ';
    }
    $html = substr($html, 0, -2);
  }
	echo $html;
}

function information( $id = 0 ) {
	$tags = apply_filters( 'sobytie', get_the_terms( $id, 'sobytie' ) );
	$html = '';
  if ($tags) {
    foreach ($tags as $tag){
      $tag_link = get_tag_link($tag->term_id);
      $html .= $tag->term_taxonomy_id;
    }
  }
	return $html;
}

?>
