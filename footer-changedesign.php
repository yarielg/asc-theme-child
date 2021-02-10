<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>

    </div><!-- .row -->
    </div><!-- .container -->
    <style type="text/css">
        footer a.nav-link, footer p{
            color: <?php  the_field('asc_secondary_text_color_footer', 'option') ?>;
            font-family: '<?php  the_field('asc_font_text_footer', 'option') ?>', sans-serif;
        }
        .widget-title{
            color: <?php  the_field('asc_primary_color_footer', 'option') ?>;
            font-size: 18px !important;
            line-height: 26px;
        }
        footer#colophon{
            background: <?php the_field('asc_background_color', 'option')?> !important;
        }
        .site-info{
            background: <?php the_field('asc_background_color_site_info_section', 'option')?> !important;
        }
    </style>

    <footer id="colophon" class="site-footer <?php echo wp_bootstrap_starter_bg_class(); ?>" role="contentinfo">
        <div class="container pt-3 pb-3">
            <div class="row py-4">
                <?php if ( is_active_sidebar( 'asc-footer1_first_row' )) : ?>
                    <div class="col-12 col-md-6"><?php dynamic_sidebar( 'asc-footer1_first_row' ); ?></div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'asc-footer2_first_row' )) : ?>
                    <div class="col-12 col-md-6"><?php dynamic_sidebar( 'asc-footer2_first_row' ); ?></div>
                <?php endif; ?>
            </div>
            <hr class="mobile_hide">
            <div class="row py-4">
                <?php if ( is_active_sidebar( 'asc-footer1_second_row' )) : ?>
                    <div class="col-12 col-md-5"><?php dynamic_sidebar( 'asc-footer1_second_row' ); ?></div>
                    <div class="col-12 col-md-1"></div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'asc-footer2_second_row' )) : ?>
                    <div class="col-12 col-md-3"><?php dynamic_sidebar( 'asc-footer2_second_row' ); ?></div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'asc-footer3_second_row' )) : ?>
                    <div class="col-12 col-md-3"><?php dynamic_sidebar( 'asc-footer3_second_row' ); ?></div>
                <?php endif; ?>
            </div>

        </div>
    </footer><!-- #colophon -->
    <div class="site-info">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class=" mb-0">&copy;<?php echo date('Y'); ?> <?php echo '<a href="'.home_url().'">'.get_bloginfo('name').'</a>'; ?></p>
                </div>
                <?php if ( is_active_sidebar( 'asc-footer1_second_row' )) : ?>
                    <div class="col-md-6"><?php dynamic_sidebar( 'asc-site_info_footer' ); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div><!-- close .site-info -->

    </div><!-- #content -->

   
<?php endif; ?>
</div><!-- #page -->

<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.selectBox.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/jquery.selectBox.css"/>

<script type="text/javascript">
    // jQuery(document).ready(function () {
    //     jQuery('#input_1_1').selectBox();
    // });
</script>
<?php wp_footer(); ?>
</body>
</html>