<?php
/*
 Template Name: Sidebar Template - Two Columns
 Template Post Type: page
 */

get_header(); ?>


<div class="<?php get_field('asc_content_page') == 'box' ? 'container' : 'container-fluid' ?>">
    <?php
    while ( have_posts() ) : the_post();
        ?>

        <div class="row">
            <div class=" col-md-8 m-0 px-0 asc-content-sidebar">
                <?php
                the_content();
                ?>
            </div><!-- .entry-content -->
            <?php if ( is_active_sidebar( 'asc-sidebar_two_columns' )) : ?>
                <div class="col-md-4 asc-sidebar"><?php dynamic_sidebar( 'asc-sidebar_two_columns' ); ?></div>
            <?php endif; ?>
        </div>

    <?php
    endwhile; // End of the loop.
    ?>
</div>

<?php
get_footer();