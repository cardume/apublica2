<?php get_header(); ?>

<div id="main-content">
	<div class="header-full">
		<div class="container">
			<div class="breadcrumb">
				<p><span><a href="<?php echo home_URL() ?>">home/ </a></span>
					<?php
						$category = get_the_category();
						if ( $category ) {
							$catlink = get_category_link( $category[0]->cat_ID );
							echo ('<a href="'.esc_url($catlink).'">'.esc_html($category[0]->cat_name).'</a> ');
						}
					?>
				</p>
				<?php
				$assunto = get_the_terms($post->ID, 'assunto');
				if($assunto) {
					$assunto = array_shift($assunto);
					?>
					<h2><a href="<?php echo get_term_link($assunto, 'assunto'); ?>"><?php echo $assunto->name; ?></a></h2>
					<?php
				}
				?>
			</div>
		</div>
	</div>

	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="container">
				<div id="content-area" class="clearfix">
					<div class="full-area">
						<?php if (et_get_option('divi_integration_single_bottom') <> '' && et_get_option('divi_integrate_singlebottom_enable') == 'on') echo(et_get_option('divi_integration_single_bottom')); ?>
						<h1><?php the_title(); ?></h1>
						<p class="post-meta">por <?php publica_authors(); ?> | <?php the_date(); ?></p>
					</div>
				</div>
			</div>
			<div class="excerpt-full"> 
				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>
			</div>
			<div class="container single-post-container">
				<div class="clearfix">
					<div id="left-area">

						<div class="entry-content clearfix">
						<?php
							the_content();

							wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Divi' ), 'after' => '</div>' ) );

							the_tags('<p>Tags: ', ', ', '</p>');
						?>
						</div> <!-- .entry-content -->

					<?php if (et_get_option('divi_integration_single_bottom') <> '' && et_get_option('divi_integrate_singlebottom_enable') == 'on') echo(et_get_option('divi_integration_single_bottom')); ?>
					</div> <!-- #left-area -->
				</div> <!-- #content-area -->
			</div> <!-- .container -->



			<?php if(get_field('making_of')) : ?>
				<div class="making-of clearfix">
					<div class="container secondary-container">
						<h3>Veja o making of da reportagem</h3>
						<div class="making-of-content">
							<?php the_field('making_of'); ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div id="comments" class="container secondary-container">
				<div class="comment-area">
					<h2><?php _e('Comentários', 'Divi') ?></h2>
					<p> <?php _e('Opte por Disqus ou Facebook', 'Divi') ?></p>
					<div class="clearfix">
						<div class="et_pb_row">
							<div class="et_pb_column et_pb_column_1_2">
								<?php
									if ( comments_open() && 'on' == et_get_option( 'divi_show_postcomments', 'on' ) )
										comments_template( '', true );
								?>
							</div>
							<div class="et_pb_column et_pb_column_1_2">
								<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="10"></div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</article> <!-- .et_pb_post -->
	<?php endwhile; ?>
	<?php echo do_shortcode('[et_pb_publica_summary]'); ?>
</div> <!-- #main-content -->

<?php get_footer(); ?>