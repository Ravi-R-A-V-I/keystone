<?php 
// page-set-new-password.php
get_header(); 

// 1. Grab the secure parameters from the URL
$reset_key = isset( $_GET['key'] ) ? sanitize_text_field( $_GET['key'] ) : '';
$user_login = isset( $_GET['login'] ) ? sanitize_text_field( $_GET['login'] ) : '';
?>

<div class="keystone-auth-container">
    <div id="login-message" class="keystone-auth-message"></div>

    <form id="set-new-password-form" class="keystone-auth-form">
        <div id="keystone-new-password-fields">
            <h1>Set New Password</h1>
            
            <!-- 2. Hide the key and login in the form so JS can grab them later -->
            <input type="hidden" id="reset-key" value="<?php echo esc_attr( $reset_key ); ?>">
            <input type="hidden" id="reset-login" value="<?php echo esc_attr( $user_login ); ?>">
            
            <!-- 3. The actual password inputs -->
            <input type="password" id="new-password" class="keystone-form-input" placeholder="New Password" required>
            <input type="password" id="confirm-new-password" class="keystone-form-input" placeholder="Confirm New Password" required>
            
            <button id="save-password-btn" class="keystone-submit-btn" type="submit">Save Password</button>
        </div>
    </form>
</div>

<?php get_footer(); ?>