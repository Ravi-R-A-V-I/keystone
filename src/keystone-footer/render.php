<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Generates a unique id for aria-controls.
$unique_id = wp_unique_id( 'p-' );

?>

<footer class="keystone-footer" <?php echo get_block_wrapper_attributes(); ?>>
    <div class="footer-inner">
        <div class="footer-nav-grid">
            <div class="keystone-footer-logo">
                <?php if(!empty($attributes['logoUrl'])) { echo '<a href="' . esc_url(home_url('/')) . '"><img src="' . esc_url($attributes['logoUrl']) . '"></a>'; } ?>
            </div>
            <div class="footer-column">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
            </div>
            <div class="footer-column">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-two' ) ); ?>
            </div>
            <div class="footer-column">
                <?php wp_nav_menu( array( 'theme_location' => 'footer-menu-three' ) ); ?>
            </div>
        </div>
    </div>

    <hr class="footer-divider" />

    <div class="footer-bottom">
        <p>Developed by <strong>Ravi</strong> | <a href="https://github.com/your-username/your-repo" target="_blank" rel="noopener">GitHub Repository</a></p>
    </div>
</footer>