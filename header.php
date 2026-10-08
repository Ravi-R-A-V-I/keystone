<?php
/**
 * The template for displaying the header
 *
 * @package Keystone
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php 
 if(function_exists('do_blocks')) {
    echo do_blocks('<!-- wp:create-block/keystone-header {"logoUrl":"http://localhost:10023/wp-content/uploads/2026/10/keyston-logo-1-scaled-e1791378107128.jpeg","logoId":293} /-->');
 }
?>
    
    
