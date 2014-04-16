<?php

/*
 * PUBLICA PAGE BUILDER
 * ADMIN
 */

/* 
 * PRE DEFINED INPUTS
 */

function publica_page_builder_regular_text($id, $title, $description, $default_value = '') {
	?>
	<div class="et-pb-option">
		<label for="et_pb_<?php echo $id; ?>"><?php echo $title; ?>: </label>

		<div class="et-pb-option-container">
			<input id="et_pb_<?php echo $id; ?>" type="text" class="regular-text" value="<%= typeof( et_pb_<?php echo $id; ?> ) !== 'undefined' ?  et_pb_<?php echo $id; ?> : '<?php echo $default_value; ?>' %>" />
			<?php if($description) : ?>
				<p class="description"><?php echo $description; ?></p>
			<?php endif; ?>
		</div> <!-- .et-pb-option-container -->
	</div> <!-- .et-pb-option -->
	<?php
}

function publica_page_builder_admin_label() {
	?>
	<div class="et-pb-option">
		<label for="admin_label">Admin Label: </label>

		<div class="et-pb-option-container">
			<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
			<p class="description">This will change the label of the module in the builder for easy identification.</p>
		</div> <!-- .et-pb-option-container -->
	</div> <!-- .et-pb-option -->
	<?php
}

