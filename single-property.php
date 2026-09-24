<?php
 get_header();

 $post_id = get_the_ID();
 $author_id = get_post_field('post_author', $post_id);
 $author_name = get_the_author_meta('display_name', $author_id);
 $author_avatar_url = get_avatar_url($author_id, array('size' => 200));
 $images = array();
	for($i = 1; $i <= 4; $i++) {
	$img_url = get_field('property_image_' . $i, $post_id);
	if($img_url) {
		$images[] = $img_url;
	}
  }


$property_price = get_field('property_price', $post_id);
$property_price = number_format($property_price);
$property_bedrooms = get_field('property_bedrooms', $post_id);
$property_bathrooms = get_field('property_bathrooms', $post_id);
$property_sqft = get_field('property_sqft', $post_id);
$property_address = get_field('property_address', $post_id);
$latitude = get_field('latitude', $post_id);
$longitude = get_field('longitude', $post_id);
$property_status = get_field('property_status', $post_id);
$interior_architecture = get_field('interior_architecture_finishings', $post_id);
$kitchen_bath = get_field('kitchen_bath', $post_id);
$bathroom_storage = get_field('bedrooms_storage', $post_id);
$exterior_outdoor_living = get_field('exterior_outdoor_living', $post_id);
$garage_parking_location = get_field('garage_parking_location', $post_id);
$year_built = get_field('year_built', $post_id);
$garage_spaces = get_field('garage_spaces', $post_id);
$property_description = get_field('property_description', $post_id);
?>

<div class="keystone-single-property">
    <div class="keystone-property-gallery">
        <?php foreach($images as $index => $image_url) { ?>
			  <img class="single-property-image <?php echo $index == 0 ? 'is-active' : ''; ?>" src="<?php echo esc_url($image_url);?>" alt="">
		<?php  } ?>
        <div class="keystone-gallery-thumbnails">
        <?php foreach($images as $index => $image_url) { ?>
            <img class="gallery-thumbnail" data-index="<?php echo $index ?>" src="<?php echo esc_url($image_url);?>" alt="">
        <?php  } ?>
        </div>
    </div>
    <div class="keystone-property-layout">
        <div class="keystone-property-details">
            <div class="keystone-property-header">
                <div class="status-pill">
                    <span class="status-dot"></span>
                    For <?php echo esc_html($property_status); ?>
                </div>
                
                <h1 class="property-price">$<?php echo esc_html($property_price); ?></h1>
                
                <p class="property-address"><?php echo esc_html($property_address); ?></p>
            </div>
            <div class="keystone-property-specs-grid">
                <!-- Bedrooms -->
                <div class="spec-card">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>
                    <span><strong><?php echo $property_bedrooms; ?></strong> Beds</span>
                </div>

                <!-- Bathrooms -->
                <div class="spec-card">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>
                    <span><strong><?php echo $property_bathrooms; ?></strong> Baths</span>
                </div>

                <!-- Square Footage -->
                <div class="spec-card">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><path d="M9 3v18"/><path d="M15 3v18"/><path d="M3 9h18"/><path d="M3 15h18"/></svg>
                    <span><strong><?php echo $property_sqft; ?></strong> Sqft</span>
                </div>

                <!-- Year Built -->
                <div class="spec-card">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <span>Built in <strong><?php echo $year_built; ?></strong></span>
                </div>

                <!-- Garage Spaces -->
                <div class="spec-card">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 16H9m10 0h3v-3.15a1 1 0 0 0-.84-.99L16 11l-2.7-3.6a2 2 0 0 0-1.6-.8H8.3a2 2 0 0 0-1.6.8L4 11l-5.16.86a1 1 0 0 0-.84.99V16h3m10 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM7 16a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/></svg>
                    <span><strong><?php echo $garage_spaces; ?></strong> Garage Spaces</span>
                </div>

            </div>
            <div class="keystone-whats-special">
                <h3>What's special</h3>
                
                <div class="special-features-list">
                    <?php 
                    // 1. Loop through Interior Features
                    if( $interior_architecture ) {
                        foreach( $interior_architecture as $feature ) {
                            echo '<span class="feature-pill">' . esc_html($feature) . '</span>';
                        }
                    }
                    
                    // 2. Loop through Exterior Features
                    if( $exterior_outdoor_living ) {
                        foreach( $exterior_outdoor_living as $feature ) {
                            echo '<span class="feature-pill">' . esc_html($feature) . '</span>';
                        }
                    }
                    
                    // Add your other variables (kitchen_bath, etc.) using the same pattern here!
                    ?>
                </div>

                <div class="property-description">
                    <?php echo wp_kses_post($property_description); ?>
                </div>
            </div>
        </div>
        <div class="keystone-property-sidebar">
                <img class="keystone-property-agent-avatar" src="<?php echo $author_avatar_url ?>" alt="">
                <p><?php echo $author_name ?></p>
                <button class="keystone-contact-btn">Contact Agent</button>
        </div>
    </div>
</div>










<?php get_footer(); ?>