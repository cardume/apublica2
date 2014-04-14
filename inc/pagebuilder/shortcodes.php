<?php

/*
 * PUBLICA PAGE BUILDER
 * Shortcodes
 */

function et_pb_publica($atts) {

	extract(shortcode_atts(array(
			'module_id' => '',
			'module_class' => ''
		), $atts
	));

	$content = '<p>Hello</p>';

	$output = sprintf('<div%1$s class="%2$s">%3$s</div>',
		('' !== $module_id ? sprintf(' id="%1$s"', esc_attr($module_id)) : ''),
		('' !== $module_class ? sprintf(' %1$s', esc_attr($module_class)) : ''),
		('' !== $content ? $content : '')
	);

	return $output;
}
add_shortcode('et_pb_publica', 'et_pb_publica');

function et_pb_publica_slider($atts, $content = '') {

	extract(shortcode_atts(array(
			'module_id' => '',
			'module_class' => '',
			'background_color' => '#111111'
		), $atts
	));

	$content = do_shortcode(et_pb_fix_shortcodes($content));

	$output = sprintf('<div%1$s class="%2$s" style="%4$s">%3$s</div>',
		('' !== $module_id ? sprintf(' id="%1$s"', esc_attr($module_id)) : ''),
		('' !== $module_class ? sprintf(' %1$s', esc_attr($module_class)) : ''),
		('' !== $content ? $content : ''),
		('' !== $background_color ? 'background-color:' . $background_color : '')
	);

	return $output;
}
add_shortcode('et_pb_publica_slider', 'et_pb_publica_slider');

function et_pb_publica_slide($atts) {

	extract(shortcode_atts(array(
			'post_id' => false,
			'heading' => ''
		), $atts
	));

	return $heading;

}
add_shortcode('et_pb_publica_slide', 'et_pb_publica_slide');
