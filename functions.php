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
}


add_action('wp_enqueue_scripts', 'keystone_enqueue_assets');



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