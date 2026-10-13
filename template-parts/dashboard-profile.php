<?php


 $user_id = get_current_user_id();
    $user = get_user_by('ID', $user_id);
    $avatar_url = get_user_meta($user_id, 'avatar_url', true);
    $first_name = get_user_meta($user_id, 'first_name', true);
    $last_name = get_user_meta($user_id, 'last_name', true);
    $email = get_user_meta($user_id, 'public_email', true);
    $phone = get_user_meta($user_id, 'phone', true);
    $license = get_user_meta($user_id, 'license', true);
    $linkedIn = get_user_meta($user_id, 'linkedIn', true);
    $instagram = get_user_meta($user_id, 'instagram', true);
    $website = get_user_meta($user_id, 'website', true);
    $bio = get_user_meta($user_id, 'description', true);

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
            <input type="email" value="<?php echo esc_attr($email); ?>" name="public_email" class="dashboard-input" placeholder="Public Email">
            <input type="tel" value="<?php echo esc_attr($phone); ?>" name="phone" class="dashboard-input" placeholder="Public Phone">
            <input type="text" value="<?php echo esc_attr($license); ?>" name="license" class="dashboard-input" placeholder="License Number">
            <input type="url" value="<?php echo esc_attr($linkedIn); ?>" name="linkedIn" class="dashboard-input" placeholder="https://www.linkedin.com/">
            <input type="url" value="<?php echo esc_attr($instagram); ?>" name="instagram" class="dashboard-input" placeholder="https://www.instagram.com/">
            <input type="url" value="<?php echo esc_attr($website); ?>" name="website" class="dashboard-input" placeholder="https://www.yourwebsite.com">
        </div>
        <div class="form-section professional-info">
            <textarea name="bio" class="dashboard-input" placeholder="Bio"><?php echo esc_textarea($bio ?? ''); ?></textarea>
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