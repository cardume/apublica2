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
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=174607379284946";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>


			<div id="publica-post-tools">
				<a href="#" class="toggle-tools"><?php _e('Tools', 'publica'); ?></a>
				<ul class="tool-list">
					<li class="tool-item">
						<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="box_count" data-action="like" data-show-faces="false" data-share="true"></div>
					</li>
					<li class="tool-item">
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-via="agenciapublica" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</li>
					<li class="tool-item">
						<!-- Posicione esta tag onde você deseja que o botão +1 apareça. -->
						<div class="g-plusone" data-size="tall"></div>

						<!-- Posicione esta tag depois da última tag do botão +1. -->
						<script type="text/javascript">
						  window.___gcfg = {lang: 'pt-BR'};

						  (function() {
						    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						    po.src = 'https://apis.google.com/js/platform.js';
						    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
						  })();
						</script>
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