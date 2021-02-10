<?php


//Plan My adventure shortcode
function asc_featured_events($atts)
{
    $events = tribe_get_events( [
        'featured' => true
    ] );

    $output = '<div class="container asc-event-rows">';

    if(count($events) > 0){
        foreach ($events as $event){
            $url_event = strlen(get_the_post_thumbnail_url($event->ID)) > 5 ? get_the_post_thumbnail_url($event->ID) : 'https://via.placeholder.com/80';
            $output .= '<div class="row mb-2 asc-event-row" id="asc-event-' . $event->ID .'">
                                    <div class="col-3 p-0">
                                        <img style="width: 80px;height: 80px" src="' . $url_event . '" alt="">
                                    </div>
                                    <div class="col-7">
                                        <h6 class="asc-adventure-title">' . strtoupper($event->post_title). '</h6>
                                    </div>
                                    <div class="col-2 px-0">
                                        <a href="#" class="asc-remove-event" data-eventid="' .  $event->ID .'"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>';
        }
    }

    return $output . "</div>";
}

add_shortcode('asc_featured_events', 'asc_featured_events');