<?php 
/**
 * The template for displaying the footer
 *
 * @package Keystone
 */

?>

<!-- Universal Footer Block Render -->
<?php if(function_exists('do_blocks')) {
    echo do_blocks('<!-- wp:create-block/keystone-footer {"logoUrl":"http://localhost:10023/wp-content/uploads/2026/10/keystone-logo-2.png","logoId":310} /-->');
 }
?>

<?php wp_footer(); ?>
</body>
</html>