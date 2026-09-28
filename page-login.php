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
    <h1>Login</h1>
    <input type="text" class="keystone-form-input" placeholder="Username" name="username" id="login-username">
    <input type="password" class="keystone-form-input" placeholder="Password" name="password" id="login-password">
    <button class="keystone-submit-btn" type="submit">Login</button>
    <p>Don't have an account? <a href="#">Register</a></p>
</form>




















<?php get_footer(); ?>