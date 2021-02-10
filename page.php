<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>


<div class="<?php echo get_field('asc_content_page') == 'box' ? 'container' : 'container-fluid' ?> asc-page-content">
            <div class="row">
                <?php
                while ( have_posts() ) : the_post();
                    ?>
                <?php //echo do_shortcode('[mobile_menu_section]'); ?>

                    <div class=" col-12 m-0 px-0">
                        <?php
                        the_content();
                        ?>
                    </div><!-- .entry-content -->

                <?php
                endwhile; // End of the loop.
                ?>
            </div>
</div>

<?php
get_footer();
