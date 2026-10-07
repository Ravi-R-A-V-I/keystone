<?php
if (!is_user_logged_in()) {
    $login_page = home_url('/login');
    $redirect_url = add_query_arg('redirect_to', get_permalink(), $login_page);
    wp_redirect($redirect_url);
    exit;
}

get_header();

// 1. Determine the active tab safely
$current_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'profile';
// Fetch current user data for the sidebar identity block
$current_user = wp_get_current_user(); 
?>

<div class="agent-dashboard-wrapper">
    
    <!-- 2. Dashboard Sidebar & Navigation -->
    <aside class="dashboard-sidebar">
        
        <!-- Sidebar Identity Block -->
        <div class="sidebar-identity">
            <div class="sidebar-avatar">
                <?php 
                 $avatar_url = get_user_meta($current_user->ID, 'avatar_url', true);
                if ($avatar_url) {
                    echo '<img src="' . esc_url($avatar_url) . '" alt="Agent Avatar">';
                } else {
                    echo get_avatar($current_user->ID, 48);
                }
                ?>
            </div>
            <div class="sidebar-user-info">
                <span class="sidebar-greeting">Welcome back,</span>
                <strong class="sidebar-username"><?php echo esc_html($current_user->display_name); ?></strong>
            </div>
        </div>

        <nav class="dashboard-nav-menu">
            <a href="?tab=profile" class="dashboard-tab <?php echo $current_tab === 'profile' ? 'active' : ''; ?>">
                Profile Settings
            </a>
            <a href="?tab=properties" class="dashboard-tab <?php echo $current_tab === 'properties' ? 'active' : ''; ?>">
                My Properties
            </a>
            <a href="?tab=add-property" class="dashboard-tab <?php echo $current_tab === 'add-property' || $current_tab === 'edit-property' ? 'active' : ''; ?>">
                Add/Edit Property
            </a>
            
            <!-- Log Out Link -->
            <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="dashboard-tab logout-link">
                Log Out
            </a>
        </nav>
    </aside>

    <!-- 3. Dynamic Content Canvas -->
    <main class="dashboard-main-content">
        <?php if(isset($_GET['status']) && ($_GET['status'] === "success")) { ?>
        <div class="success-banner">Property successfully submitted!</div>
        <?php } else if (isset($_GET['status']) && ($_GET['status'] === "deleted")) { ?>
        <div class="danger-banner">Property successfully deleted!</div>
    <?php }
        if ($current_tab === 'properties') {
            get_template_part('template-parts/dashboard', 'properties');
        } elseif ($current_tab === 'add-property' || $current_tab === 'edit-property') {
            get_template_part('template-parts/dashboard', 'property-form');
        } else {
            get_template_part('template-parts/dashboard', 'profile');
        }
        ?>
    </main>

</div>
<?php get_footer(); ?>
