<?php
// Add theme support for post thumbnails and custom image sizes
add_theme_support('post-thumbnails');
add_image_size('featured-rectangular', 1200, 600, true); // 2:1 aspect ratio for main featured images
add_image_size('mini-rectangular', 600, 300, true); // 2:1 aspect ratio for mini posts
add_image_size('sidebar-thumb', 400, 200, true); // 2:1 aspect ratio for sidebar thumbnails

function mytheme_enqueue_assets() {
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css');
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/sass/main.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('browser', get_template_directory_uri() . '/assets/js/browser.min.js', array(), null, true);
    wp_enqueue_script('breakpoints', get_template_directory_uri() . '/assets/js/breakpoints.min.js', array(), null, true);
    wp_enqueue_script('util', get_template_directory_uri() . '/assets/js/util.js', array(), null, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
    
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');
function yourtheme_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'yourtheme' ),
    ) );
}
add_action( 'after_setup_theme', 'yourtheme_register_menus' );