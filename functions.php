<?php

/*
 * Publica setup
 */

function publica_styles() {

	wp_enqueue_style('divi-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('publica-main', get_stylesheet_uri(), array('divi-style'));

}
add_action('wp_enqueue_scripts', 'publica_styles');

function publica_admin_styles() {
	wp_enqueue_style('publica-admin', get_stylesheet_directory_uri() . '/admin.css');
}
add_action('admin_init', 'publica_admin_styles');

function publica_assunto_tax() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x('Assuntos', 'taxonomy general name'),
		'singular_name'     => _x('Assunto', 'taxonomy singular name'),
		'search_items'      => __('Buscar assuntos'),
		'all_items'         => __('Todos os assuntos'),
		'parent_item'       => __('Assunto pai'),
		'parent_item_colon' => __('Assunto pai:'),
		'edit_item'         => __('Editar assunto'),
		'update_item'       => __('Atualizar assunto'),
		'add_new_item'      => __('Adicionar novo assunto'),
		'new_item_name'     => __('Novo nome de assunto'),
		'menu_name'         => __('Assunto'),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'assunto'),
	);

	register_taxonomy('assunto', array('post'), $args);
}
add_action('init', 'publica_assunto_tax');

// Page builder
include_once(STYLESHEETPATH . '/inc/pagebuilder/admin.php');
include_once(STYLESHEETPATH . '/inc/pagebuilder/shortcodes.php');

// Post Tools
include_once(STYLESHEETPATH . '/inc/post-tools/post-tools.php');



// custom Styles in tiny MCE editor

add_filter( 'mce_buttons_2', 'my_mce_buttons_2' );

function my_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

add_filter( 'tiny_mce_before_init', 'my_mce_before_init' );

function my_mce_before_init( $settings ) {

    $style_formats = array(
    	array(
    		'title' => 'Big Heading',
    		'block' => 'h1',
    		'classes' => 'big-heading'
    	),
        array(
        	'title' => 'Quem somos title',
        	'block' => 'h1',
        	'classes' => 'quem-somos-title',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Bold Red Text',
        	'inline' => 'span',
        	'styles' => array(
        		'color' => '#f00',
        		'fontWeight' => 'bold'
        	)
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}