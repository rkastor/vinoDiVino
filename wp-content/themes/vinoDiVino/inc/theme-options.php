<?php
	add_action('admin_menu', 'add_plugin_page');
	function add_plugin_page(){
		add_options_page( 'Контактная информация', 'Контакты', 'manage_options', 'theme_settings', 'options_page_output' );
	}

	function options_page_output(){
		?>
		<div class="wrap">
			<h2><?php echo get_admin_page_title() ?></h2>

			<form action="options.php" method="POST">
				<?php
					settings_fields( 'option_group' );     // скрытые защитные поля
					do_settings_sections( 'options' ); // секции с настройками (опциями). У нас она всего одна 'section_1'
					submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Регистрируем настройки.
	 * Настройки будут храниться в массиве, а не одна настройка = одна опция.
	 */
	add_action('admin_init', 'plugin_settings');
	function plugin_settings(){
		// параметры: $option_group, $settings, $sanitize_callback
		register_setting( 'option_group', 'settings', 'sanitize_callback' );

		// параметры: $id, $title, $callback, $page
		add_settings_section( 'section_1', 'Основные настройки', '', 'options' );

		// параметры: $id, $title, $callback, $page, $section, $args
		add_settings_field('primer_field1', 'Телефон 1', 'fill_primer_field1', 'options', 'section_1' );
		// add_settings_field('primer_field2', 'Телефон 2', 'fill_primer_field2', 'options', 'section_1' );
		// add_settings_field('primer_field3', 'Телефон 3', 'fill_primer_field3', 'options', 'section_1' );
		add_settings_field('primer_field4', 'Email', 'fill_primer_field4', 'options', 'section_1' );
		add_settings_field('primer_field5', 'Адрес', 'fill_primer_field5', 'options', 'section_1' );
		// add_settings_field('primer_field10', 'Адрес2', 'fill_primer_field10', 'options', 'section_1' );
    // соц сети
		add_settings_field('primer_field6', 'Facebook', 'fill_primer_field6', 'options', 'section_1' );
		add_settings_field('primer_field7', 'Instagram', 'fill_primer_field7', 'options', 'section_1' );
		// add_settings_field('primer_field8', 'Youtube', 'fill_primer_field8', 'options', 'section_1' );
	// время работы, локация
		add_settings_field('primer_field9', 'Время работы', 'fill_primer_field9', 'options', 'section_1' );
		// add_settings_field('primer_field11', 'Слоган вверху', 'fill_primer_field11', 'options', 'section_1' );
	}

	## Заполняем опцию 1
	function fill_primer_field1(){
		$val = get_option('settings');
		$val = $val ? $val['phone1'] : null;
		?>
		<input type="text" name="settings[phone1]" value="<?php echo esc_attr( $val ) ?>" placeholder="+380 (XX) XXX XX XX" />
		<?php
	}
	## Заполняем опцию 2
	function fill_primer_field2(){
		$val = get_option('settings');
		$val = $val ? $val['phone2'] : null;
		?>
		<input type="text" name="settings[phone2]" value="<?php echo esc_attr( $val ) ?>" placeholder="+380 (XX) XXX XX XX" />
		<?php
	}
	## Заполняем опцию 3
	/*function fill_primer_field3(){
		$val = get_option('settings');
		$val = $val ? $val['phone3'] : null;
		?>
		<input type="text" name="settings[phone3]" value="<?php echo esc_attr( $val ) ?>" />
		<hr>
		<?php
	}*/

	## Заполняем опцию 4
	function fill_primer_field4(){
		$val = get_option('settings');
		$val = $val ? $val['email'] : null;
		?>
		<input type="email" name="settings[email]" value="<?php echo esc_attr( $val ) ?>" placeholder="admin@your.email" />
		<?php
	}

	## Заполняем опцию 5
	function fill_primer_field5(){
		$val = get_option('settings');
		$val = $val ? $val['address'] : null;
		?>
		<input type="text" name="settings[address]" value="<?php echo esc_attr( $val ) ?>" placeholder="Ваше расположение" />
		<?php
	}
	## Заполняем опцию 6
	function fill_primer_field6(){
		$val = get_option('settings');
		$val = $val ? $val['fb'] : null;
		?>
		<input type="text" name="settings[fb]" value="<?php echo esc_attr( $val ) ?>" placeholder="https://facebook.com/...." />
		<?php
	}

	## Заполняем опцию 7
	function fill_primer_field7(){
		$val = get_option('settings');
		$val = $val ? $val['inst'] : null;
		?>
		<input type="text" name="settings[inst]" value="<?php echo esc_attr( $val ) ?>" placeholder="https://instagram.com/...." />
		<?php
	}

	/*
	## Заполняем опцию 8
	function fill_primer_field8(){
		$val = get_option('settings');
		$val = $val ? $val['yout'] : null;
		?>
		<input type="text" name="settings[yout]" value="<?php echo esc_attr( $val ) ?>" />
		<hr>
		<?php
	}*/

	## Заполняем опцию 9
	function fill_primer_field9(){
		$val = get_option('settings');
		$val = $val ? $val['work-time'] : null;
		?>
		<input type="text" name="settings[work-time]" value="<?php echo esc_attr( $val ) ?>" placeholder="график работы заведения" />
		<?php
	}
	/*
	## Заполняем опцию 10
	function fill_primer_field10(){
		$val = get_option('settings');
		$val = $val ? $val['address2'] : null;
		?>
		<input type="text" name="settings[address2]" value="<?php echo esc_attr( $val ) ?>" />
		<hr style="margin-top: 40px">
		<?php
	}
	*/
	/*
	## Заполняем опцию 11
	function fill_primer_field11(){
		$val = get_option('settings');
		$val = $val ? $val['slogan'] : null;
		?>
		<input type="text" name="settings[slogan]" value="<?php echo esc_attr( $val ) ?>" />
		<?php
	}*/

	## Очистка данных
	function sanitize_callback( $options ){
		// очищаем
		foreach( $options as $name => & $val ){
			if( $name == 'input' )
				$val = strip_tags( $val );

			if( $name == 'checkbox' )
				$val = intval( $val );
		}

		//die(print_r( $options )); // Array ( [input] => aaaa [checkbox] => 1 )

		return $options;
	}
?>
