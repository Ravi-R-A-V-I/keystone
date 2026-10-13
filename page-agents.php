<?php 

get_header();

$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'role' => 'real_estate_agent',
    'number' => 10,
    'paged' => $current_page
);

if(!empty($_GET['agent_query'])) {
    $agent_query = sanitize_text_field($_GET['agent_query']);
    $args['meta_query'] = array(
        'relation' => 'OR',
        array(
            'key' => 'first_name',
            'value' => $agent_query,
            'compare' => 'LIKE'
        ),
        array(
            'key' => 'last_name',
            'value' => $agent_query,
            'compare' => 'LIKE'
        ),
        array(
            'key' => 'public_email',
            'value' => $agent_query,
            'compare' => 'LIKE'
        ),
        array(
            'key' => 'phone',
            'value' => $agent_query,
            'compare' => 'LIKE'
        )
    );
}

$user_query = new WP_User_Query($args);

?>
<div class="agents-page">
<form class="agent-search-form" action="/agents" method="GET">
    <input type="text" name="agent_query" placeholder="Search by Name, Email, Phone">
    <button type="submit">Search</button>
</form>
<div class="agent-grid">
  <?php foreach($user_query->get_results() as $agent) { ?>
    <div class="agent-card">
        <?php $first_name = get_user_meta($agent->ID, 'first_name', true);
        $last_name = get_user_meta($agent->ID, 'last_name', true);
        $bio = get_user_meta($agent->ID, 'description', true);
        $avatar_url = get_user_meta($agent->ID, 'avatar_url', true);
        $email = get_user_meta($agent->ID, 'public_email', true);
        $phone = get_user_meta($agent->ID, 'phone', true);
        $license = get_user_meta($agent->ID, 'license', true);
        $linkedIn = get_user_meta($agent->ID, 'linkedIn', true);
        $instagram = get_user_meta($agent->ID, 'instagram', true);
        $website = get_user_meta($agent->ID, 'website', true); ?>
        <!-- LEFT SIDE: Image Only -->
        <div class="agent-card-image">
            <?php 
            if($avatar_url) {
                echo '<img src="' . esc_url($avatar_url) . '" alt="Agent Avatar">';
            } else {
                echo get_avatar($agent->ID, 120);
            } 
            ?>
        </div>

        <!-- RIGHT SIDE: All Text and Links -->
        <div class="agent-card-details">
            
            <a href="<?php
             echo esc_url(get_author_posts_url($agent->ID));
            ?>">
             <h3>
                <?php 
                if($first_name && $last_name) {
                    echo esc_html($first_name . ' ' . $last_name);
                } else {
                    echo esc_html($agent->display_name);
                } 
                ?>
             </h3>
            </a>
            
            <p><?php if($bio) echo esc_html(wp_trim_words($bio, 20)); ?></p>

            <div class="agent-contact-info">
               <div class="contact-row">
                <?php 
                 if($email) echo '<a href="mailto:' . esc_attr($email) . '"><p><span class="dashicons dashicons-email-alt"></span> ' . esc_html($email) . '</p></a>';
                 if($phone) echo '<a href="tel:' . esc_attr($phone) . '"><p><span class="dashicons dashicons-phone"></span> ' . esc_html($phone) . '</p></a>';
                ?>
                
               </div>
                <?php 
                 if($license) echo '<p><span class="dashicons dashicons-clipboard"></span> ' . esc_html($license) . '</p>';
                ?>
            </div>

            <div class="agent-social-links">
                <?php
                if($linkedIn) { echo '<a href="' . esc_url($linkedIn) . '"><span class="dashicons dashicons-linkedin"></span></a>'; }
                if($instagram) { echo '<a href="' . esc_url($instagram) . '"><span class="dashicons dashicons-instagram"></span></a>'; }
                if($website) { echo '<a href="' . esc_url($website) . '"><span class="dashicons dashicons-admin-site"></span></a>'; }
                ?>
            </div>

        </div> <!-- Close right side details -->
    </div> <!-- Close agent card -->
  <?php } ?>
</div>
</div>
<?php 
if($user_query->get_total() > 10) {
    echo '<div class="agent-pagination">';
    echo paginate_links(array(
        'current' => $current_page,
        'total' => ceil($user_query->get_total() / 10)
    ));
    echo '</div>';
}
?>















<?php get_footer(); ?>