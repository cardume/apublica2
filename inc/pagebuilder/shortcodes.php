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

function et_pb_post($atts) {

	extract(shortcode_atts(array(
		'module_id' => '',
		'module_class' => '',
		'post_id' => '',
		'display_thumbnail' => '',
		'title' => '',
		'description' => '',
		'thumbnail' => ''
	), $atts));

	if($post_id == '')
		return '';

	if(!get_post($post_id))
		return '';

	global $post;
	$post = get_post($post_id);

	setup_postdata($post);

	$thumb_id = get_post_thumbnail_id();
	$thumb_url = '';
	if($thumb_id) {
		$thumb_url = wp_get_attachment_image_src($thumb_id, 'medium', true);
		if($thumb_url)
		$thumb_url = $thumb_url[0];
	}

	$title = $title ? $title : get_the_title();
	$description = $description ? $description : get_the_excerpt();
	$thumbnail = $thumbnail ? $thumbnail : $thumb_url;

	ob_start();
	?>

	<article <?php post_class(); ?>>
		<?php if($display_thumbnail == 'on' && $thumbnail) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img src="<?php echo $thumbnail; ?>" class="wp-post-image" alt="<?php echo $title; ?>" />
			</a>
		<?php endif; ?>
		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo $title; ?></a></h2>
		<p class="meta">
			<span class="category"><?php the_category(', '); ?></span>
			<span class="separator">|</span>
			<span class="author">por <?php the_author(); ?></span>
			<span class="separator">|</span>
			<span class="date"><?php echo get_the_date(); ?></span>
		</p>
		<p><?php echo $description; ?></p>
	</article>

	<?php

	wp_reset_postdata();

	$content = ob_get_contents();
	ob_end_clean();

	$output = sprintf('<div%1$s class="%2$s post-module">%3$s</div>',
		('' !== $module_id ? sprintf(' id="%1$s"', esc_attr($module_id)) : ''),
		('' !== $module_class ? sprintf(' %1$s', esc_attr($module_class)) : ''),
		('' !== $content ? $content : '')
	);

	return $output;
}
add_shortcode('et_pb_post', 'et_pb_post');

function et_pb_publica_summary($atts) {

	extract(shortcode_atts(array(
		'module_id' => '',
		'module_class' => '',
		'current_assuntos' => ''
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
				<div class="summary-content-item" data-summary="most-shared">
					<?php
					$most_shared_query = new WP_Query(array(
						'posts_per_page' => 5,
						'orderby' => 'meta_value_num',
						'order' => 'DESC',
						'meta_key' => '_share_count_total',
						'date_query' => array(
							array(
								'after' => '1 month ago'
							)
						)
					));
					?>
					<?php publica_summary_item($most_shared_query->posts); ?>
				</div>
				<div class="summary-content-item" data-summary="videos">
					<?php
					$video_query = new WP_Query(array(
						'posts_per_page' => 5,
						'meta_query' => array(
							array(
								'key' => 'video_url',
								'value' => '',
								'compare' => '!='
							)
						)
					));
					?>
					<?php publica_summary_item($video_query->posts, true); ?>
				</div>
				<div class="summary-content-item" data-summary="currents">
					<?php
					$currents_query = new WP_Query(array(
						'posts_per_page' => 5,
						'tax_query' => array(
							array(
								'taxonomy' => 'assunto',
								'field' => 'term_id',
								'terms' => explode(',', $current_assuntos)
							)
						)
					));
					?>
					<?php publica_summary_item($currents_query->posts); ?>
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

function publica_summary_item($posts, $use_video = false) {

	global $post;

	for($i = 0; $i <= 4; $i++) {

		$post = $posts[$i];

		if($post)
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

		if($post) {
			?>

			<article <?php post_class(); ?>>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<p class="meta">
					<span class="category"><?php the_category(', '); ?></span>
					<span class="separator">|</span>
					<span class="author">por <?php the_author(); ?></span>
					<span class="separator">|</span>
					<span class="date"><?php echo get_the_date(); ?></span>
				</p>
				<?php if($use_video && get_field('video_url')) : ?>
					<?php echo wp_oembed_get(get_field('video_url')); ?>
				<?php else : ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
				<?php endif; ?>
			</article>

			<?php
		}

		if($i == 2 || $i == 4) {
			?>
			</div>
			<?php
		}

		wp_reset_postdata();

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
				$thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
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

/*
 * Publica Category
 */

function et_pb_publica_category($atts) {

	extract(shortcode_atts(array(
		'category' => false,
		'title' => '',
		'amount' => 2,
		'button_label' => '',
		'module_id' => '',
		'module_class' => ''
	), $atts));

	if(!$category)
		return '';

	$query = new WP_Query(array(
		'posts_per_page' => $amount,
		'category__in' => explode(',', $category)
	));

	$content = '';

	if($query->have_posts()) {
		ob_start();
		?>

		<h2><?php echo $title; ?></h2>
		<div class="posts-container">
			<div class="clearfix">
				<?php while($query->have_posts()) {
					$query->the_post();
					?>

					<article <?php post_class('item'); ?>>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
					</article>

					<?php
				} ?>
			</div>
			<?php if($button_label) { ?>
				<a class="button" href="<?php echo get_category_link($category); ?>"><?php echo $button_label; ?></a>
			<?php } ?>
		</div>

		<?php
		$content = ob_get_contents();
		ob_end_clean();
	}

	wp_reset_query();

	$output = sprintf('<div%1$s class="%2$s publica-category bubble-module clearfix">%3$s</div>',
		('' !== $module_id ? sprintf(' id="%1$s"', esc_attr($module_id)) : ''),
		('' !== $module_class ? sprintf(' %1$s', esc_attr($module_class)) : ''),
		('' !== $content ? $content : '')
	);

	return $output;
}
add_shortcode('et_pb_publica_category', 'et_pb_publica_category');

/*
 * Publica Delicious
 */

function et_pb_delicious($atts) {

	extract(shortcode_atts(array(
		'title' => '',
		'amount' => 2,
		'username' => '',
		'button_label' => '',
		'module_id' => '',
		'module_class' => ''
	), $atts));

	if(!$username)
		return '';

	$transient_name = '_et_pb_delicious_' . $username . '_' . $amount;

	$links = get_transient($transient_name);

	if(!$links) {

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://feeds.delicious.com/v2/json/' . $username . '?count=' . $amount);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);

		$links = json_decode($output, true);

		set_transient($transient_name, $links, 60 * 30);

	}

	ob_start();
	?>

	<h2><?php echo $title; ?></h2>
	<div class="posts-container">
		<div class="clearfix">
			<?php foreach($links as $link) { ?>

				<div class="item">
					<h3><a href="<?php echo $link['u']; ?>" title="<?php echo $link['d']; ?>" target="_blank" rel="external"><?php echo $link['d']; ?></a></h3>
				</div>

			<?php } ?>
		</div>
		<?php if($button_label) { ?>
			<a class="button" rel="external" target="_blank" href="https://delicious.com/<?php echo $username; ?>"><?php echo $button_label; ?></a>
		<?php } ?>
	</div>

	<?php
	$content = ob_get_contents();
	ob_end_clean();

	$output = sprintf('<div%1$s class="%2$s publica-category bubble-module clearfix">%3$s</div>',
		('' !== $module_id ? sprintf(' id="%1$s"', esc_attr($module_id)) : ''),
		('' !== $module_class ? sprintf(' %1$s', esc_attr($module_class)) : ''),
		('' !== $content ? $content : '')
	);

	return $output;
}
add_shortcode('et_pb_delicious', 'et_pb_delicious');