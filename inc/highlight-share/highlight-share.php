<?php

/*
 * Highlight Share
 */

class Highlight_Share {

	function __construct() {

		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
		add_action('wp_footer', array($this, 'html'));

	}

	function html() {
		if(is_single()) {
			?>
			<div class="highlight-share">
				<ul class="shares">
					<li class="fb et-social-icon et-social-twitter"><a href="#" class="twitter"><span>Twitter</span></a></li>
				</ul>
			</div>
			<?php
		}
	}

	function enqueue_scripts() {

		if(is_single()) {
			wp_register_script('highlighter', get_stylesheet_directory_uri() . '/lib/jQuery.highlighter.js', array('jquery'));
			wp_enqueue_script('highlight-share', get_stylesheet_directory_uri() . '/inc/highlight-share/highlight-share.js', array('highlighter'));
		}

	}

}

new Highlight_Share();