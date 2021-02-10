<?php
/**
 * View: Month View - Calendar Event Tooltip
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/calendar-body/day/calendar-events/calendar-event/tooltip.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://m.tri.be/1aiy
 *
 * @version 4.9.13
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$is_on_list = asc_event_on_list($event->ID);
?>
<div class="tribe-events-calendar-month__calendar-event-tooltip-template tribe-common-a11y-hidden asc-tooltip">
	<div
		class="tribe-events-calendar-month__calendar-event-tooltip"
		id="tribe-events-tooltip-content-<?php echo esc_attr( $event->ID ); ?>"
		role="tooltip"
	>
		<?php /*$this->template( 'month/calendar-body/day/calendar-events/calendar-event/tooltip/featured-image', [ 'event' => $event ] ); */?>
		<?php $this->template( 'month/calendar-body/day/calendar-events/calendar-event/tooltip/date', [ 'event' => $event ] ); ?>
		<?php $this->template( 'month/calendar-body/day/calendar-events/calendar-event/tooltip/title', [ 'event' => $event ] ); ?>
        <br>
        <div class="tribe-events-calendar-month__calendar-event-tooltip-description tribe-common-b3 asc-calendar-tooltip">
            <p><?php echo ucfirst(strtolower( substr(strip_tags(get_field('asc_event_overview', $event->ID)),0,100))) ?></p>
            <br>
            <a href="#" class="asc_btn_cta blue"><span>Buy Tickets</span></a>
            <a href="javascript: void(0)" id="asc-event" data-eventid="<?php the_ID() ?>" <?php echo $is_on_list ? 'class="asc_btn_cta disabled no-text"' : ' class="asc_btn_cta actionable no-text"' ?> >
                <?php
                if($is_on_list){
                    echo '<span><i class="fa fa-check"></i></span>';
                }else{
                    echo '<span class="cta-asc-text"><i class="fa fa-plus"></i></span>';
                }
                ?>
            </a>
        </div>


        <?php $this->template( 'month/calendar-body/day/calendar-events/calendar-event/tooltip/cost', [ 'event' => $event ] ); ?>
	</div>
</div>
