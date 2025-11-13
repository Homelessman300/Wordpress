<?php
// -----------------------------
// THEME SUPPORTS
// -----------------------------

// Add featured image support and custom image sizes
add_theme_support('post-thumbnails');
add_image_size('featured-rectangular', 1200, 600, true); // 2:1 main featured
add_image_size('mini-rectangular', 600, 300, true);      // mini-posts
add_image_size('sidebar-thumb', 400, 200, true);         // sidebar thumbnails

// Add title tag support
add_theme_support('title-tag');

// -----------------------------
// ENQUEUE STYLES & SCRIPTS
// -----------------------------
function greentech_enqueue_assets() {
    // CSS
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css', array(), null);
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/sass/main.css', array(), null);

    // JS
    wp_enqueue_script('jquery');
    wp_enqueue_script('browser', get_template_directory_uri() . '/assets/js/browser.min.js', array(), null, true);
    wp_enqueue_script('breakpoints', get_template_directory_uri() . '/assets/js/breakpoints.min.js', array(), null, true);
    wp_enqueue_script('util', get_template_directory_uri() . '/assets/js/util.js', array(), null, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'greentech_enqueue_assets');

// -----------------------------
//
