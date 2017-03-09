<?php
	if(function_exists("register_field_group"))
	{
		register_field_group(array (
			'id' => 'acf_testimonial-fields',
			'title' => 'Testimonial Fields',
			'fields' => array (
				array (
					'key' => 'field_58c0d8e8039ff',
					'label' => 'Paraphrase',
					'name' => 'paraphrase',
					'type' => 'text',
					'instructions' => 'Describe the testimonial.',
					'default_value' => '',
					'placeholder' => 'Their work is the best!',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => '',
				),
				array (
					'key' => 'field_58c0d96d03a00',
					'label' => 'Comment',
					'name' => 'comment',
					'type' => 'wysiwyg',
					'instructions' => 'What did the client say about my work?',
					'default_value' => '',
					'toolbar' => 'full',
					'media_upload' => 'no',
				),
				array (
					'key' => 'field_58c0d848039fe',
					'label' => 'Citation',
					'name' => 'citation',
					'type' => 'text',
					'instructions' => 'Who left the comment?',
					'required' => 1,
					'default_value' => '',
					'placeholder' => '...some great client',
					'prepend' => '',
					'append' => '',
					'formatting' => 'none',
					'maxlength' => '',
				),
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'testimonials',
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options' => array (
				'position' => 'acf_after_title',
				'layout' => 'no_box',
				'hide_on_screen' => array (
					0 => 'the_content',
					1 => 'excerpt',
					2 => 'custom_fields',
					3 => 'discussion',
					4 => 'comments',
				),
			),
			'menu_order' => 0,
		));
	}
