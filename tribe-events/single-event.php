<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<?php

while ( have_posts() ) : the_post();
    $is_on_list = asc_event_on_list(get_the_ID());

    ?>
    <div class="container-fluid asc-event-post">
        <div class="asc-event-overview">
            <div class="container p-0">
                <div class="row">
                    <div class="col-md-6 order-md-12 p-0 asc-event-actions">
                        <p class="d-none d-md-block asc-overview-text">TICKETS</p>
                        <a href="javascript: void(0)" id="asc-buy" data-url="<?php echo get_field('altru_link') ?>" data-eventid="<?php the_ID() ?>" class="asc_btn_cta blue"><span>Buy Tickets</span></a>
                        <a href="javascript: void(0)" id="asc-event" data-date="<?php echo tribe_get_start_date($event->ID, true,'m/d g:i A') ? tribe_get_start_date($event->ID, true,'m/d g:i A') : 'EXHIBIT' ?>" data-mainurl="<?php echo get_stylesheet_directory_uri() . '/assets/img/ticket.svg' ?>" data-type="<?php echo asc_get_type_event(get_the_ID()) ?>" data-eventid="<?php the_ID() ?>" <?php echo $is_on_list ? 'class="asc_btn_cta disabled"' : ' class="asc_btn_cta actionable"' ?> >
                            <?php
                            if($is_on_list){
                                echo '<span><i class="fa fa-check"></i> Added</span>';
                            }else{
                                echo '<span class="cta-asc-text"><i class="fa fa-plus"></i> Add to my Adventure</span>';
                            }
                            ?>
                        </a>
                    </div>

                    <div class="col-md-6 order-md-1 asc-overview-container" >
                        <p class="asc-overview-text">OVERVIEW</p>
                        <?php echo get_field('asc_event_overview')?>
                    </div>


                </div>
            </div>
        </div>


    </div>
    <div class="asc-post-content <?php echo get_field('asc_content_page') == 'box' ? 'container p-0' : 'container-fluid' ?>">
        <?php the_content() ?>
    </div>

<?php
endwhile; // End of the loop.
?>