function publica_page_builder_regular_inputs() {
	publica_page_builder_admin_label();
	publica_page_builder_regular_text('module_id', 'CSS ID', 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.');
	publica_page_builder_regular_text('module_css', 'CSS Class', 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.');
}

/*
 * BUILDER
 */

function publica_page_builder() {
	/*
	 * POST
	 */
	?>
	<script type="text/template" id="et-builder-et_pb_post-module-template">
		<h3 class="et-pb-settings-heading">Post Module Settings</h3>

		<div class="et-pb-main-settings">
			<?php publica_page_builder_regular_text('post_id', 'Post ID', 'Enter the post ID'); ?>

			<div class="et-pb-option">
				<label for="et_pb_display_thumbnail">Display thumbnail: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_display_thumbnail" id="et_pb_display_thumbnail">
						<option value="on"<%= typeof( et_pb_display_thumbnail ) !== 'undefined' && 'on' === et_pb_display_thumbnail ?  ' selected="selected"' : '' %>>Yes</option>
						<option value="off"<%= typeof( et_pb_display_thumbnail ) !== 'undefined' && 'off' === et_pb_display_thumbnail ?  ' selected="selected"' : '' %>>No</option>
					</select>

					<p class="description">This setting will turn on and off the thumbnail display for this post.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<?php publica_page_builder_regular_text('title', 'Title', 'Overwrite the original post title'); ?>
			<?php publica_page_builder_regular_text('description', 'Description', 'Overwrite the original post excerpt'); ?>

			<div class="et-pb-option">
				<label for="et_pb_thumbnail">Custom thumbnail: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_thumbnail" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_thumbnail ) !== 'undefined' ?  et_pb_thumbnail : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='Upload an image' data-choose="Choose a Background Image" data-update="Set As Background" data-type="image" />
					<p class="description">If defined, this image will replace the original post thumbnail for this module. To remove a background image, simply delete the URL from the settings field.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<?php publica_page_builder_regular_inputs(); ?>

		</div>
	</script>
	<?php
	/*
	 * PUBLICA CATEGORY
	 */
	?>
	<script type="text/template" id="et-builder-et_pb_publica_category-module-template">
		<h3 class="et-pb-settings-heading">Categoria Module Settings</h3>
		<div class="et-pb-main-settings">

			<?php publica_page_builder_regular_text('title', 'Title', 'Define a title for this module'); ?>

			<div class="et-pb-option">
				<label for="et_pb_current_assuntos">Categoria: </label>
				<div class="et-pb-option-container">
				<% var et_pb_category_temp = typeof et_pb_category !== 'undefined' ? et_pb_category : ''; %>
					<?php
					$cats_array = get_terms( 'category' );
					foreach ( $cats_array as $categs ) {
						printf( '<label><input type="radio" name="et_pb_category" value="%1$s"%3$s> %2$s</label><br/>',
							esc_attr( $categs->term_id ),
							esc_html( $categs->name ),
							'<%= et_pb_category_temp == "' . $categs->term_id . '" ? checked="checked" : "" %>'
						);
					}
					?>
					<p class="description">Selecione a categoria.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<?php publica_page_builder_regular_text('amount', 'Amount of posts', 'Define the amount of posts to display', 2); ?>

			<?php publica_page_builder_regular_text('button_label', 'Button label', 'Write a label to the category link button', 'Read more'); ?>

			<?php publica_page_builder_regular_inputs(); ?>

		</div>
	</script>
	<?php
	/*
	 * PUBLICA SUMMARY
	 */
	?>
	<script type="text/template" id="et-builder-et_pb_publica_summary-module-template">
		<h3 class="et-pb-settings-heading">Publica Summary Module Settings</h3>
		<div class="et-pb-main-settings">

			<div class="et-pb-option">
				<label for="et_pb_current_assuntos">Temas do momento: </label>
				<div class="et-pb-option-container">
				<% var et_pb_current_assuntos_temp = typeof et_pb_current_assuntos !== 'undefined' ? et_pb_current_assuntos.split( ',' ) : []; %>
					<?php
					$cats_array = get_terms( 'assunto' );
					foreach ( $cats_array as $categs ) {
						printf( '<label><input type="checkbox" name="et_pb_current_assuntos" value="%1$s"%3$s> %2$s</label><br/>',
							esc_attr( $categs->term_id ),
							esc_html( $categs->name ),
							'<%= _.contains( et_pb_current_assuntos_temp, "' . $categs->term_id . '" ) ? checked="checked" : "" %>'
						);
					}
					?>
					<p class="description">Selecione os assuntos para incluir a aba "Temas do momento".</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<?php publica_page_builder_regular_inputs(); ?>

		</div>
	</script>
	<?php

	/*
	 * PUBLICA SLIDER
	 */
	?>
	<script type="text/template" id="et-builder-et_pb_publica_slider-module-template">
		<h3 class="et-pb-settings-heading">Publica Slider Module Settings</h3>
		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_publica_slide">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>Add New Slide</span></a>
			</div> <!-- .et-pb-option -->
			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">Content: </label>

				<div class="et-pb-option-container">
					<textarea id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></textarea>
					<p class="description">Here you can define the text content that will be used in this slide.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
			<div class="et-pb-option">
				<label for="et_pb_background_color">Background Color: </label>

				<div class="et-pb-option-container">

					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="Hex Value" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '#111111' %>" />
					<p class="description">Use the color picker to choose a background color for this module.</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<?php publica_page_builder_regular_inputs(); ?>

		</div>
	</script>
	<?php
	/* 
	 * PUBLICA SINGLE SLIDE
	 */
	?>
	<script type="text/template" id="et-builder-advanced-setting-et_pb_publica_slide-title">
		<%= typeof( et_pb_heading ) !== 'undefined' && typeof( et_pb_heading ) === 'string' ?  et_pb_heading : (typeof(et_pb_post_id) !== 'undefined' ? 'Post: ' + et_pb_post_id : 'New slide') %>
	</script>
	<script type="text/template" id="et-builder-advanced-setting-et_pb_publica_slide">
		<h3 class="et-pb-settings-heading">Slide Settings</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_post_id">Post ID: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_post_id" type="text" class="regular-text" value="<%= typeof( et_pb_post_id ) !== 'undefined' ?  et_pb_post_id : '' %>" />

					<p class="description">Use a post ID to preset the values bellow. They can be overwritten by filling other inputs.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<?php publica_page_builder_regular_text('heading', 'Heading', 'Define the title text for your slide'); ?>
			<?php publica_page_builder_regular_text('assunto', 'Assunto', 'Escreva um assunto referente a esse conteúdo.'); ?>
			<?php publica_page_builder_regular_text('description', 'Description', 'Write a small description for the slide.'); ?>
			<?php publica_page_builder_regular_text('url', 'URL', 'Define the slide URL.'); ?>

			<div class="et-pb-option">
				<label for="et_pb_background_image">Background Image: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_background_image" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_background_image ) !== 'undefined' ?  et_pb_background_image : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='Upload an image' data-choose="Choose a Background Image" data-update="Set As Background" data-type="image" />
					<p class="description">If defined, this image will be used as the background for this module. To remove a background image, simply delete the URL from the settings field.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>
	<?php
}
add_action('et_pb_before_page_builder', 'publica_page_builder');
