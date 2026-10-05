<?php 
  $property_id = '';
  $property_title = '';
  $property_description = '';
  $property_status = '';
  $property_price = '';
  $property_bedrooms = '';
  $property_bathrooms = '';
  $property_image_1 = '';
  $property_image_2 = '';
  $property_image_3 = '';
  $property_image_4 = '';
  $property_address = '';
  $latitude = '';
  $longitude = '';
  $interior_architecture_finishings = [];
  $kitchen_bath = [];
  $bedrooms_storage = [];
  $exterior_outdoor_living = [];
  $garage_parking_location = [];
  
  if(isset($_GET['property_id'])) {
    $property_id = $_GET['property_id'];
    $property = get_post($property_id);
    $property_title = $property->post_title;
    $property_description = get_post_meta($property_id, 'property_description', true);
    $property_status = get_post_meta($property_id, 'property_status', true);
    $property_price = get_post_meta($property_id, 'property_price', true);
    $property_bedrooms = get_post_meta($property_id, 'property_bedrooms', true);
    $property_bathrooms = get_post_meta($property_id, 'property_bathrooms', true);
    $property_image_1 = get_post_meta($property_id, 'property_image_1', true);
    $property_image_2 = get_post_meta($property_id, 'property_image_2', true);
    $property_image_3 = get_post_meta($property_id, 'property_image_3', true);
    $property_image_4 = get_post_meta($property_id, 'property_image_4', true);
    $property_address = get_post_meta($property_id, 'property_address', true);
    $latitude = get_post_meta($property_id, 'latitude', true);
    $longitude = get_post_meta($property_id, 'longitude', true);
    $interior_architecture_finishings = get_post_meta($property_id, 'interior_architecture_finishings', true);
    $kitchen_bath = get_post_meta($property_id, 'kitchen_bath', true);
    $bedrooms_storage = get_post_meta($property_id, 'bedrooms_storage', true);
    $exterior_outdoor_living = get_post_meta($property_id, 'exterior_outdoor_living', true);
    $garage_parking_location = get_post_meta($property_id, 'garage_parking_location', true);
  }

?>

<div class="dashboard-header">
    <h2>Add New Property</h2>
</div>

