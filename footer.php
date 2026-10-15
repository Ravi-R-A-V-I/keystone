<?php 
/**
 * The template for displaying the footer
 *
 * @package Keystone
 */

?>

<!-- Universal Footer Block Render -->
<?php if(function_exists('do_blocks')) {
    $footer_logo_url = home_url('/wp-content/uploads/2026/10/keystone-logo-2.png');
    echo do_blocks('<!-- wp:create-block/keystone-footer {"logoUrl":"' . esc_url($footer_logo_url) . '","logoId":310} /-->');
 } ?>
?>

<?php wp_footer(); ?>
</body>
</html>