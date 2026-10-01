<?php 

function keystone_register_blocks() {
    register_block_type( __DIR__ . '/build/my-interactive-block');
    register_block_type( __DIR__ . '/build/keystone-property-card');
    register_block_type( __DIR__ . '/build/featured-property-cards-container');
    register_block_type( __DIR__ . '/build/keystone-properties');
    register_block_type( __DIR__ . '/build/keystone-search');
}

add_action('init', 'keystone_register_blocks');


function keystone_register_features() {
    register_nav_menus(array(
        'main-menu' => 'Main Menu',
        'footer-menu' => 'Footer Menu One',
        'footer-menu-two' => 'Footer Menu Two'
    ));
}

add_action('after_setup_theme', 'keystone_register_features');


function keystone_enqueue_assets() {
    wp_enqueue_style('keystone-style', get_template_directory_uri() . '/css/style.css');
    wp_enqueue_style('dashicons');
    wp_enqueue_style('leaflet-style', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4');
    wp_enqueue_script('leaflet-script', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true);
    wp_enqueue_script('keystone-property-card', get_template_directory_uri() . '/build/keystone-property-card/view.js', array(), true);
    wp_localize_script('keystone-property-card', 'keystone_property_card', array(
                'root' => esc_url_raw(rest_url()),
                'nonce' => wp_create_nonce('wp_rest')
    ));
    wp_enqueue_script_module('@wordpress/interactivity');
    
    if(is_singular('property')) {
        wp_enqueue_script('single-property', get_template_directory_uri() . '/src/single-property/gallery.js', array(), true);
    }
    if(is_page('login') || is_page('register') || is_page('set-new-password')) {
        wp_enqueue_script('login-register', get_template_directory_uri() . '/src/authentication/auth.js', array(), false, true);
        wp_localize_script('login-register', 'keystone_auth', array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('keystone_auth_nonce')

    ));
    }
    
    if(is_page('agent-dashboard')) {
        wp_enqueue_script('agent-dashboard-js', get_template_directory_uri() . '/src/agent-dashboard/agent-dashboard.js', array(), 1.0, true);
        wp_localize_script('agent-dashboard-js', 'agent_dashboard_data', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('agent_dashboard_nonce')
        ));
    }
    
}


add_action('wp_enqueue_scripts', 'keystone_enqueue_assets');


function handle_agent_profile_update() {
    if(!wp_verify_nonce($_POST['security'], 'agent_dashboard_nonce')) {
        wp_send_json_error(array(
            'message' => 'Invalid nonce'
        ));
    } else {
        $user_id = get_current_user_id();
        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $phone = sanitize_text_field($_POST['phone']);
        $email = sanitize_email($_POST['public_email']);
        $license = sanitize_text_field($_POST['license']);
        $linkedIn = sanitize_url($_POST['linkedIn']);
        $instagram = sanitize_url($_POST['instagram']);
        $website = sanitize_url($_POST['website']);
        $bio = sanitize_textarea_field($_POST['bio']);

        wp_update_user(array(
            'ID' => $user_id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'description' => $bio
        ));

        update_user_meta($user_id, 'public_email', $email);
        update_user_meta($user_id, 'phone', $phone);
        update_user_meta($user_id, 'license', $license);
        update_user_meta($user_id, 'linkedIn', $linkedIn);
        update_user_meta($user_id, 'instagram', $instagram);
        update_user_meta($user_id, 'website', $website);

        if($_FILES['avatar']['name']) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            $upload_overrides = array(
                'test_form' => false
            );
            $movefile = wp_handle_upload($_FILES['avatar'], $upload_overrides);
            if($movefile && !isset($movefile['error'])) {
                update_user_meta($user_id, 'avatar_url', $movefile['url']);
            }
        }
        wp_send_json_success(array(
            'message' => 'Your profile has been updated'
        ));
    }
    
}

add_action('wp_ajax_keystone_update_agent_profile', 'handle_agent_profile_update');

function keystone_handle_login() {
    check_ajax_referer('keystone_auth_nonce', 'security');
    $username = sanitize_text_field($_POST['username']);
    $password = $_POST['password'];
    $user = wp_authenticate($username, $password);
    
    if(is_wp_error($user)) {
        wp_send_json_error(array(
            'message' => $user->get_error_message(),
        ));
    } else {
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        wp_send_json_success( array(
        'message' => 'You are now logged in',
    ));
    }  
}

add_action('wp_ajax_nopriv_keystone_login_user', 'keystone_handle_login');
add_action('wp_ajax_keystone_login_user', 'keystone_handle_login');


