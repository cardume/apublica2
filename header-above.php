<div class="et_pb_row above clearfix">
	<div class="et_pb_column et_pb_column_3_4">
		<h2 class="header-site-desc"><?php bloginfo( 'description'); ?></h2>
	</div>
	<div class="et_pb_column et_pb_column_1_4">
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
			<?php if ( 'on' === et_get_option( 'divi_show_rss_icon', 'on' ) ) : ?>
				<li class="et-social-icon et-social-rss">
					<a href="<?php echo esc_url( $et_rss_url ); ?>">
						<span><?php esc_html_e( 'RSS', 'Divi' ); ?></span>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</div>