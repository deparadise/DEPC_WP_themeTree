<?php
	if(function_exists("register_field_group"))
	{
		register_field_group(array (
			'id' => 'acf_event-date',
			'title' => 'Event Date',
			'fields' => array (
				array (
					'key' => 'field_574d2c21034e8',
					'label' => 'Event Date',
					'name' => 'event_date',
					'type' => 'date_picker',
					'date_format' => '@_mm/dd/yy',
					'display_format' => 'mm/dd/yy',
					'first_day' => 0,
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'events',
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