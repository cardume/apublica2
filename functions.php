<?php

/*
 * Advanced Custom Fields
 */

function publica_acf_dir() {
	return get_stylesheet_directory_uri() . '/inc/acf/';
}
add_filter('acf/helpers/get_dir', 'publica_acf_dir');

function publica_acf_date_time_picker_dir() {
	return publica_acf_dir() . '/add-ons/acf-field-date-time-picker/';
}
add_filter('acf/add-ons/date-time-picker/get_dir', 'publica_acf_date_time_picker_dir');

function publica_acf_repeater_dir() {
	return publica_acf_dir() . '/add-ons/acf-repeater/';
}
add_filter('acf/add-ons/repeater/get_dir', 'publica_acf_repeater_dir');

define('ACF_LITE', true);
require_once(STYLESHEETPATH . '/inc/acf/acf.php');
require_once(STYLESHEETPATH . '/inc/acf-fields.php');

/*
 * Publica setup
 */


function publica_scripts() {

	wp_enqueue_script('jquery-masonry');

	wp_register_script('fitvids', get_stylesheet_directory_uri() . '/lib/jquery.fitvids.js', array('jquery'));

	wp_enqueue_style('divi-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('publica-main', get_stylesheet_uri(), array('divi-style'));
	wp_enqueue_script('publica-pagebuilder', get_stylesheet_directory_uri() . '/inc/pagebuilder/custom.js', array('jquery', 'fitvids'));

	wp_enqueue_script('publica-main', get_stylesheet_directory_uri() . '/js/main.js', array('jquery', 'fitvids'));


}
add_action('wp_enqueue_scripts', 'publica_scripts', 1);

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
		'public'			=> true,
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'assunto'),
	);

	register_taxonomy('assunto', array('post'), $args);
}
add_action('init', 'publica_assunto_tax');

function publica_author_tax() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x('Autores', 'taxonomy general name'),
		'singular_name'     => _x('Autor', 'taxonomy singular name'),
		'search_items'      => __('Buscar autores'),
		'all_items'         => __('Todos os autores'),
		'parent_item'       => __('Autor pai'),
		'parent_item_colon' => __('Autor pai:'),
		'edit_item'         => __('Editar autor'),
		'update_item'       => __('Atualizar autor'),
		'add_new_item'      => __('Adicionar novo autor'),
		'new_item_name'     => __('Novo nome de autor'),
		'menu_name'         => __('Autor'),
	);

	$args = array(
		'public'			=> true,
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'autor'),
	);

	register_taxonomy('autor', array('post'), $args);
}
add_action('init', 'publica_author_tax');

// Page builder
include_once(STYLESHEETPATH . '/inc/pagebuilder/admin.php');
include_once(STYLESHEETPATH . '/inc/pagebuilder/shortcodes.php');

// Shares
include_once(STYLESHEETPATH . '/inc/shares.php');

// Highlight share
include_once(STYLESHEETPATH . '/inc/highlight-share/highlight-share.php');

// Update shares on post view
function publica_update_shares() {
	if(is_single()) {
		global $post;
		publica_get_shares($post->ID);
	}
}
add_action('wp_head', 'publica_update_shares');

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
        	'title' => 'Grey h1 title',
        	'block' => 'h1',
        	'classes' => 'grey-h1-title',
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


/* 
 * Remove ET settings box from post
 */
if(is_admin()) {
	function publica_remove_meta_boxes() {
		remove_meta_box('et_settings_meta_box', 'post', 'side');
	}
	add_action('do_meta_boxes', 'publica_remove_meta_boxes');
}

// Fix post save to use fullwidth layout

function publica_post_fixed_layout($metadata, $object_id, $meta_key, $single) {

	if($meta_key == '_et_pb_page_layout') {
		$post = get_post($object_id);
		if($post && $post->post_type == 'post') {
			return 'et_full_width_page';
		}
	}
	return $metadata;
}
add_filter('get_post_metadata', 'publica_post_fixed_layout', 10, 4);


function register_my_menus() {
  register_nav_menus(
    array(
      'footer_menu_1' => 'Menu do footer 1',
      'footer_menu_2' => 'Menu do footer 2',
    )
  );
}
add_action( 'init', 'register_my_menus' );

function publica_authors() {
	global $post;
	if(get_the_terms($post->ID, 'autor')) {
		the_terms($post->ID, 'autor');
	} else {
		the_author_posts_link();
	}
}

function get_publica_authors() {
	ob_start();
	publica_authors();
	return ob_get_clean();
}