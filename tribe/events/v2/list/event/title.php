<?php
/**
 * View: List View - Single Event Title
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event/title.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

use Tribe__Date_Utils as Dates;

$event_date_attr = $event->dates->start->format( Dates::DBDATEFORMAT );
?>
<h3 class="tribe-events-calendar-list__event-title tribe-common-h6 tribe-common-h4--min-medium">
	<a
		href="<?php echo esc_url( $event->permalink ); ?>"
		title="<?php echo esc_attr( $event->title ); ?>"
		rel="bookmark"
		class="tribe-events-calendar-list__event-title-link tribe-common-anchor-thin"
	>
		<?php
		// phpcs:ignore
		echo $event->title;
		?>
	</a>
</h3>

<div class="tribe-events-calendar-list__event-datetime-wrapper tribe-common-b2">
    <?php $this->template( 'list/event/date/featured' ); ?>
    <time class="asc-list-time tribe-events-calendar-list__event-datetime" datetime="<?php echo esc_attr( $event_date_attr ); ?>">
        <?php if(tribe_get_end_date($event->ID)){
            echo tribe_get_start_date($event->ID, true, 'h:iA');
            echo ' - ';
            echo tribe_get_end_date($event->ID, true, 'h:iA') ;
        }else echo $event->schedule_details->value(); ?>
    </time>
    <?php $this->template( 'list/event/date/meta', [ 'event' => $event ] ); ?>
</div>

