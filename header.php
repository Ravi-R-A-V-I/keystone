<?php
/**
 * The template for displaying the header
 *
 * @package Keystone
 */

if (function_exists('do_blocks')) {
    $logo_url = home_url('/wp-content/uploads/2026/10/keyston-logo-1-scaled-e1791378107128.jpeg');
    $header_ui = do_blocks('<!-- wp:create-block/keystone-header {"logoUrl":"' . esc_url($logo_url) . '","logoId":293} /-->');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
 <?php echo $header_ui ?>
    
    
