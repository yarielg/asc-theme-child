<?php

// Include php files
include get_theme_file_path('/includes/shortcodes.php');
include get_theme_file_path('/includes/helpers.php');
include get_theme_file_path('/includes/widgets.php');
include get_theme_file_path('/includes/ajax.php');
require_once( get_stylesheet_directory() . '/shortcodes/plan-my-adventure.php');

/**
 * Load custom WordPress nav walker.
 */
if ( ! class_exists( 'wp_asc_navwalker' )) {
    require_once(get_theme_file_path() . '/inc/wp_asc_navwalker.php');
}


// Enqueue needed scripts
function needed_styles_and_scripts_enqueue() {
    // enqueue style
    wp_enqueue_style( 'wp-bootstrap-starter-oswald-font', 'https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i|Poppins:300,400,500,600,700' );
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/custom_style.css' );
    wp_enqueue_style( 'asc-modal', get_stylesheet_directory_uri() . '/assets/css/bootstrap-side-modals.css' );

    wp_enqueue_script('jquery_ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js',array ('jquery'), '1.0', true );
    wp_enqueue_script('asc_validate', 'https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js',array ('jquery'), '1.0', true );
  //  wp_enqueue_script('asc_additionals_method', 'https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js',array ('jquery'), '1.0', true );
    wp_enqueue_script('main_js', get_stylesheet_directory_uri() . '/assets/js/main.js',array ('jquery'), '1.0', true );
    wp_enqueue_script( 'main_js');
    wp_localize_script( 'main_js', 'parameters',['ajax_url'=> admin_url('admin-ajax.php')]);

}
add_action( 'wp_enqueue_scripts', 'needed_styles_and_scripts_enqueue' );

//accept mime types
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
add_filter( 'widget_text', 'do_shortcode' );


//
// Your code goes below
//

/**
 * Add custom fields to primary menu items
 */
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);
function my_wp_nav_menu_objects( $items, $args ) {
    // get menu
    $menu = wp_get_nav_menu_object($args->menu);

    // modify primary only
    if( $args->theme_location == 'primary' ) {
        foreach( $items as &$item ) {
            $color = get_field('menu_items_color', $menu);
            $customize = get_field('customize_item', $item);
            if($customize['is_button'] == 'yes'){

                if( $customize['icon'] ) {
                    if( $customize['just_icon'] == 'yes') {
                        $item->title = '';
                    }
                    $item->title = '<img src="'.$customize['icon'].'"> ' . $item->title;
                }else{
                    $item->title = '' . $item->title;
                }
            }

        }


    }
    return $items;
}

/**
 * Register Option Pages
 */
add_action('acf/init', 'asc_acf_op_init');
function asc_acf_op_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {

        // Register options page.
        $parent = acf_add_options_page(array(
            'page_title'    => __('Theme General Settings'),
            'menu_title'    => __('Theme Settings'),
            'menu_slug'     => 'theme-general-settings',
            'redirect'      => false
        ));

        // Add sub page footer.
        $header = acf_add_options_page(array(
            'page_title'  => __('Header Settings'),
            'menu_title'  => __('Header'),
            'parent_slug' => $parent['menu_slug'],
        ));

        // Add sub page footer.
        $footer = acf_add_options_page(array(
            'page_title'  => __('Footer Settings'),
            'menu_title'  => __('Footer'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }
}

/**
 * Customizing Menus
 */
add_filter('wp_nav_menu_items', 'asc_wp_nav_menu_items', 10, 2);
function asc_wp_nav_menu_items( $items, $args )
{

    // get menu
    $menu = wp_get_nav_menu_object($args->menu);

    // modify primary only
    if ($args->theme_location == 'primary') {
        $color = get_field('menu_items_color', $menu);

        $html_color = '<style type="text/css">
                            .dropdown-item{ color: ' . $color . '; }
                            .asc_btn_cta{ background: ' . $color . '; padding: 0px 30px !important;height: 41px;display: inline-flex;align-items: center; }
                            .asc_btn_cta.just_icon{ padding: 0 5px !important; }
                            .asc_btn_cta img{ width: 24px;}
                      </style>';

        $items = $items . $html_color;

    }
    return $items;
}

function sol_soliloquy_navigate_to_slide() {

    ?>
    $(document).on( 'click', 'a', function(e) {
    if ($(this).data('soliloquy-id') !== undefined && $(this).data('soliloquy-index') !== undefined) {
    e.preventDefault();
    soliloquy_slider[ $(this).data('soliloquy-id') ].goToSlide( $(this).data('soliloquy-index') );
    }
    });
    <?php

}
add_action( 'soliloquy_api_slider', 'sol_soliloquy_navigate_to_slide' );



add_theme_support( 'post-thumbnails' );
add_image_size( 'event_vertical_img', 300, 450 );
