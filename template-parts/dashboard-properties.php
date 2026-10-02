<?php 
$current_user_id = get_current_user_id();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'property',
    'posts_per_page' => 6,
    'author' => $current_user_id,
    'paged' => $paged
);

$properties = new WP_Query($args); ?>
<div class="dashboard-header">
    <h2>My Properties</h2>
    <a href="?tab=add-property" class="btn btn-primary">&#65291; Add New Property</a>
</div>
<?php if($properties->have_posts()): ?>

<div class="properties-grid">
<?php while($properties->have_posts()): $properties->the_post();
    $title = get_the_title();
    $image = get_field('property_image_1');
    $price = get_field('property_price');
    $status = get_field('property_status');
    $bedrooms = get_field('property_bedrooms');
    $bathrooms = get_field('property_bathrooms'); ?>


    <!-- STATIC PLACEHOLDER CARD (We will loop this with WP_Query tomorrow) -->
    <div class="property-card">
        <div class="property-card-image">
            <img src="<?php echo esc_url($image); ?>" alt="Property Image">
            <span class="status-badge published"><?php echo esc_html($status); ?></span>
        </div>
        <div class="property-card-content">
            <h3 class="property-title"><?php echo esc_html($title); ?></h3>
            <p class="property-price">$<?php echo esc_html(number_format($price)); ?></p>
            <div class="property-meta">
                <span><?php echo esc_html($bedrooms); ?> Beds</span> • <span><?php echo esc_html($bathrooms); ?> Baths</span>
            </div>
        </div>
        <div class="property-card-actions">
            <a href="?tab=edit-property&<?php echo get_the_ID(); ?>" class="btn btn-outline">Edit</a>
            <button class="btn btn-danger-outline">Delete</button>
        </div>
    </div>
    <!-- END PLACEHOLDER -->
    <?php endwhile; ?>
    </div>
    <div class="dashboard-pagination"><?php echo paginate_links(array('total' => $properties->max_num_pages)); ?></div>
<?php else:
    echo '<p>You have not added any properties yet.</p>';
endif;
wp_reset_postdata();

?>

