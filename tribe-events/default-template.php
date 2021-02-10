<?php
/*
 Template Name: ASC Tribe Calendar
 Template Post Type: page, tribe_events
 */

get_header(); ?>

	<?php tribe_events_before_html(); ?>
	<?php tribe_get_view(); ?>
	<?php tribe_events_after_html(); ?>
<?php
get_footer();
