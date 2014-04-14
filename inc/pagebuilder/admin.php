<?php

/*
 * PUBLICA PAGE BUILDER
 * ADMIN
 */

/* 
 * PRE DEFINED INPUTS
 */

function publica_page_builder_regular_text($id, $title, $description) {
	?>
	<div class="et-pb-option">
		<label for="et_pb_<?php echo $id; ?>"><?php echo $title; ?>: </label>

		<div class="et-pb-option-container">
			<input id="et_pb_<?php echo $id; ?>" type="text" class="regular-text" value="<%= typeof( et_pb_<?php echo $id; ?> ) !== 'undefined' ?  et_pb_<?php echo $id; ?> : '' %>" />
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
	 * PUBLICA MODULE
	 */
	?>
	<script type="text/template" id="et-builder-et_pb_publica-module-template">
		<h3 class="et-pb-settings-heading">Blog Module Settings</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_fullwidth">Layout: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_fullwidth" id="et_pb_fullwidth">
						<option value="on"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'on' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>Fullwidth</option>
						<option value="off"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'off' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>Grid</option>
					</select>

					<p class="description">Toggle between the various blog layout types.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

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
