<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Generates a unique id for aria-controls.
$unique_id = wp_unique_id( 'p-' );

?>

<header <?php echo get_block_wrapper_attributes(); ?>>
<div>
	<?php
	 if(!empty($attributes['logoUrl']))
	 {
	 	echo '<a href="' . esc_url(home_url('/')) . '"><img src="' . esc_url($attributes['logoUrl']) . '"></a>';
	 }
	?>
</div>
<div>
	<button class="mobile-menu-toggle">
		<span></span>
		<span></span>
		<span></span>
	</button>
  <div class="mobile-collapse">
	<?php 
	 wp_nav_menu(array('theme_location' => 'main-menu'));
	?>
	<?php 
	 if(is_user_logged_in())
	 {
	   $current_user = wp_get_current_user();
	   $avatar_url = get_user_meta($current_user->ID, 'avatar_url', true);
		?>
	   <div class="profile-dropdown-wrapper">
		<?php echo '<button class="dropdown-toggle"> ';
		if($avatar_url) {
			echo '<img src="' . esc_url($avatar_url) . '">';
		} else echo get_avatar($current_user->ID, 48);
		echo'</button>' ?>
		<ul class="dropdown-menu">
			<?php
			if($current_user->roles[0] == 'real_estate_agent')
			{
				echo '<li><a href="' . esc_url(home_url('/agent-dashboard')) . '">Dashboard</a></li>';
			}
			elseif(in_array('administrator', (array) $current_user->roles))
			{
				echo '<li><a href="' . esc_url(home_url('/agent-dashboard')) . '">Dashboard</a></li>';
			}
			else echo '<li><a href="' . esc_url(home_url('/profile-settings')) . '">Profile Settings</a></li>';
			?>
			<li><a href="<?php echo esc_url(home_url('/favorites')); ?>">Favorites</a></li>
			<li><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Log Out</a></li>
		</ul>
	   </div>
	<?php } else {
		echo '<a class="btn-login" href="' . esc_url(home_url('/login')) . '">Login</a>';
	 }
	?>
  </div>
</div>
</header>