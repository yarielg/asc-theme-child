<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-lg-12 ">
		<div id="main" class="site-main row" role="main">
		<div class="container ">
		<div class="row ">
		<div class=" col-md-7 ">
		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			echo '<div class="row single_wrapper">';
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'archive' ); 
				
				echo '</div>';
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>


			</div>

			<div class="col-md-1"></div>
				<div class="col-md-4">
					<div class="asc-single-post-sb">
						<?php if ( is_active_sidebar( 'asc-post_sidebar' )) : ?>
						<?php  dynamic_sidebar( 'asc-post_sidebar' ); ?>
						<?php endif; ?>
					</div>
				</div>
				</div>
			</div><!-- #main -->
		</div><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
