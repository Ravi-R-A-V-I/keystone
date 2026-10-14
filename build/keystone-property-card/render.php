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

$card_post_id = isset($args['card_post_id']) ? $args['card_post_id'] : get_the_ID();
$images = array();
	for($i = 1; $i <= 4; $i++) {
	$img_url = get_field('property_image_' . $i, $card_post_id);
	if($img_url) {
		$images[] = $img_url;
	}
  }


$property_price = get_field('property_price', $card_post_id);
$property_price = number_format($property_price);
$property_bedrooms = get_field('property_bedrooms', $card_post_id);
$property_bathrooms = get_field('property_bathrooms', $card_post_id);
$property_sqft = get_field('property_sqft', $card_post_id);
$property_address = get_field('property_address', $card_post_id);
$latitude = get_field('latitude', $card_post_id);
$longitude = get_field('longitude', $card_post_id);
$property_status = get_field('property_status', $card_post_id);


$user_id = get_current_user_id();
$favorites = get_user_meta($user_id, 'favorite_properties', true);
$current_post_id = $card_post_id;

if(empty($favorites)) {
	$favorites = array();
}

if(in_array($current_post_id, $favorites)) {
	$is_favorited = true;
} else {
	$is_favorited = false;
}


 
?>
<div class="property-card" data-post-id="<?php echo esc_attr($card_post_id); ?>">
	<div>

	  <?php foreach($images as $index => $image_url) { ?>
			  <img class="property-image <?php echo $index == 0 ? 'is-active' : ''; ?>" src="<?php echo esc_url($image_url);?>" alt="">
		<?php  } ?>
		<button class="gallery__arrow gallery__arrow--prev">&#10094;</button>
		<button class="gallery__arrow gallery__arrow--next">&#10095;</button>
		<div class="gallery-indicators">
	  <?php foreach($images as $index => $image_url) { ?>
	          <span class="gallery-dot <?php echo $index == 0 ? 'is-active' : ''; ?>"></span>
	  <?php  } ?>
		</div>
		
		<div>
		  <button class="favorite-btn <?php echo $is_favorited ? 'is-favorited' : ''; ?>">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
			<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
			</svg>  
		  </button>
		</div>
		 
	</div>
	<div>
	  <a href="<?php echo esc_url( get_permalink( $card_post_id ) ); ?>" class="property-card-link">
		<h2>$<?php echo $property_price ?></h2>
		<p>
			<span><?php echo $property_bedrooms ?> bds</span> | 
			<span><?php echo $property_bathrooms ?> ba</span> | 
			<span><?php echo $property_sqft ?> sqft</span> | 
			<span><?php echo $property_status ?></span>
		</p>
		<p><?php echo $property_address ?></p>
	  </a>
	</div>
	
</div>
