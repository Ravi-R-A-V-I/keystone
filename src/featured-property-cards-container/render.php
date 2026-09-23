<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Generates a unique id for aria-controls.
$unique_id = wp_unique_id( 'p-' );

// Adds the global state.
wp_interactivity_state(
	'create-block',
	array()
);
?>


<div <?php echo get_block_wrapper_attributes(array('class' => 'featured-properties-container', 
    'data-wp-interactive' => 'keystone/property-slider'));
 ?>>
	<button data-wp-on--click="actions.scrollLeft" class="featured-properties-btn prev-btn">&#10094;</button>
	<div class="featured-properties-track"><?php echo $content; ?></div>
	<button data-wp-on--click="actions.scrollRight" class="featured-properties-btn next-btn">&#10095;</button>
</div>