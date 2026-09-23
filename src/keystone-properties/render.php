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

$current_page_slug = get_post_field( 'post_name' );

// Map Markers - Get all properties WP Query

$args = array(
	'post_type' => 'property',
	'posts_per_page' => -1,
	'post_status' => 'publish',

);

if(is_page('buy')) {
		$args['meta_query'] = array(
			array(
				'key' => 'property_status',
				'value' => 'sale',
				'compare' => '='
			)
		);
	 } elseif(is_page('rent')) {
		$args['meta_query'] = array(
			array(
				'key' => 'property_status',
				'value' => 'rent',
				'compare' => '='
			)
		);
	 }

$properties = new WP_Query($args);

$card_count = 0;
$html_output = '';


if($properties->have_posts()) {
	while($properties->have_posts()) : $properties->the_post();
	    $current_post_id = get_the_ID();
		$latitude = get_field('latitude');
		$longitude = get_field('longitude');
		$map_markers[] = array(
	'title' => get_the_title(),
	'post_id' => $current_post_id,
	'lat' => $latitude,
	'lng' => $longitude
);
        $card_count++;
		if($card_count <= 6) {
			ob_start();
			get_template_part('src/keystone-property-card/render', null, array('card_post_id' => $current_post_id));
			$html_output .= ob_get_clean();
		}
	endwhile;
}

wp_reset_postdata();

wp_enqueue_style('keystone-property-card', get_theme_file_uri('src/keystone-property-card/style.css'), array(), time());
wp_enqueue_script_module('keystone-property-card-js', get_theme_file_uri('src/keystone-property-card/view.js'));

?>



<div class="keystone-map-interface" data-wp-on-window--click="actions.closeDropdown"
    data-page-type="<?php echo esc_attr($current_page_slug); ?>"
	data-wp-interactive="keystone-properties" data-wp-context='{"openDropdown": null}'>
	<div class="keystone-filter-bar">
		<div class="keystone-search-group">
			<input type="text" id="filter-search" placeholder="Address, neighborhood, city, ZIP">
			<button id="clear-button" style="display: none;"><span class="dashicons dashicons-no-alt"></span></button>
			<button id="location-button"><span class="dashicons dashicons-location-alt"></span></button>
			<button id="search-button"><span class="dashicons dashicons-search"></span></button>
			<div id="search-suggestions"></div>
	    </div>
		<div class="keystone-dropdown">
			<button class="keystone-dropdown-toggle"
			data-wp-on--click="actions.toggleDropdown"
			data-dropdown-id="status">Status &#9662;</button>
			<div class="keystone-dropdown-panel" data-wp-class--is-open="state.isDropdownOpen" 
			data-wp-context='{"id": "status"}'>
				<div class="values">
					<input type="radio" name="filter-status" value="" id="opt1">
					<label for="opt1">All</label>
					<input type="radio" name="filter-status" value="sale" id="opt2">
					<label for="opt2">For Sale</label>
					<input type="radio" name="filter-status" value="rent" id="opt3">
					<label for="opt3">For Rent</label>
				</div>
			</div>
		</div>
		<div class="keystone-dropdown">
			<button class="keystone-dropdown-toggle"
			data-wp-on--click="actions.toggleDropdown"
			data-dropdown-id="price">Price &#9662;</button>
			<div class="keystone-dropdown-panel" data-wp-class--is-open="state.isDropdownOpen" 
			data-wp-context='{"id": "price"}'>
				<div class="values">
					<span class="keystone-dropdown-label" id="price-range-1">$0</span>
				    <span class="keystone-dropdown-label" id="price-range-2">$10M+</span>
				</div>
				<div class="slider-track-container">
					<input type="range" class="keystone-price-range" id="filter-budget-1" min="0" max="10000000" step="100" value="0">
					<input type="range" class="keystone-price-range" id="filter-budget-2" min="0" max="10000000" step="100" value="10000000">
				</div>
				
			</div>
		</div>
		<div class="keystone-dropdown">
			<button class="keystone-dropdown-toggle"
			data-wp-on--click="actions.toggleDropdown"
			data-dropdown-id="beds">Bedrooms &#9662;</button>
			<div class="keystone-dropdown-panel" data-wp-class--is-open="state.isDropdownOpen"
			data-wp-context='{"id": "beds"}'>
				<div class="values values-centered">
					<span class="keystone-dropdown-label" id="beds-range-1">0</span>
				</div>
				<div class="slider-track-container">
					<input type="range" class="keystone-range" id="filter-beds" min="0" max="10" step="1" value="0">
				</div>
				
			</div>
		</div>
		<div class="keystone-dropdown">
			<button class="keystone-dropdown-toggle"
			data-wp-on--click="actions.toggleDropdown"
			data-dropdown-id="baths">Bathrooms &#9662;</button>
			<div class="keystone-dropdown-panel"
			data-wp-class--is-open="state.isDropdownOpen"
			data-wp-context='{"id": "baths"}'>
				<div class="values values-centered">
					<span class="keystone-dropdown-label" id="baths-range-1">0</span>
				</div>
				<div class="slider-track-container">
					<input type="range" class="keystone-range" id="filter-baths" min="0" max="10" step="1" value="0">
				</div>
			</div>
		</div>
	</div>

	<div class="keystone-split-stage">
		<div id="keystone-map-canvas" class="keystone-map-container" 
		 data-properties='<?php echo esc_attr(json_encode($map_markers)); ?>'></div>
		<div id="keystone-results-feed" class="keystone-results-container">
			<?php 
			  echo $html_output;
			?>
			<div id="keystone-loader" class="keystone-spinner">
			</div>
		</div>
	</div>
</div>
