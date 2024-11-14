<?php

// バージョン定義
define('NAKED_VERSION', 1.0);


/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/
function theme_enqueue_scripts()
{
    wp_enqueue_script('index.js', get_template_directory_uri() . '/common/js/index.js', array(), 'false', true);
    wp_enqueue_script('app.js', get_template_directory_uri() . '/common/js/app.js', array(), 'false', true);
    if (is_front_page()) {
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), 'false', true);
    }
    if (is_page('company')) {
        wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), 'false', true);
        wp_enqueue_script('gsapScrollTrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array(), 'false', true);
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


function theme_enqueue_styles()
{
    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/common/css/style.css', array(), date("ymdHis", filemtime(get_stylesheet_directory() . '/style.css')));
    if (is_front_page()) {
        wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), 'false', 'all');
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


// deferの付与
function addDefer($tag, $handle)
{
    $handles = ['index.js', 'app.js'];
    if (in_array($handle, $handles, true)) {
        return str_replace(' src=', ' defer src=', $tag);
    }
    return $tag;
}
add_filter('script_loader_tag', 'addDefer', 10, 2);
