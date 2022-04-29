<?php

/**
 * Enqueue scripts and styles.
 */
function sprystore_scripts()
{
    $rand = rand(1, 99999999);
    wp_enqueue_style('sprystore-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_style('sprystore-main', get_template_directory_uri() . '/css/main.css', array(),  $rand);
    //wp_enqueue_style('swiper', 'https://unpkg.com/swiper@8/swiper-bundle.min.css',  array(), '');
    wp_enqueue_style('sprystore-mywoocommerce', get_template_directory_uri() . '/css/mywoocommerce.css', '',  $rand);


    wp_enqueue_script('fontawseome-icons', 'https://kit.fontawesome.com/03d62932bb.js');

    wp_style_add_data('sprystore-style', 'rtl', 'replace');


    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(''), '1.11.3');
    wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js', array('jquery'), '2.10.2');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', array('jquery'), '5.1.3');
    wp_enqueue_script('sprystore-script', get_template_directory_uri() . '/js/script.js',  array('jquery'), '', true);
    //wp_enqueue_script('swiper', 'https://unpkg.com/swiper@8/swiper-bundle.min.js',  array(''), '', true);




    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'sprystore_scripts');


/** Enqueue custom fonts */
function sprystore_enqueue_fonts()
{
    if (!is_admin()) {
        wp_register_style('sprystore-fonts', 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400&family=Oswald:wght@300;400;500;600&display=swap');
        wp_enqueue_style('sprystore-fonts');
    }
}
add_action('wp_enqueue_scripts', 'sprystore_enqueue_fonts');

//I enqueue blocks styles and js both in backend as in frontend

function sprystore_enqueue_assets()
{
    $rand = rand(1, 99999999);
    wp_enqueue_style('blocks-css', get_stylesheet_directory_uri() . '/css/blocks.css', [], $rand, 'all');
}
add_action('enqueue_block_assets', 'sprystore_enqueue_assets');
