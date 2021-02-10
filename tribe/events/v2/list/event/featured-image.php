<?php
/**
 * View: List View - Single Event Featured Image
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event/featured-image.php
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

if ( ! $event->thumbnail->exists ) {
	return;
}
$is_on_list = asc_event_on_list($event->ID);
?>
<div class="tribe-events-calendar-list__event-featured-image-wrapper tribe-common-g-col asc-calendar-tooltip">
    <a href="#" class="asc_btn_cta blue"><span>Buy Tickets</span></a>
    <a href="javascript: void(0)" id="asc-event" data-eventid="<?php the_ID() ?>" <?php echo $is_on_list ? 'class="asc_btn_cta disabled  no-text"' : ' class="asc_btn_cta actionable no-text"' ?> >
        <?php
        if($is_on_list){
            echo '<span><i class="fa fa-check"></i></span>';
        }else{
            echo '<span class="cta-asc-text"><i class="fa fa-plus"></i></span>';
        }
        ?>
    </a>
</div>
