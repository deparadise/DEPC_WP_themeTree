<?php
	if(function_exists("register_field_group"))
	{
		register_field_group(array (
			'id' => 'acf_simple-slider',
			'title' => 'Simple Slider',
			'fields' => array (
				array (
					'key' => 'field_578f0a512949a',
					'label' => 'simple slider',
					'name' => 'simple_slider',
					'type' => 'textarea',
					'instructions' => 'Place a list of CSV URLs for the images you would like to use here. They will be displayed in the home page simple slider.',
					'default_value' => '',
					'placeholder' => 'url.jpg,url.png,url.jpg',
					'maxlength' => '',
					'rows' => '',
					'formatting' => 'none',
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
				'position' => 'acf_after_title',
				'layout' => 'default',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 1,
		));
	}
