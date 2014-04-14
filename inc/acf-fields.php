<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_video',
		'title' => 'Vídeo',
		'fields' => array (
			array (
				'key' => 'field_534b4d3d6876e',
				'label' => 'URL do vídeo',
				'name' => 'video_url',
				'type' => 'text',
				'instructions' => 'YouTube, Vimeo, Dailymotion, Blip.tv, Flickr e Instagram',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

?>