<?php get_header(); 
 /* Template Name: Register */
?>

<form id="register-form" class="keystone-auth-form">
    <h1>Register</h1>
    <input type="text" class="keystone-form-input" placeholder="Email" name="email" id="register-email">
    <input type="text" class="keystone-form-input" placeholder="Username" name="username" id="register-username">
    <input type="password" class="keystone-form-input" placeholder="Password" name="password" id="register-password">
    <input type="password" class="keystone-form-input" placeholder="Confirm Password" name="confirm-password" id="register-confirm-password">
    <div class="keystone-checkbox-wrapper">
      <input type="checkbox" class="keystone-form-checkbox" name="agent" id="register-agent-checkbox"> 
      <label for="register-agent-checkbox">Register as Agent</label>
    </div>
    <button class="keystone-submit-btn" type="submit">Register</button>
</form>
















<?php get_footer(); ?>