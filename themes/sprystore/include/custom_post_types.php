<?php

/****************************************CUSTOM POST TYPES**********************************/
/*TEAM*/
add_action('init', 'hr_register_team');

function hr_register_team()
{
    /*I add the labels for the custom_post_type*/
    $labels = array(
        'name'                 =>    _x('Teams', 'post type general name', 'team'),
        'singular_name'         =>    _x('Team', 'post type general name', 'team'),
        'menu_name'             =>    _x('Teams', 'admin-menu', 'team'),
        'name_admin_bar'     => _x('Team', 'Add New on Toolbar', 'team'),
        'add_new'             =>    __('Add new', 'team'),
        'add_new_item'         =>    __('Add new', 'team'),
        'new_item'           =>    __('New team', 'team'),
        'edit_item'          =>    __('Edit team', 'team'),
        'view_item'          =>    __('View team', 'team'),
        'all_items'          =>    __('All teams', 'team'),
        'search_items'       =>    __('Search teams', 'team'),
        'not_found'          => __('There are no team members.', 'team'),
        'not_found_in_trash' => __('There are no team members in trash.', 'team')

    );
    /* I set up the behaviour and functionalities of the new custom post type */
    $args = array(
        'labels'             => $labels,
        'description'        => __('Description.', 'team'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'            => 'dashicons-groups',
        'rewrite'            => array('slug' => 'team'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true
    );

    register_post_type('team', $args);
}

/*TESTIMONIAL*/
add_action('init', 'hr_register_testimonial');

function hr_register_testimonial()
{
    /*I add the labels for the custom_post_type*/
    $labels = array(
        'name'                 =>    _x('Testimonials', 'post type general name', 'testimonial'),
        'singular_name'         =>    _x('Testimonial', 'post type general name', 'testimonial'),
        'menu_name'             =>    _x('Testimonials', 'admin-menu', 'testimonial'),
        'name_admin_bar'     => _x('Testimonial', 'Add New on Toolbar', 'testimonial'),
        'add_new'             =>    __('Add new', 'testimonial'),
        'add_new_item'         =>    __('Add new', 'testimonial'),
        'new_item'           =>    __('New testimonial', 'testimonial'),
        'edit_item'          =>    __('Edit testimonial', 'testimonial'),
        'view_item'          =>    __('View testimonial', 'testimonial'),
        'all_items'          =>    __('All testimonials', 'testimonial'),
        'search_items'       =>    __('Search testimonials', 'testimonial'),
        'not_found'          => __('There are no testimonials.', 'testimonial'),
        'not_found_in_trash' => __('There are no testimonials in trash.', 'testimonial')

    );
    /* I set up the behaviour and functionalities of the new custom post type */
    $args = array(
        'labels'             => $labels,
        'description'        => __('Description.', 'testimonial'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'            => 'dashicons-testimonial',
        'rewrite'            => array('slug' => 'testimonial'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true
    );

    register_post_type('testimonial', $args);
}
