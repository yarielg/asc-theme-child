<?php

/**
 * Register Widget Zone
 */
add_action( 'widgets_init', 'asc_widgets_init' );
function asc_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Header Top First Row', 'wp-bootstrap-starter' ),
        'id'            => 'asc-header_top_first_row',
        'description'   => esc_html__( 'Header Top First Row', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1 First Row', 'wp-bootstrap-starter' ),
        'id'            => 'asc-footer1_first_row',
        'description'   => esc_html__( 'Footer 1 First Row', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2 First Row', 'wp-bootstrap-starter' ),
        'id'            => 'asc-footer2_first_row',
        'description'   => esc_html__( 'Footer 2 First Row', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1 Second Row', 'wp-bootstrap-starter' ),
        'id'            => 'asc-footer1_second_row',
        'description'   => esc_html__( 'Footer 1 Second Row', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2 Second Row', 'wp-bootstrap-starter' ),
        'id'            => 'asc-footer2_second_row',
        'description'   => esc_html__( 'Footer 2 Second Row', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3 Second Row', 'wp-bootstrap-starter' ),
        'id'            => 'asc-footer3_second_row',
        'description'   => esc_html__( 'Footer 3 Second Row', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Site Info Footer', 'wp-bootstrap-starter' ),
        'id'            => 'asc-site_info_footer',
        'description'   => esc_html__( 'Site Info Footer', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Mobile Secondary Menu', 'wp-bootstrap-starter' ),
        'id'            => 'asc-mobile_secondary_menu',
        'description'   => esc_html__( 'Site Info Footer', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Post Sidebar', 'wp-bootstrap-starter' ),
        'id'            => 'asc-post_sidebar',
        'description'   => esc_html__( 'Post Sidebar', 'wp-bootstrap-starter' ),
        'before_widget' => '<section id="%1$s" class="asc-post-widget">',
        'after_widget'  => '</section><hr>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}


/**
 * Register Menu
 */
add_action( 'init', 'asc_custom_new_menu' );
function asc_custom_new_menu() {
    register_nav_menus(
        array(
            'primary_mobile' => __( 'Primary Mobile' ),
        )
    );
}