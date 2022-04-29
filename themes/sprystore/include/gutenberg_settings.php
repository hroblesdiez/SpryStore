<?php

/****************** GUTENBERG SET UP ****************/


// I add support for wide and full images 

add_theme_support('align-wide');

// I add support for default block styles 

add_theme_support('wp-block-styles');

// I add support for block spacnig (padding) 
add_theme_support('custom-spacing');

//I create the color palette for the editor 
add_theme_support('editor-color-palette', array(
    array(
        'name'  => esc_attr__('orange', 'sprystore'),
        'slug'  => 'orange',
        'color' => '#ff7315',
    ),
    array(
        'name'  => esc_attr__('black', 'sprystore'),
        'slug'  => 'black',
        'color' => '#232020',
    ),
    array(
        'name'  => esc_attr__('light gray', 'sprystore'),
        'slug'  => 'light-gray',
        'color' => '#a09292',
    ),
    array(
        'name'  => esc_attr__('dark gray', 'sprystore'),
        'slug'  => 'dark-gray',
        'color' => '#6b778d',
    ),
    array(
        'name'  => esc_attr__('very light gray', 'sprystore'),
        'slug'  => 'very-light-gray',
        'color' => '#f4f4f4',
    ),
));
