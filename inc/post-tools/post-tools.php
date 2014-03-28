<?php

/*
 * Post Tools
 */

class Publica_Post_Tools {

	function __construct() {

		add_action('wp_footer', array($this, 'html'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
	}

	function enable() {
		return is_single();
	}

	function enqueue_scripts() {
		wp_enqueue_style('publica-post-tools', get_stylesheet_directory_uri() . '/inc/post-tools/post-tools.css');
		wp_enqueue_script('publica-post-tools', get_stylesheet_directory_uri() . '/inc/post-tools/post-tools.js', array('jquery'));
	}

	function html() {
		if($this->enable()) {
			?>
			<div id="publica-post-tools">
				<a href="#" class="toggle-tools"><?php _e('Tools', 'publica'); ?></a>
				<ul class="tool-list">
					<li class="tool-item">
						<span class="tool-item"><?php _e('A', 'publica'); ?></span>
						<div class="tool-content-container">
							<div class="tool-content">
								<p>Teste</p>
							</div>
						</div>
					</li>
					<li class="tool-item">
						<span class="tool-item"><?php _e('A', 'publica'); ?></span>
						<div class="tool-content-container">
							<div class="tool-content">
								<p>Teste</p>
							</div>
						</div>
					</li>
					<li class="tool-item">
						<span class="tool-item"><?php _e('A', 'publica'); ?></span>
						<div class="tool-content-container">
							<div class="tool-content">
								<p>Teste</p>
							</div>
						</div>
					</li>
				</ul>
			</div>
			<?php
		}
	}

}

new Publica_Post_Tools;