<?php get_header(); ?>

<div id="main-content">
	<div class="header-full">
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
			<h1><?php echo get_the_title(); ?></h1>
		</div>
	</div>
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (et_get_option('divi_integration_single_bottom') <> '' && et_get_option('divi_integrate_singlebottom_enable') == 'on') echo(et_get_option('divi_integration_single_bottom')); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					<h1><?php the_title(); ?></h1>
					<?php et_divi_post_meta(); ?>
				</article>
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

					<div class="entry-content">
					<?php
						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->


					<?php
						if ( comments_open() && 'on' == et_get_option( 'divi_show_postcomments', 'on' ) )
							comments_template( '', true );
					?>
				</article> <!-- .et_pb_post -->

				<?php if (et_get_option('divi_integration_single_bottom') <> '' && et_get_option('divi_integrate_singlebottom_enable') == 'on') echo(et_get_option('divi_integration_single_bottom')); ?>
			<?php endwhile; ?>
			</div> <!-- #left-area -->
			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
</div> <!-- #main-content -->

<?php get_footer(); ?>