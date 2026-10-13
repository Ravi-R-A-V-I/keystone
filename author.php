<?php 
 get_header();


 $current_agent = get_queried_object();
 $first_name = $current_agent->first_name;
 $last_name = $current_agent->last_name;
 $avatar_url = get_user_meta($current_agent->ID, 'avatar_url', true);
 $bio = get_user_meta($current_agent->ID, 'description', true);
 $email = get_user_meta($current_agent->ID, 'public_email', true);
 $phone = get_user_meta($current_agent->ID, 'phone', true);
 $license = get_user_meta($current_agent->ID, 'license', true);
 $linkedIn = get_user_meta($current_agent->ID, 'linkedIn', true);
 $instagram = get_user_meta($current_agent->ID, 'instagram', true);
 $website = get_user_meta($current_agent->ID, 'website', true);

 $sale_args = array(
                'post_type' => 'property',
                'author' => $current_agent->ID,
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'property_status',
                        'value' => 'sale',
                        'compare' => '='
                    )
                )
            );

 $rent_args = array(
                'post_type' => 'property',
                'author' => $current_agent->ID,
                'posts_per_page' => -1,
                'meta_query' => array(
                    array(
                        'key' => 'property_status',
                        'value' => 'rent',
                        'compare' => '='
                    )
                )
 );

 $sale_query = new WP_Query($sale_args);
 $rent_query = new WP_Query($rent_args);
?>


<div class="profile-master-wrap">
    <div class="profile-business-card">
        <div class="card-avatar">
            <?php
             if($avatar_url) {
                echo '<img src="' . esc_url($avatar_url) . '" alt="Agent Avatar">';
             } else {
                echo get_avatar($current_agent->ID, 120);
             }
            ?>
        </div>
        <div class="contact-info">
            <h2><?php echo $first_name . ' ' . $last_name; ?></h2>
            <div class="agent-contact-info">
                <div class="contact-row">
                    <?php if($email) echo '<a href="mailto:' . $email . '"><p><span class="dashicons dashicons-email-alt"></span> ' . $email . '</p></a>'; ?>
                    <?php if($phone) echo '<a href="tel:' . $phone . '"><p><span class="dashicons dashicons-phone"></span> ' . $phone . '</p></a>'; ?>
                    <?php if($license) echo '<p><span class="dashicons dashicons-clipboard"></span> ' . $license . '</p>'; ?>
                </div>
                <div class="social-row">
                    <?php if($linkedIn) echo '<a href="' . $linkedIn . '"><span class="dashicons dashicons-linkedin"></span></a>'; ?>
                    <?php if($instagram) echo '<a href="' . $instagram . '"><span class="dashicons dashicons-instagram"></span></a>'; ?>
                    <?php if($website) echo '<a href="' . $website . '"><span class="dashicons dashicons-admin-site"></span></a>'; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-about-section">
        <h3>About Me</h3>
        <p> <?php if($bio) echo $bio; ?> </p>
        <button class="read-more-toggle">Read more</button>
    </div>
    <div class="profile-listings-sale">
        <div class= "listings-header">
            <div>
                <h2>For Sale</h2>
            </div>
            <div class="slider-controls">
                <span class="nav-arrow">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </span>
                <span class="nav-arrow">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </span>
            </div>
        </div>
        <div class="listings-track">
            <?php 
             while($sale_query->have_posts()) {
                $sale_query->the_post();
                $property_id = get_the_ID();
                $image = get_field('property_image_1');
                $price = get_field('property_price');
                $property_address = get_field('property_address');
                $bedrooms = get_field('property_bedrooms');
                $bathrooms = get_field('property_bathrooms');
                $sqft = get_field('property_sqft'); ?>
                
                <div class="simple-property-card">
                    <div class="feature-image">
                        <?php if($image) echo '<a href="' . get_the_permalink() . '"><img src="' . esc_url($image) . '" alt="Property Image"></a>'; ?>
                    </div>
                    <div class="property-details">
                        <h3 class="property-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <p class="property-price">$<?php echo esc_html(number_format($price)); ?></p>
                        <p class="property-address"><?php echo esc_html($property_address); ?></p>
                        <div class="property-meta">
                            <span><?php echo esc_html($bedrooms); ?> Beds</span> • <span><?php echo esc_html($bathrooms); ?> Baths</span> • <span><?php echo esc_html($sqft); ?> Sqft</span>
                        </div>
                    </div>
                </div>
            
            <?php }
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <div class="profile-listings-rent">
        <div class= "listings-header">
            <div>
                <h2>For Rent</h2>
            </div>
            <div class="slider-controls">
                <span class="nav-arrow">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </span>
                <span class="nav-arrow">
                    <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </span>
            </div>
        </div>
        <div class="listings-track">
            <?php 
             while($rent_query->have_posts()) {
                $rent_query->the_post();
                $property_id = get_the_ID();
                $image = get_field('property_image_1');
                $price = get_field('property_price');
                $property_address = get_field('property_address');
                $bedrooms = get_field('property_bedrooms');
                $bathrooms = get_field('property_bathrooms');
                $sqft = get_field('property_sqft'); ?>
                
                <div class="simple-property-card">
                    <div class="feature-image">
                        <?php if($image) echo '<a href="' . get_the_permalink() . '"><img src="' . esc_url($image) . '" alt="Property Image"></a>'; ?>
                    </div>
                    <div class="property-details">
                        <h3 class="property-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                        <p class="property-price">$<?php echo esc_html(number_format($price)); ?></p>
                        <p class="property-address"><?php echo esc_html($property_address); ?></p>
                        <div class="property-meta">
                            <span><?php echo esc_html($bedrooms); ?> Beds</span> • <span><?php echo esc_html($bathrooms); ?> Baths</span> • <span><?php echo esc_html($sqft); ?> Sqft</span>
                        </div>
                    </div>
                </div>
            
            <?php }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>

















<?php get_footer(); ?>