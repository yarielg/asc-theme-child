<?php
/*
 Template Name: Change Footer Design
 Template Post Type: page
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
get_footer('changedesign');