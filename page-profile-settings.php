<?php 


 if(!is_user_logged_in()) {
    $login_page = home_url('/login');
    $redirect_url = add_query_arg('redirect_to', get_permalink(), $login_page);
    wp_redirect($redirect_url);
    exit;
}

$active_user = wp_get_current_user();

if(!empty(array_intersect(['administrator', 'real_estate_agent', 'editor'], $active_user->roles))) {
    $redirect_url = home_url('/agent-dashboard');
    wp_redirect($redirect_url);
    exit;
}

get_header();

$user_id = get_current_user_id();
    $user = get_user_by('ID', $user_id);
    $avatar_url = get_user_meta($user_id, 'avatar_url', true);
    $first_name = get_user_meta($user_id, 'first_name', true);
    $last_name = get_user_meta($user_id, 'last_name', true);

?>

<form action="" method="POST" enctype="multipart/form-data" id="agent-profile-form" class="agent-dashboard-form">
    <div>
        <div class="form-section avatar-upload">
            <!-- The entire circle is now the clickable button -->
            <label for="agent-avatar" class="avatar-preview">
                <?php 
                echo '<img src="' . esc_url($avatar_url) . '" alt="Agent Avatar" id="preview-image">';
                ?>
                <span class="placeholder-text" id="upload-text">Upload Photo</span>
            </label>
            <input type="file" id="agent-avatar" name="avatar" accept="image/jpeg, image/png, image/webp">
        </div>
        <div class="form-section account-info">
                <!-- Read-only Username -->
                <label>Username</label>
                <input type="text" value="<?php echo esc_attr( $user->user_login ); ?>" class="dashboard-input" readonly>
                
                <!-- Read-only Account Email -->
                <label>Account Login Email</label>
                <input type="email" value="<?php echo esc_attr( $user->user_email ); ?>" class="dashboard-input" readonly>
        </div>
        <div class="form-section personal-info">
            <input type="text" value="<?php echo esc_attr($first_name); ?>" name="first_name" class="dashboard-input" placeholder="First Name">
            <input type="text" value="<?php echo esc_attr($last_name); ?>" name="last_name" class="dashboard-input" placeholder="Last Name">
        </div>
        <div class="form-section password-section">
            <input type="password" name="current_password" class="dashboard-input" placeholder="Current Password">
            <div class="new-password-fields">
                <input type="password" name="new_password" class="dashboard-input" placeholder="New Password">
                <input type="password" name="confirm_new_password" class="dashboard-input" placeholder="Confirm Password">
            </div>
        </div>
        <button type="submit" name="submit_agent_profile" class="dashboard-submit-btn">Submit</button>
    </div>
</form>


<?php get_footer(); ?>