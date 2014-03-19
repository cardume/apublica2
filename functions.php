<?php

/*
 * Publica setup
 */

function publica_styles() {

	wp_enqueue_style('divi-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('publica-main', get_stylesheet_uri(), array('divi-style'));

}
add_action('wp_enqueue_scripts', 'publica_styles');

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


function publica_page_builder() {
	?>
		<script type="text/template" id="et-builder-et_pb_publica-module-template">
		<h3 class="et-pb-settings-heading">Blog Module Settings</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_fullwidth">Layout: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_fullwidth" id="et_pb_fullwidth">
						<option value="on"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'on' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>Fullwidth</option>
						<option value="off"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'off' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>Grid</option>
					</select>

					<p class="description">Toggle between the various blog layout types.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>
	<?php

}
//add_action('et_pb_after_page_builder', 'publica_page_builder');

function et_pb_publica() {
	return '<p>Hellllooo</p>';
}
add_shortcode('et_pb_publica', 'et_pb_publica');