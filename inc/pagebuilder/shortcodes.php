<?php

/*
 * PUBLICA OVERWRITTEN SHORTCODES
 * O código abaixo é um exemplo de uma sobreposição de módulo do Page Builder do Divi
 * Os módulos são shortcodes configurados a partir dos seus parâmetros. Info sobre shortcodes: http://codex.wordpress.org/Shortcode_API
 * Abaixo estou copiando o shortcode do módulo "Blog" em uma nova função.
 * Todos os shortcodes dos módulos podem ser encontrados no arquivo functions.php do Divi
 */

function publica_overwrite_shortcodes() {

	// Remove shortcode original cadastrado pelo Divi
	remove_shortcode('et_pb_blog');

	// Recadastra shortcode com nova função
	add_shortcode('et_pb_blog', 'et_pb_publica_blog');

}

// Sobreposição declarada no hook "init"
add_action('init', 'publica_overwrite_shortcodes');

// O shortcode (visualização do módulo blog)
function et_pb_publica_blog( $atts ) {

	// O extract recebe os parâmetros enviados via shortcodes e os atribui em variáveis.
	// Por exemplo, o primeiro item do array abaixo é declarado na variável $module_id
	extract( shortcode_atts( array(
			'module_id' => '',
			'module_class' => '',
			'fullwidth' => 'on',
			'posts_number' => 10,
			'include_categories' => '',
			'meta_date' => 'M j, Y',
			'show_thumbnail' => 'on',
			'show_content' => 'off',
			'show_author' => 'on',
			'show_date' => 'on',
			'show_categories' => 'on',
			'show_pagination' => 'on',
			'background_layout' => 'light',
		), $atts
	) );

	$container_is_closed = false;

	if ( 'on' !== $fullwidth )
		wp_enqueue_script( 'jquery-masonry' );

	$args = array( 'posts_per_page' => (int) $posts_number );

	$paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );

	if ( '' !== $include_categories )
		$args['cat'] = $include_categories;

	if ( ! is_search() ) {
		$args['paged'] = $paged;
	}

	ob_start();

	query_posts( $args );

	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>

		<?php
			$thumb = '';

			$width = 'on' === $fullwidth ? 1080 : 400;
			$width = (int) apply_filters( 'et_pb_blog_image_width', $width );

			$height = 'on' === $fullwidth ? 675 : 250;
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

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<?php
				if ( 'on' === $show_author || 'on' === $show_date || 'on' === $show_tags ) {
					printf( '<p class="post-meta">%1$s %2$s %3$s</p>',
						(
							'on' === $show_author
								? sprintf( __( 'by %s |', 'Divi' ), et_get_the_author_posts_link() )
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

	$posts = ob_get_contents();

	ob_end_clean();

	$class = " et_pb_bg_layout_{$background_layout}";

	$output = sprintf(
		'<div%5$s class="%1$s%3$s%6$s">
			%2$s
		%4$s',
		( 'on' === $fullwidth ? 'et_pb_posts' : 'et_pb_blog_grid clearfix' ),
		$posts,
		esc_attr( $class ),
		( ! $container_is_closed ? '</div> <!-- .et_pb_posts -->' : '' ),
		( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),
		( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )
	);

	if ( 'on' !== $fullwidth )
		$output = sprintf( '<div class="et_pb_blog_grid_wrapper">%1$s</div>', $output );

	return $output;
}


/*
 * Fim do exemplo
 */

/*
 * PUBLICA PAGE BUILDER
 * Shortcodes
 */

function et_pb_publica($atts) {

	extract(shortcode_atts(array(
		'module_id' => '',
		'module_class' => ''
	), $atts));

	$content = '<p>Hello</p>';

	$output = sprintf('<div%1$s class="%2$s">%3$s</div>',
		('' !== $module_id ? sprintf(' id="%1$s"', esc_attr($module_id)) : ''),
		('' !== $module_class ? sprintf(' %1$s', esc_attr($module_class)) : ''),
		('' !== $content ? $content : '')
	);

	return $output;
}
add_shortcode('et_pb_publica', 'et_pb_publica');

function et_pb_publica_summary($atts) {

	extract(shortcode_atts(array(
		'module_id' => '',
		'module_class' => ''
	), $atts));

	ob_start();

	?>

	<div class="et_pb_row">
		<div class="summary-nav">
			<a href="#" data-summary="most-recent">Mais recentes</a>
			<a href="#" data-summary="most-shared">Mais compartilhadas</a>
			<a href="#" data-summary="videos">Vídeos</a>
			<a href="#" data-summary="currents">Temas do momento</a>
		</div>
	</div>
	<div class="summary-content-container">
		<div class="et_pb_row">
			<div class="summary-content">
				<div class="summary-content-item" data-summary="most-recent">
					<?php publica_summary_item(get_posts(array('posts_per_page' => 5))); ?>
				</div>
			</div>
		</div>
	</div>

	<?php

	$content = ob_get_contents();
	ob_end_clean();

	$output = sprintf('<div%1$s class="%2$s publica-summary clearfix">%3$s</div>',
		('' !== $module_id ? sprintf(' id="%1$s"', esc_attr($module_id)) : ''),
		('' !== $module_class ? sprintf(' %1$s', esc_attr($module_class)) : ''),
		('' !== $content ? $content : '')
	);

	return $output;

}
add_shortcode('et_pb_publica_summary', 'et_pb_publica_summary');

function publica_summary_item($posts) {

	global $post;

	$i = 0;

	foreach($posts as $post) {

		setup_postdata($post);

		if($i == 0) {
			?>
			<div class="et_pb_column et_pb_column_1_2">
			<?php
		} elseif($i == 1 || $i == 3) {
			if($i == 1) {
				?>
				</div>
				<?php
			}
			?>
			<div class="et_pb_column et_pb_column_1_4">
			<?php
		}

		?>

			<article <?php post_class(); ?>>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<?php the_post_thumbnail(); ?>
			</article>

		<?php

		if($i == 2 || $i == 4) {
			?>
			</div>
			<?php
		}

		wp_reset_postdata();

		$i++;

	}

}

function et_pb_publica_slider($atts, $content = '') {

	extract(shortcode_atts(array(
		'module_id' => '',
		'module_class' => '',
		'background_color' => '#111111'
	), $atts));

	$content = do_shortcode(et_pb_fix_shortcodes($content));

	$output = sprintf('<div%1$s class="%2$s publica-slider clearfix" style="%4$s"><div class=""><div class="active-content">&nbsp;</div><div class="slides">%3$s</div></div></div>',
		('' !== $module_id ? sprintf(' id="%1$s"', esc_attr($module_id)) : ''),
		('' !== $module_class ? sprintf(' %1$s', esc_attr($module_class)) : ''),
		('' !== $content ? $content : ''),
		('' !== $background_color ? 'background-color:' . $background_color : '')
	);

	return $output;
}
add_shortcode('et_pb_publica_slider', 'et_pb_publica_slider');

function et_pb_publica_slide($atts) {

	extract(shortcode_atts(array(
		'post_id' => false,
		'heading' => '',
		'assunto' => '',
		'description' => '',
		'url' => '',
		'background_image' => ''
	), $atts));

	if($post_id) {
		global $post;
		$post = get_post($post_id);
		if($post) {

			setup_postdata($post);

			$assunto_term = get_the_terms($post->ID, 'assunto');
			if($assunto_term)
				$assunto_term = $assunto_term[0];

			$thumb_id = get_post_thumbnail_id();
			$thumb_url = '';
			if($thumb_id) {
				$thumb_url = wp_get_attachment_image_src($thumb_id, 'medium', true);
				if($thumb_url)
				$thumb_url = $thumb_url[0];
			}

			$heading = $heading ? $heading: get_the_title();
			$assunto = $assunto ? $assunto : ($assunto_term ? $assunto_term->name : '');
			$description = $description ? $description : get_the_excerpt();
			$url = $url ? $url : get_permalink();
			$background_image = $background_image ? $background_image : $thumb_url;

			wp_reset_postdata();
		}
	}

	ob_start();
	?>
	<div class="slide-item">

		<h2><?php echo $heading; ?></h2>
		<p class="assunto"><?php echo $assunto; ?></p>

		<div class="slide-content" <?php if($background_image) echo 'style="background-image:url(' . $background_image . ');"'; ?>>
			<a class="main-link" href="<?php echo $url; ?>" title="<?php echo $heading; ?>"></a>
			<p class="description"><a href="<?php echo $url; ?>"><?php echo $description; ?></a></p>
		</div>

	</div>
	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;

}
add_shortcode('et_pb_publica_slide', 'et_pb_publica_slide');