<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" id="property-submission-form" class="dashboard-form" enctype="multipart/form-data">   
<?php wp_nonce_field('agent_dashboard_nonce', 'security'); ?>
<input type="hidden" name="action" value="save_agent_property">
<input type="hidden" name="property_id" value="<?php echo esc_attr($property_id); ?>">
    <!-- Section 1: Basic Information -->
    <div class="form-section">
        <h3>Basic Information</h3>
        <div class="form-group">
            <label for="post_title">Property Title</label>
            <input type="text" value="<?php echo esc_attr($property_title); ?>" id="post_title" name="post_title" placeholder="e.g. Modern Downtown Loft" required>
        </div>
        <div class="form-group">
            <label for="property_description">Property Description</label>
            <textarea id="property_description" name="property_description" rows="5" required><?php echo esc_textarea($property_description); ?></textarea>
        </div>
        <div class="form-group">
            <label for="property_status">Property Status</label>
            <select id="property_status" name="property_status">
                <option value="sale" <?php selected($property_status, 'sale'); ?>>For Sale</option>
                <option value="rent" <?php selected($property_status, 'rent'); ?>>For Rent</option>
            </select>
        </div>
    </div>

    <!-- Section 2: Property Images -->
    <div class="form-section">
        <h3>Property Media</h3>
        <div class="form-row">
            <div class="form-group">
                <label for="property_image_1">Main Image (Featured)</label>
                <?php if(!empty($property_image_1)) { 
                    echo wp_get_attachment_image($property_image_1);
                } ?>
                <input type="file" id="property_image_1" name="property_image_1" accept="image/*">
            </div>
            <div class="form-group">
                <label for="property_image_2">Gallery Image 2</label>
                <?php if(!empty($property_image_2)) {
                    echo wp_get_attachment_image($property_image_2);
                } ?>
                <input type="file" id="property_image_2" name="property_image_2" accept="image/*">
            </div>
            <div class="form-group">
                <label for="property_image_3">Gallery Image 3</label>
                <?php if(!empty($property_image_3)) {
                    echo wp_get_attachment_image($property_image_3);
                } ?>
                <input type="file" id="property_image_3" name="property_image_3" accept="image/*">
            </div>
            <div class="form-group">
                <label for="property_image_4">Gallery Image 4</label>
                <?php if(!empty($property_image_4)) {
                    echo wp_get_attachment_image($property_image_4);
                } ?>
                <input type="file" id="property_image_4" name="property_image_4" accept="image/*">
            </div>
        </div>
    </div>

    <!-- Section 3: Core Details -->
    <div class="form-section">
        <h3>Core Details</h3>
        <div class="form-row">
            <div class="form-group">
                <label for="property_price">Price ($)</label>
                <input value="<?php echo esc_attr($property_price); ?>" type="number" id="property_price" name="property_price" required>
            </div>
            <div class="form-group">
                <label for="property_sqft">Square Footage</label>
                <input value="<?php echo esc_attr($property_sqft); ?>" type="number" id="property_sqft" name="property_sqft">
            </div>
            <div class="form-group">
                <label for="property_bedrooms">Bedrooms</label>
                <input value="<?php echo esc_attr($property_bedrooms); ?>" type="number" id="property_bedrooms" name="property_bedrooms">
            </div>
            <div class="form-group">
                <label for="property_bathrooms">Bathrooms</label>
                <input value="<?php echo esc_attr($property_bathrooms); ?>" type="number" id="property_bathrooms" name="property_bathrooms" step="0.5">
            </div>
            <div class="form-group">
                <label for="year_built">Year Built</label>
                <input value="<?php echo esc_attr($year_built); ?>" type="number" id="year_built" name="year_built">
            </div>
            <div class="form-group">
                <label for="garage_spaces">Garage Spaces</label>
                <input value="<?php echo esc_attr($garage_spaces); ?>" type="number" id="garage_spaces" name="garage_spaces">
            </div>
        </div>
    </div>

    <!-- Section 4: Amenities & Features -->
    <div class="form-section">
        <h3>Features & Amenities</h3>
        <div class="amenities-container">
            
            <!-- Category 1 -->
            <details class="amenity-category">
                <summary>Interior Architecture & Finishings</summary>
                <div class="checkbox-grid">
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('High Ceilings', $interior_architecture_finishings) ? 'checked' : '' ?> type="checkbox" name="interior_architecture_finishings[]" value="High Ceilings"> High Ceilings</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Tasteful Finishes', $interior_architecture_finishings) ? 'checked' : '' ?> type="checkbox" name="interior_architecture_finishings[]" value="Tasteful Finishes"> Tasteful Finishes</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Open Concept Layout', $interior_architecture_finishings) ? 'checked' : '' ?> type="checkbox" name="interior_architecture_finishings[]" value="Open Concept Layout"> Open Concept Layout</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Newly Renovated', $interior_architecture_finishings) ? 'checked' : '' ?> type="checkbox" name="interior_architecture_finishings[]" value="Newly Renovated"> Newly Renovated</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Hardwood Flooring', $interior_architecture_finishings) ? 'checked' : '' ?> type="checkbox" name="interior_architecture_finishings[]" value="Hardwood Flooring"> Hardwood Flooring</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Custom Built-ins', $interior_architecture_finishings) ? 'checked' : '' ?> type="checkbox" name="interior_architecture_finishings[]" value="Custom Built-ins"> Custom Built-ins</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Smart Home Technology', $interior_architecture_finishings) ? 'checked' : '' ?> type="checkbox" name="interior_architecture_finishings[]" value="Smart Home Technology"> Smart Home Technology</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Central Air Conditioning', $interior_architecture_finishings) ? 'checked' : '' ?> type="checkbox" name="interior_architecture_finishings[]" value="Central Air Conditioning"> Central Air Conditioning</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Energy Efficient Windows', $interior_architecture_finishings) ? 'checked' : '' ?> type="checkbox" name="interior_architecture_finishings[]" value="Energy Efficient Windows"> Energy Efficient Windows</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Finished / Walk-out Basement', $interior_architecture_finishings) ? 'checked' : '' ?> type="checkbox" name="interior_architecture_finishings[]" value="Finished / Walk-out Basement"> Finished / Walk-out Basement</label>
                    </div>
                </div>
            </details>

            <!-- Category 2 -->
            <details class="amenity-category">
                <summary>Kitchen & Bath</summary>
                <div class="checkbox-grid">
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Chef\'s Kitchen', $kitchen_bath) ? 'checked' : '' ?> type="checkbox" name="kitchen_bath[]" value="Chef's Kitchen"> Chef's Kitchen</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Stainless Steel Appliances', $kitchen_bath) ? 'checked' : '' ?> type="checkbox" name="kitchen_bath[]" value="Stainless Steel Appliances"> Stainless Steel Appliances</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Granite / Quartz Countertops', $kitchen_bath) ? 'checked' : '' ?> type="checkbox" name="kitchen_bath[]" value="Granite / Quartz Countertops"> Granite / Quartz Countertops</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Walk-in Pantry', $kitchen_bath) ? 'checked' : '' ?> type="checkbox" name="kitchen_bath[]" value="Walk-in Pantry"> Walk-in Pantry</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Large Kitchen Island', $kitchen_bath) ? 'checked' : '' ?> type="checkbox" name="kitchen_bath[]" value="Large Kitchen Island"> Large Kitchen Island</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Spa-like Master Bath', $kitchen_bath) ? 'checked' : '' ?> type="checkbox" name="kitchen_bath[]" value="Spa-like Master Bath"> Spa-like Master Bath</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Dual Vanities', $kitchen_bath) ? 'checked' : '' ?> type="checkbox" name="kitchen_bath[]" value="Dual Vanities"> Dual Vanities</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Radiant Floor Heating', $kitchen_bath) ? 'checked' : '' ?> type="checkbox" name="kitchen_bath[]" value="Radiant Floor Heating"> Radiant Floor Heating</label>
                    </div>
                </div>
            </details>

            <!-- Category 3 -->
            <details class="amenity-category">
                <summary>Bedrooms & Storage</summary>
                <div class="checkbox-grid">
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Three Additional Spacious Bedrooms', $bedrooms_storage) ? 'checked' : '' ?> type="checkbox" name="bedrooms_storage[]" value="Three Additional Spacious Bedrooms"> Three Additional Spacious Bedrooms</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Massive Walk-in Closets', $bedrooms_storage) ? 'checked' : '' ?> type="checkbox" name="bedrooms_storage[]" value="Massive Walk-in Closets"> Massive Walk-in Closets</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('First-Floor Master Suite', $bedrooms_storage) ? 'checked' : '' ?> type="checkbox" name="bedrooms_storage[]" value="First-Floor Master Suite"> First-Floor Master Suite</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Oversized Attic Storage', $bedrooms_storage) ? 'checked' : '' ?> type="checkbox" name="bedrooms_storage[]" value="Oversized Attic Storage"> Oversized Attic Storage</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Custom Wardrobe Shelving', $bedrooms_storage) ? 'checked' : '' ?> type="checkbox" name="bedrooms_storage[]" value="Custom Wardrobe Shelving"> Custom Wardrobe Shelving</label>
                    </div>
                </div>
            </details>

            <!-- Category 4 -->
            <details class="amenity-category">
                <summary>Exterior & Outdoor Living</summary>
                <div class="checkbox-grid">
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Large Paved Private Backyard', $exterior_outdoor_living) ? 'checked' : '' ?> type="checkbox" name="exterior_outdoor_living[]" value="Large Paved Private Backyard"> Large Paved Private Backyard</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Outdoor Kitchen', $exterior_outdoor_living) ? 'checked' : '' ?> type="checkbox" name="exterior_outdoor_living[]" value="Outdoor Kitchen"> Outdoor Kitchen</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Swimming Pool', $exterior_outdoor_living) ? 'checked' : '' ?> type="checkbox" name="exterior_outdoor_living[]" value="Swimming Pool"> Swimming Pool</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Hot Tub / Spa', $exterior_outdoor_living) ? 'checked' : '' ?> type="checkbox" name="exterior_outdoor_living[]" value="Hot Tub / Spa"> Hot Tub / Spa</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Wrap-around Porch', $exterior_outdoor_living) ? 'checked' : '' ?> type="checkbox" name="exterior_outdoor_living[]" value="Wrap-around Porch"> Wrap-around Porch</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Deck / Patio Entertaining Area', $exterior_outdoor_living) ? 'checked' : '' ?> type="checkbox" name="exterior_outdoor_living[]" value="Deck / Patio Entertaining Area"> Deck / Patio Entertaining Area</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Fully Fenced Yard', $exterior_outdoor_living) ? 'checked' : '' ?> type="checkbox" name="exterior_outdoor_living[]" value="Fully Fenced Yard"> Fully Fenced Yard</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Professionally Landscaped', $exterior_outdoor_living) ? 'checked' : '' ?> type="checkbox" name="exterior_outdoor_living[]" value="Professionally Landscaped"> Professionally Landscaped</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Fire Pit', $exterior_outdoor_living) ? 'checked' : '' ?> type="checkbox" name="exterior_outdoor_living[]" value="Fire Pit"> Fire Pit</label>
                    </div>
                </div>
            </details>

            <!-- Category 5 -->
            <details class="amenity-category">
                <summary>Garage, Parking & Location</summary>
                <div class="checkbox-grid">
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Detached Garage', $garage_parking_location) ? 'checked' : '' ?> type="checkbox" name="garage_parking_location[]" value="Detached Garage"> Detached Garage</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Attached Garage', $garage_parking_location) ? 'checked' : '' ?> type="checkbox" name="garage_parking_location[]" value="Attached Garage"> Attached Garage</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('RV / Boat Parking', $garage_parking_location) ? 'checked' : '' ?> type="checkbox" name="garage_parking_location[]" value="RV / Boat Parking"> RV / Boat Parking</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('EV Charging Station', $garage_parking_location) ? 'checked' : '' ?> type="checkbox" name="garage_parking_location[]" value="EV Charging Station"> EV Charging Station</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Quiet Cul-de-sac', $garage_parking_location) ? 'checked' : '' ?> type="checkbox" name="garage_parking_location[]" value="Quiet Cul-de-sac"> Quiet Cul-de-sac</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Gated Community', $garage_parking_location) ? 'checked' : '' ?> type="checkbox" name="garage_parking_location[]" value="Gated Community"> Gated Community</label>
                    </div>
                    <div class="checkbox-group">
                        <label><input <?php echo in_array('Waterfront / Lake View', $garage_parking_location) ? 'checked' : '' ?> type="checkbox" name="garage_parking_location[]" value="Waterfront / Lake View"> Waterfront / Lake View</label>
                    </div>
                </div>
            </details>

        </div>
    </div>

    <!-- Section 5: Location & Map Synchronization -->
    <div class="form-section">
        <h3>Location</h3>
        <div class="form-group">
            <label for="property_address">Full Street Address</label>
            <textarea id="property_address" name="property_address" rows="2"><?php echo esc_textarea($property_address); ?></textarea>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="latitude">Latitude</label>
                <input value="<?php echo esc_attr($latitude); ?>" type="number" id="latitude" name="latitude" step="any" placeholder="e.g. 40.7128">
            </div>
            <div class="form-group">
                <label for="longitude">Longitude</label>
                <input value="<?php echo esc_attr($longitude); ?>" type="number" id="longitude" name="longitude" step="any" placeholder="e.g. -74.0060">
            </div>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary btn-large">Save Property</button>
    </div>
</form>