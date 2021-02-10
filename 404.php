<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php

// WordPress 5.2 wp_body_open implementation
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}
?>



<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php /*esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); */?></a>
    <?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
        <!-- <div id="header-main" style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>') , linear-gradient(rgba(27,17,95,0.23) 0%, rgba(27,17,95,0.85) 100%)"> -->
        <div id="header-main" style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>'), linear-gradient(to left,rgba(27,17,95,0.23) 0%, rgba(27,17,95,0.85) 100%)">
            <!--<div class="header-bg"></div>-->
            <header id="masthead" class="site-header navbar-static-top" role="banner">
                <div class="container container-brand">

                    <div class="header_top_bar"><?php dynamic_sidebar( 'asc-header_top_first_row' ); ?></div>
                    <nav class="navbar navbar-expand-lg p-0">



                        <div class="navbar-brand">
                            <?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
                                <a href="<?php echo esc_url( home_url( '/' )); ?>">
                                    <img src="<?php echo esc_url(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                                </a>
                            <?php else : ?>
                                <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
                            <?php endif; ?>

                        </div>

                        <button class="navbar-toggler" type="button" id="navbarToggleBtn" data-toggle="modal" data-target="#left_modal_sm">
                        <span class="navbar-toggler-icon">
                            <div class="bar1"></div>
                            <div class="bar2"></div>
                            <div class="bar3"></div>
                        </span>
                        </button>
                        <?php
                        wp_nav_menu(array(
                            'theme_location'    => 'primary',
                            'container'       => 'div',
                            'container_id'    => 'main-nav',
                            'container_class' => 'collapse navbar-collapse justify-content-end',
                            'menu_id'         => false,
                            'menu_class'      => 'navbar-nav',
                            'depth'           => 2,
                            'fallback_cb'     => 'wp_asc_navwalker::fallback',
                            'walker'          => new wp_asc_navwalker()
                        ));
                        ?>
                    </nav>

            </header><!-- #masthead -->
            <div class="container zindex_1">
                <hr class="white_header_sep">
            </div>
            <!-- Section under header BREADCRUMBS AND SEARCH SOCIAL ICONS -->
            <div class="header-under-nav container d-none d-md-block zindex_1">
                <div class=" d-flex justify-content-between">
                    <div id="breadcrumbs"><?php
                        if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                        }
                        ?>
                    </div>
                    <div id="asc-top-social">
                        <a class="asc-search-header" data-toggle="modal" data-target="#asc_search_modal" href="#"><i class="fas fa-search"></i> Search</a>
                        <a class="icon-18" href="http://instagram.com/adventuresci" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a class="icon-18" href="https://www.facebook.com/AdventureScienceCenter"  target="_blank"><i class="fab fa-facebook-square"></i></a>
                        <a class="icon-18" href="http://twitter.com/adventuresci"  target="_blank"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <?php if (is_singular('post')) {?> <div class="container blog_heading"><p>Blog</p></div> <?php }?>
            <!-- Section for content under Nav -->
            <div class="content-under-nav container">

                <h1 class="page-title">ERROR 404</h1>

                <?php if( have_rows('header_call_actions') ): ?>
                    <ul id="asc_header_cta_list" class="pl-0">
                        <?php while( have_rows('header_call_actions') ): the_row();

                            // Get sub field values.
                            $cta_link = get_sub_field('cta_link');
                            $cta_name = get_sub_field('cta_name');
                            ?>

                            <li><a href="<?php echo $cta_link ?>"><i class='fa fa-caret-right'></i> <?php echo $cta_name ?></a></li>

                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

        </div>

        <!-- Modals Here -->
        <?php include_once 'includes/modals.php'?>

    <?php endif; ?>
    <div class="site-content">
        <div class="container-fluid">
            <div class="row">



                <div class="container asc-page-content">
                    <div class="row py-3 my-3">
                        <div class="col-12">
                            <h2>PAGE NOT FOUND</h2>
                            <br>
                        </div>
                        <div class="col-12">
                            <p>It looks like nothing was found at this location. Maybe try one of the links below or a search?</p>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 pb-3 mb-3 page404">
                            <?php	get_search_form(); ?>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

<?php
get_footer();
