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

$size = isset($attributes['size']) ? $attributes['size'] : 'medium';
$alignment = isset($attributes['alignment']) ? $attributes['alignment'] : 'center';

$dynamic_classes = 'keystone-search-group size-' . esc_attr($size) . ' align-' . esc_attr($alignment);
$wrapper_attributes = get_block_wrapper_attributes();

?>

<div <?php echo $wrapper_attributes; ?>>
	<div class="<?php echo $dynamic_classes; ?>">
		<input type="text" id="filter-search" placeholder="Address, neighborhood, city, ZIP" />
		<button id="clear-button" style="display: none;"><span class="dashicons dashicons-no-alt"></span></button>
		<button id="location-button"><span class="dashicons dashicons-location-alt"></span></button>
		<button id="search-button"><span class="dashicons dashicons-search"></span></button>
		<div id="search-suggestions"></div>
	</div>
</div>