function keystone_register_custom_roles() {
    if(! get_role('real_estate_agent')) {
        add_role(
            'real_estate_agent',
            'Agent',
            array(
                'read' => true,
                'upload_files' => true,
            )
        );
    }
}


add_action('init', 'keystone_register_custom_roles');


function keystone_block_wp_admin() {
    if(is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
        wp_safe_redirect(home_url());
        exit;
    }
}

add_action('admin_init', 'keystone_block_wp_admin');


function keystone_hide_admin_bar() {
    if(!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_action('after_setup_theme', 'keystone_hide_admin_bar');


function keystone_handle_register() {
    check_ajax_referer('keystone_auth_nonce', 'security');
    if(username_exists(sanitize_text_field($_POST['username'])) || email_exists(sanitize_email($_POST['email']))) {
        wp_send_json_error(array(
            'message' => 'Username or email already exists',
        ));
    }

    if($_POST['password'] !== $_POST['confirm-password']) {
        wp_send_json_error(array(
            'message' => 'Passwords do not match',
        ));
    }

    if(!empty($_POST['agent'])) {
        $user_role = 'real_estate_agent';
    } else {
        $user_role = 'subscriber';
    }
    $user_id = wp_insert_user(array(
        'user_login' => sanitize_text_field($_POST['username']),
        'user_email' => sanitize_email($_POST['email']),
        'user_pass' => $_POST['password'],
        'role' => $user_role
    ));

    if(is_wp_error($user_id)) {
        wp_send_json_error(array(
            'message' => $user_id->get_error_message(),
        ));
    } else {
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);
        wp_send_json_success( array(
        'message' => 'Your account has been created',
    ));
    }

}

add_action('wp_ajax_nopriv_keystone_register_user', 'keystone_handle_register');
add_action('wp_ajax_keystone_register_user', 'keystone_handle_register');

add_filter('logout_redirect', function() {
    return home_url();
});

function keystone_handle_reset_password() {
    check_ajax_referer('keystone_auth_nonce', 'security');
    $email = sanitize_email($_POST['email']);
    $user = get_user_by('email', $email);
    if(!empty($user)) {
        retrieve_password($email);
    }

    wp_send_json_success(array(
        'message' => 'If an account exists for this email, a reset link has been sent.',
    ));  
}

add_action('wp_ajax_nopriv_keystone_reset_password', 'keystone_handle_reset_password');

function keystone_custom_reset_email_link( $message, $key, $user_login, $user_data ) {
    // Build a custom URL pointing to a new frontend page
    $custom_url = home_url( "/set-new-password/?key=$key&login=" . rawurlencode( $user_login ) );

    // Rebuild the email body with your custom URL
    $message = "Someone has requested a password reset for the following account:\r\n\r\n";
    $message .= "Site Name: " . get_bloginfo( 'name' ) . "\r\n\r\n";
    $message .= "Username: " . $user_login . "\r\n\r\n";
    $message .= "If this was a mistake, just ignore this email and nothing will happen.\r\n\r\n";
    $message .= "To reset your password, visit the following address:\r\n\r\n";
    $message .= $custom_url . "\r\n";

    return $message;
}
add_filter( 'retrieve_password_message', 'keystone_custom_reset_email_link', 10, 4 );


function keystone_handle_set_new_password() {
    check_ajax_referer('keystone_auth_nonce', 'security');
    $user_login = sanitize_text_field($_POST['login']);
    $password = $_POST['password'];
    $key = sanitize_text_field($_POST['key']);
    $user = check_password_reset_key( $key, $user_login );
    if(is_wp_error($user)) {
        wp_send_json_error(array(
            'message' => 'Invalid or expired reset link.',
        ));
    } else {
        reset_password( $user, $password );
        wp_send_json_success(array(
            'message' => 'Your password has been reset.',
        ));
    }
}

add_action('wp_ajax_nopriv_keystone_set_new_password', 'keystone_handle_set_new_password');


add_filter('script_loader_tag', function($tag, $handle, $src) {
    if ('keystone-property-card' === $handle) {
        return '';
    }
    return $tag;
}, 10, 3);

function query_filter_by_page($query, $block) {

    if (is_page('buy')) {
        $query['meta_query'] = array(
            array(
                'key' => 'property_status',
                'value' => 'sale',
                'compare' => '='
            )
        );
    } elseif (is_page('rent')) {
        $query['meta_query'] = array(
            array(
                'key' => 'property_status',
                'value' => 'rent',
                'compare' => '='
            )
        );
    } elseif (is_page('favorites')) {

        if(!is_user_logged_in()) {
            // get_template_part();
            $query['post__in'] = array(0);
        }else {
               $user_id = get_current_user_id();
               $values = get_user_meta($user_id, 'favorite_properties', true);
        
              if ($user_id !== 0 && !empty($values)) {
                $query['post__in'] = $values;
            } else {
                $query['post__in'] = array(0);
            }
        }
    }

    return $query;
}

add_filter('query_loop_block_query_vars', 'query_filter_by_page', 10, 2);



function custom_rest_route() {
    register_rest_route('keystone/v1', '/favorites', array(
        'methods' => 'POST',
        'callback' => 'custom_favorite_properties'
    ));

    register_rest_route('keystone/v1', '/properties', array(
        'methods' => 'GET',
        'callback' => 'custom_get_properties'
    ));
}

add_action('rest_api_init', 'custom_rest_route');

function custom_get_properties($request) {
    $page = $request->get_param('page') ? $request->get_param('page') : 1;
    $status = $request->get_param('status');
    $north = $request->get_param('north_lat');
    $south = $request->get_param('south_lat');
    $east = $request->get_param('east_lng');
    $west = $request->get_param('west_lng');
    $min_price = $request->get_param('min_price');
    $max_price = $request->get_param('max_price');
    $beds = $request->get_param('beds');
    $baths = $request->get_param('baths');

    $map_markers = array();
    $html_output = '';

    $args = array(
        'post_type' => 'property',
        'posts_per_page' => 6,
        'paged' => $page,
    );

    $args['meta_query'] = array('relation' => 'AND');

    if(is_numeric($min_price) && is_numeric($max_price)) {
        $args['meta_query'] [] = array(
                'key' => 'property_price',
                'value' => array($min_price, $max_price),
                'type' => 'NUMERIC',
                'compare' => 'BETWEEN'
        );
    };

    if(is_numeric($beds)) {
        $args['meta_query'] [] = array(
                'key' => 'property_bedrooms',
                'value' => $beds,
                'type' => 'NUMERIC',
                'compare' => '>='
        );
    };

    if(is_numeric($baths)) {
        $args['meta_query'] [] = array(
                'key' => 'property_bathrooms',
                'value' => $baths,
                'type' => 'NUMERIC',
                'compare' => '>='
        );
    };

    if($status === 'sale') {
        $args['meta_query'] [] = array(
                'key' => 'property_status',
                'value' => 'sale',
                'compare' => '='
        );
    } elseif ($status === 'rent') {
        $args['meta_query'] [] = array(
                'key' => 'property_status',
                'value' => 'rent',
                'compare' => '='
        );
    }

    if(!empty($north) && !empty($south) && !empty($east) && !empty($west)) {
        $args['meta_query'] [] = array(
            array(
                'key' => 'latitude',
                'value' => array($south, $north),
                'type' => 'DECIMAL(10,6)',
                'compare' => 'BETWEEN'
           ),
           'relation' => 'AND',
           array(
                'key' => 'longitude',
                'value' => array($west, $east),
                'type' => 'DECIMAL(10,6)',
                'compare' => 'BETWEEN'
           )
        ); 
    }

    $properties = new WP_Query($args);

    if($properties->have_posts()) {
        while($properties->have_posts()) {
            $properties->the_post();
            $latitude = get_field('latitude');
            $longitude = get_field('longitude');
            $map_markers[] = array(
                'post_id' => get_the_ID(),
                'title' => get_the_title(),
                'latitude' => $latitude,
                'longitude' => $longitude
            );
            ob_start();
            get_template_part('src/keystone-property-card/render', null, array('card_post_id' => get_the_ID()));
            $html_output .= ob_get_clean();
        }
        wp_reset_postdata();
    };
    return array(
        'map_markers' => $map_markers,
        'html_output' => $html_output
    );
};

function custom_favorite_properties($request) {

    $received_id = $request->get_param('post_id');
    
    $user_id = get_current_user_id();
     if($user_id !== 0){
        $favorites = get_user_meta($user_id, 'favorite_properties', true);
        if(empty($favorites)) {
            $favorites = array();
        }
        if(in_array($received_id, $favorites)) {
            $favorites = array_diff($favorites, array($received_id));
            $status = 'removed';
        } else {
            $favorites[] = $received_id;
            $status = 'added';
        }
        update_user_meta($user_id, 'favorite_properties', $favorites);

        return new WP_REST_Response(array('success' => true, 'status' => $status));
     } else {
        return new WP_Error('unauthorized', 'You must be logged in to favorite a property', array('status' => 401));
     }
}