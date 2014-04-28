<?php get_header();

$fullwidth = 'off';
$meta_date = 'M j, Y';
$show_thumbnail = 'on';
$show_content = 'off';
$show_author = 'on';
$show_categories = 'on';
$show_pagination = 'on';
$background_layout = 'light';

?>

<div id="main-content">
	<div class="header-full">
		<div class="container">
			<div class="breadcrumb">
				<p><span><a href="<?php echo home_URL() ?>">home/ </a></span>
				<h1>Vídeos</h1>
			</div>
		</div>
	</div>
	<?php if(!is_paged()) : the_post(); ?>
		<section id="latest-video">
			<div class="et_pb_section" style="background-color:#efefef;">
				<div class="et_pb_row">
					<div class="et_pb_column et_pb_column_1_2">
						<?php echo wp_oembed_get(get_field('video_url')); ?>
					</div>
					<div class="et_pb_column et_pb_column_1_2">
						<h2><?php the_title(); ?></h2>
						<?php if ( 'on' === $show_author || 'on' === $show_date || 'on' === $show_tags ) {
							printf( '<p class="post-meta">%1$s %2$s %3$s</p>',
								(
									'on' === $show_author
										? sprintf( __( 'por %s |', 'Divi' ), et_get_the_author_posts_link() )
										: ''
								),
								(
									'on' === $show_date
										? sprintf( __( '%s |', 'Divi' ), get_the_date( $meta_date ) )
										: ''
								),
								(
									'on' === $show_categories
										? get_the_category_list(', ')
										: ''
								)
							);
						} ?>
						<?php the_excerpt(); ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
	<div class="entry-content">
		<div class="et_pb_section">
			<div class="et_pb_row">
				<div class="et_pb_column et_pb_column_4_4">
					<div class="et_pb_blog_grid_wrapper">
						<div class="et_pb_blog_grid clearfix et_pb_bg_layout_light">
						<?php

							if ( have_posts() ) {
								while ( have_posts() ) {
									the_post(); ?>

									<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post post-module' ); ?>>

								<?php
									$thumb = '';

									$width = 400;
									$width = (int) apply_filters( 'et_pb_blog_image_width', $width );

									$height = 250;
									$height = (int) apply_filters( 'et_pb_blog_image_height', $height );
									$classtext = 'on' === $fullwidth ? 'et_pb_post_main_image' : '';
									$titletext = get_the_title();
									$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
									$thumb = $thumbnail["thumb"];

									if ( '' !== $thumb && 'on' === $show_thumbnail ) :
										if ( 'on' !== $fullwidth ) echo '<div class="et_pb_image_container">'; ?>
										<a href="<?php the_permalink(); ?>">
											<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
										</a>
								<?php
										if ( 'on' !== $fullwidth ) echo '</div> <!-- .et_pb_image_container -->';
									endif;
								?>

										<h2>
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											<span class="cmm">
												<a href="<?php the_permalink(); ?>#comments"><span class="cmm-cnt"><?php echo get_comments_number(); ?></span></a>
											</span>
										</h2>

									<?php
										if ( 'on' === $show_author || 'on' === $show_date || 'on' === $show_tags ) {
											printf( '<p class="post-meta">%1$s %2$s %3$s</p>',
												(
													'on' === $show_author
														? sprintf( __( 'por %s |', 'Divi' ), et_get_the_author_posts_link() )
														: ''
												),
												(
													'on' === $show_date
														? sprintf( __( '%s |', 'Divi' ), get_the_date( $meta_date ) )
														: ''
												),
												(
													'on' === $show_categories
														? get_the_category_list(', ')
														: ''
												)
											);
										}

										if ( 'on' === $show_content ) {
											global $more;
											$more = null;

											the_content( __( 'read more...', 'Divi' ) );
										} else {
											the_excerpt();
										}
									?>

									</article> <!-- .et_pb_post -->
						<?php	}

								if ( 'on' === $show_pagination && ! is_search() ) {
									echo '</div> <!-- .et_pb_posts -->';

									$container_is_closed = true;

									if ( function_exists( 'wp_pagenavi' ) )
										wp_pagenavi();
									else
										get_template_part( 'includes/navigation', 'index' );
								}

								wp_reset_query();
							} else {
								get_template_part( 'includes/no-results', 'index' );
							}
						?>
						</div><!-- clearix -->
					</div><!-- et_pb_blog_grid_wrapper -->
				</div><!-- et_pb_column et_pb_column_4_4 -->
			</div><!--et_pb_row-->
		</div><!--et_pb_section-->
	</div><!-- entry-content -->
</div> <!-- #main-content -->

<?php get_footer(); ?>