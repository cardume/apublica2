	<footer id="main-footer">
		<?php get_sidebar( 'footer' ); ?>
		<div id="footer-bottom">
			<div class="et_pb_row">
				<div class="et_pb_column et_pb_column_1_4">
					<?php
						$logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && '' != $user_logo
							? $user_logo
							: $template_directory_uri . '/images/logo.png';
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" id="footer-logo" />
					</a>
				</div>
				<div class="et_pb_column et_pb_column_1_2">
					<span class="footer-site-desc"><?php bloginfo( 'description'); ?></span>
				</div>
				<div class="et_pb_column et_pb_column_1_4 footer-search">
					<form role="search" method="get" class="et-search-form-footer" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php
							printf( '<input type="search" class="et-search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
								esc_attr_x( 'Search &hellip;', 'placeholder', 'Divi' ),
								get_search_query(),
								esc_attr_x( 'Search for:', 'label', 'Divi' )
							);
						?>
					</form>
				</div>
			</div>
			<div class="et_pb_row">
				<div class="et_pb_column et_pb_column_1_4 footer-column"><?php wp_nav_menu( array('menu' => 'Footer menu 1' )); ?></div>
				<div class="et_pb_column et_pb_column_1_4 footer-column"><?php wp_nav_menu( array('menu' => 'Footer menu 2' )); ?></div>
				<div class="et_pb_column et_pb_column_1_4 footer-column">
					<ul id="et-social-icons">
						<?php if ( 'on' === et_get_option( 'divi_show_facebook_icon', 'on' ) ) : ?>
							<li class="et-social-icon et-social-facebook">
								<a href="<?php echo esc_url( et_get_option( 'divi_facebook_url', '#' ) ); ?>">
									<span><?php esc_html_e( 'Facebook', 'Divi' ); ?></span>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( 'on' === et_get_option( 'divi_show_twitter_icon', 'on' ) ) : ?>
							<li class="et-social-icon et-social-twitter">
								<a href="<?php echo esc_url( et_get_option( 'divi_twitter_url', '#' ) ); ?>">
									<span><?php esc_html_e( 'Twitter', 'Divi' ); ?></span>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( 'on' === et_get_option( 'divi_show_google_icon', 'on' ) ) : ?>
							<li class="et-social-icon et-social-google">
								<a href="<?php echo esc_url( et_get_option( 'divi_google_url', '#' ) ); ?>">
									<span><?php esc_html_e( 'Google', 'Divi' ); ?></span>
								</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="et_pb_column et_pb_column_1_4 footer-column">
					<div id="footer-info">
					<p><?php _e( 'Site desenvolvido por:' , 'Divi' ); ?></p>
						<div class="dev-icons">
							<a href="http://cardume.art.br" alt="cardume"><icon class="cardume"></icon></a>
							<span>+</span>
							<a href="http://oniric.ca" alt="oniricca"><icon class="oniricca"></icon></a>
						</div>
						<p>e alguns icones por <a href="http://entypo.com" alt="Entypo">Entypo</a></p>
					</div>
				</div>
			</div>
			<div class="container clearfix">
			</div>	<!-- .container -->
		</div>
	</footer> <!-- #main-footer -->
	<?php wp_footer(); ?>
</body>
</html>