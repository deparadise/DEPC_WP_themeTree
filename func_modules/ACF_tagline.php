<?php
	if(function_exists("register_field_group"))
	{
		register_field_group(array (
			'id' => 'acf_home-page-tagline',
			'title' => 'Home Page Tagline',
			'fields' => array (
				array (
					'key' => 'field_571be1037a40f',
					'label' => 'Tagline',
					'name' => 'tagline',
					'type' => 'text',
					'instructions' => 'for homepage head banner',
					'default_value' => 'Event Enhancement Specialists!',
					'placeholder' => 'Event Enhancement Specialists!',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => '',
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
				'layout' => 'no_box',
				'hide_on_screen' => array (
				),
			),
			'menu_order' => 0,
		));
	}
