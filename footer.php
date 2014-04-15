	<footer id="main-footer">
		<?php get_sidebar( 'footer' ); ?>

		<div id="footer-bottom">
<div class="et_pb_row">
	<div class="et_pb_column et_pb_column_3_4">
			<?php
				$logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && '' != $user_logo
					? $user_logo
					: $template_directory_uri . '/images/logo.png';
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" id="footer-logo" />
			</a>

	</div>
	<div class="et_pb_column et_pb_column_1_4 footer-search">14</div>
	<div class="et_pb_column et_pb_column_1_4 footer-column">a</div>
	<div class="et_pb_column et_pb_column_1_4 footer-column">b</div>
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
		<p id="footer-info"><?php printf( __( 'Designed by %1$s | Powered by %2$s', 'Divi' ), '<a href="http://www.elegantthemes.com" title="Premium WordPress Themes">Elegant Themes</a>', '<a href="http://www.wordpress.org">WordPress</a>' ); ?></p>
	</div>
</div>

			
				

			<div class="container clearfix">
			</div>	<!-- .container -->
		</div>
	</footer> <!-- #main-footer -->

	<?php wp_footer(); ?>
</body>
</html>