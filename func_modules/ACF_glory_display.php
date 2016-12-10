<?php
	if(function_exists("register_field_group"))
	{
		register_field_group(array (
			'id' => 'acf_home-page-partners-display',
			'title' => 'Home Page Glory Display',
			'fields' => array (
				array (
					'key' => 'field_574b7fb61adc5',
					'label' => '',
					'name' => 'glory_display',
					'type' => 'wysiwyg',
					'default_value' => '',
					'toolbar' => 'full',
					'media_upload' => 'yes',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'page_template',
						'operator' => '==',
						'value' => 'home.php',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'normal',
				'layout' => 'default',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 8,
		));
	}

