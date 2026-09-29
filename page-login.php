<?php 
if(is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}
get_header(); 
 /* Template Name: Login */
?>
<div id="login-message" class="keystone-auth-message"></div>
<form id="login-form" class="keystone-auth-form">
    <div id="keystone-login-fields">
        <h1>Login</h1>
        <input type="text" class="keystone-form-input" placeholder="Username" name="username" id="login-username">
        <input type="password" class="keystone-form-input" placeholder="Password" name="password" id="login-password">
        <button class="keystone-submit-btn" type="submit">Login</button>
        <p>Don't have an account? <a href="<?php echo esc_url(home_url('register')); ?>">Register</a></p>
    </div>
    <div id="keystone-reset-fields">
        <input type="text" id="reset-email" placeholder="Email" name="email" class="keystone-form-input">
        <button id="reset-submit-btn" class="keystone-submit-btn" type="submit">Send Reset Link</button>
    </div>
    <a href="" class="keystone-secondary-link" id="lost-password-link">Lost your password?</a>
    <a href="" class="keystone-secondary-link" id="back-to-login">Back to Login</a>
</form>





















<?php get_footer(); ?>