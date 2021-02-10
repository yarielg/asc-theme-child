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

    <div class="container ">
        <div class="row single_wrapper">
            <?php
            while ( have_posts() ) : the_post();

                ?>


                <div class=" col-md-7  single_content">
                    <?php
                    echo "<p class='date_cls'> " . get_the_date( 'n/d/y' ) . "</p>";
                    echo "<h2 class='single_title'>" . get_the_title() . "</h2>";
                    echo get_the_post_thumbnail( null, 'full' );?>
					<div class="single_content_sec">
					<?php
                    the_content();
                    echo '<p class="rpwe-author"> <b> Written by: </b>' . get_the_author_link() . '</p>';
                    ?>
					</div>
                </div><!-- .entry-content -->

            <?php
            endwhile; // End of the loop.
            ?>
            <div class="col-md-1"></div>
            <div class="col-md-4">
			<div class="asc-single-post-sb">
                <?php if ( is_active_sidebar( 'asc-post_sidebar' )) : ?>
                   <?php  dynamic_sidebar( 'asc-post_sidebar' ); ?>
                <?php endif; ?>
            </div>
			</div>
        </div>
    </div>

<?php
get_footer();
