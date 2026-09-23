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
	array());

// ACF Variables
$images = array();
	for($i = 1; $i <= 4; $i++) {
	$img_url = get_field('property_image_' . $i);
	if($img_url) {
		$images[] = $img_url;
	}
  }

$property_price = get_field('property_price');
$property_price = number_format($property_price);
$property_bedrooms = get_field('property_bedrooms');
$property_bathrooms = get_field('property_bathrooms');
$property_sqft = get_field('property_sqft');
$property_address = get_field('property_address');
$latitude = get_field('latitude');
$longitude = get_field('longitude');
$property_status = get_field('property_status');

 
?>

