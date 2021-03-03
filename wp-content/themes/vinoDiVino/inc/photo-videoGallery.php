<?php

	// Add the Meta Box



//Додайте зображення до галереї.</i><br><b>ПРАЦЮЄ ТІЛЬКИ НА СТОРІНЦАХ ПОСТІВ З ПОМІТКОЮ "ГАЛЕРЕЯ"

add_filter( 'rwmb_meta_boxes', 'prefix_register_meta_boxes' );

function prefix_register_meta_boxes( $meta_boxes ) {

	$meta_boxes[] = array(

		'title'      => 'Добавление Медиа-файлов',
		'post_types' => 'sobytie',
		'context'    => 'after_editor',
		'autosave'   => true,



		'fields' => array(
			array(
				'label'          => 'Gallery Images',
				'desc'           => 'Добавляйте новые фото в галерею перетянув их сюда или через кнопку',
				'id'             => 'gallery',
				'type'           => 'image_upload',
				'multiple'       => true,
				'add_button'     => 'Добавить',
				// 'before'         => '<p style="font-size: 14px; font-weight: 500; margin-bottom: 10px; margin-top: 0;">Галерея фотозвітів.<br><b>ПРАЦЮЄ ЛИШЕ ЗІ СТОРІНКАМИ ТИПУ "ГАЛЕРЕЯ"!</b></p>'
			),

			array(
				'id'               => 'video',
				'desc'             => 'Добавьте ссылку на видео с любого ресурса(Ютуб и т.д)',
				'name'             => 'Ссылка',
//				'label_description'=> '123',
//				'type'             => 'video',
//				'max_file_uploads' => 3,
				'type'             => 'url',
				'placeholder'      => 'https://youtube.com/.....',
				'clone'            => true,
				// 'before'           => '<hr>
				// 	<!--p style="font-size: 16px; font-weight: 500; padding-bottom: 0; margin-bottom: 0;">Додайте відео через кнопку нижче. Не більше трьох!</p-->
				// 	<p style="font-size: 14px; font-weight: 500; margin-bottom: 10px; margin-top: 0;">ПРАЦЮЄ ЛИШЕ ЗІ СТОРІНКАМИ ТИПУ "ВІДЕО"!</p>
				// 	',
				'force_delete'     => false,
				'max_status'       => true,
			),
		)
	);



	// Add more meta boxes if you want

	// $meta_boxes[] = ...



	return $meta_boxes;

}