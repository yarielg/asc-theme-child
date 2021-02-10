
<!-- Mobile Primary Menu Modal -->
<div class="modal right fade" id="left_modal_sm" tabindex="-1" role="dialog" aria-labelledby="left_modal_sm">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    Close <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                wp_nav_menu(array(
                    'theme_location'    => 'primary_mobile',
                    'container'       => 'div',
                    'container_id'    => 'main-nav',
                    'container_class' => '',
                    'menu_id'         => false,
                    'menu_class'      => 'navbar-nav',
                    'depth'           => 2,
                   // 'fallback_cb'     => 'wp_asc_navwalker::fallback',
                  //  'walker'          => new wp_asc_navwalker()
                ));
                ?>
                <?php if ( is_active_sidebar( 'asc-mobile_secondary_menu' )) : ?>
                    <?php dynamic_sidebar( 'asc-mobile_secondary_menu' ); ?>
                <?php endif; ?>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>

<!-- My Adventure Modal -->
<div class="modal right fade" id="cta_my_adventure" tabindex="-1" role="dialog" aria-labelledby="cta_my_adventure">
    <div class="modal-dialog" role="document">
        <div class="asc-event-mask" style="display: none"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/loading.svg' ?>" alt=""></div>
        <div class="modal-content container">
            <div class="modal-header">
                <h4 class="modal-title">MY ADVENTURE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Questions about purchasing your tickets? <a href="#">Visit the pricing page to find out more.</a></p>
                <br>
                <div class="container asc-event-rows p-0">

                    <?php
                        $asc_events_general = asc_get_user_events_general();
                        $asc_events_featured = asc_get_user_events_featured();
                        $asc_events_simple = asc_get_user_just_events();
                        ?>

                        <div class="no-event-on-list text-center" style="display: <?php echo count($asc_events_general) > 0 || count($asc_events_featured) > 0 || count($asc_events_simple) > 0 ? 'none' : ''?>">
                            <p class='text-center asc-no-event'>No items have been added to your adventure yet. Click below to get started!</p>
                            <a href="/plan-your-adventure" class="asc_btn_cta blue asc-plan-your-adventure-link"><span>PLAN YOUR ADVENTURE</span></a>
                        </div>

                        <!-- Save My Itinerary-->
                        <form id="asc-intinerary-section" style="display: none">
                            <span id="asc-close-save-itinerary" class="featured-title mb-1"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/close-save-itinerary.svg' ?>" alt=""> SAVE MY ITINERARY</span>
                            <div class="input-group my-2">
                                <input id="asc-submit-email" class="form-control" type="email" required placeholder="Email">
                                <span class="input-group-append">
                                <div id="asc-submit-btn-container" class="input-group-text">
                                    <input id="asc-submit-adventure" type="submit" value="SUBMIT">
                                </div>
                            </span>
                        </div>
                    <p id="asc-info-submit-intinerary">Your itinerary will be emailed to you. Adding items to your itinerary does not guarantee that tickets or space will be available for those activities.
                    </p>
                        </form>
                        <div class="asc-itinerary text-center" style="display: <?php echo count(asc_get_user_events()) > 0  ? '' : 'none'?>">
                            <a style="height: 48px" href="javascript: void(0)" id="asc-save-itinerary-btn" class="asc_btn_cta blue"><span>SAVE MY ITINERARY</span></a>
                        </div>

                    <!-- General Admission -->
                    <br><br>
                    <div class="asc-general-events p-3">
                        <span id="asc-title-general-modal" class="featured-title" style="display: <?php echo count($asc_events_general) > 0 ? '' : 'none' ?>">GENERAL ADMISSION</span>
                        <div id="asc-general-rows-container">
                            <?php
                            foreach ($asc_events_general as $event){ ?>
                                <div class="row  asc-event-row on-list general" id="asc-event-<?php echo $event->ID ?>">
                                    <div class="col-3 p-0">
                                        <img style="width: 80px;height: 80px" src="<?php echo $url_event ?>" alt="">
                                    </div>
                                    <div class="col-7">
                                        <h6 class="asc-adventure-title"><?php echo strtoupper($event->post_title) ?></h6>
                                        <p class="asc-date"><?php echo tribe_get_start_date($event->ID, true,'m/d g:i A') ? tribe_get_start_date($event->ID, true,'m/d g:i A') : 'EXHIBIT' ?></p>
                                    </div>
                                    <div class="col-2 px-0">
                                        <a href="#" class="asc-remove-event" data-eventid="<?php echo $event->ID ?>"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                                <?php
                                $url_event = strlen(get_the_post_thumbnail_url($event->ID)) > 5 ? get_the_post_thumbnail_url($event->ID) : 'https://via.placeholder.com/80';
                            } ?>
                        </div>
                        <div  id="asc-buy-list-btn-general" style="display: <?php echo count($asc_events_general) > 0 ? '' : 'none' ?> ">
                            <div class="col p-0">
                                <a href="javascript: void(0)" data-type="<?php echo asc_get_type_event($event->ID) ?>" id="asc-buy-<?php echo $event->ID ?>" data-url="<?php echo get_field('altru_link', $event->ID) ?>" data-eventid="<?php echo $event->ID ?>" class="asc_btn_cta blue mb-3 float-right"><span class="cta-asc-text"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/ticket.svg' ?>" alt=""> BUY GENERAL ADMISSION</span></a>
                            </div>
                        </div>
                    </div>
                    <br><br>

                    <!-- FEATURED ADDONS -->
                    <div class="asc-featured-addons mt-4 p-3">
                        <span id="asc-title-featured-modal" class="featured-title" style="display: <?php echo count($asc_events_featured) > 0 ? '' : 'none' ?>">FEATURED ADDONS</span>
                    <?php

                            foreach ($asc_events_featured as $event){

                                $url_event = strlen(get_the_post_thumbnail_url($event->ID)) > 5 ? get_the_post_thumbnail_url($event->ID) : 'https://via.placeholder.com/80';
                               ?>


                                    <div class="row  asc-event-row on-list featured" id="asc-event-<?php echo $event->ID ?>">
                                        <div class="col-3 p-0">
                                            <img style="width: 80px;height: 80px" src="<?php echo $url_event ?>" alt="">
                                        </div>
                                        <div class="col-7">
                                            <h6 class="asc-adventure-title"><?php echo strtoupper($event->post_title) ?></h6>
                                            <p class="asc-date"><?php echo tribe_get_start_date($event->ID, true,'m/d g:i A') ? tribe_get_start_date($event->ID, true,'m/d g:i A') : 'EXHIBIT' ?></p>
                                        </div>
                                        <div class="col-2 px-0">
                                            <a href="#" class="asc-remove-event" data-eventid="<?php echo $event->ID ?>"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>

                                    <div class="row asc-buy-general-admission" id="asc-buy-list-btn-<?php echo $event->ID ?>" style="display: <?php echo count($asc_events_general) > 0 ? '' : 'none' ?> ">
                                        <div class="col p-0 mb-2">
                                            <a href="javascript: void(0)" data-type="<?php echo asc_get_type_event($event->ID) ?>" id="asc-buy-<?php echo $event->ID ?>" data-url="<?php echo get_field('altru_link', $event->ID) ?>" data-eventid="<?php echo $event->ID ?>" class="asc_btn_cta blue mb-3 float-right"><span class="cta-asc-text"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/ticket.svg' ?>" alt=""> BUY TICKET</span></a>
                                        </div>
                                    </div>
                            <?php } ?>
                        </div>

                    <br>
                    <br>
                    <!--  NO FEATURED AND NOT GENERAL-->
                    <div class="asc-simple-event p-3">
                        <?php

                        foreach ($asc_events_simple as $event){

                            $url_event = strlen(get_the_post_thumbnail_url($event->ID)) > 5 ? get_the_post_thumbnail_url($event->ID) : 'https://via.placeholder.com/80';
                            ?>


                            <div class="row  asc-event-row on-list featured" id="asc-event-<?php echo $event->ID ?>">
                                <div class="col-3 p-0">
                                    <img style="width: 80px;height: 80px" src="<?php echo $url_event ?>" alt="">
                                </div>
                                <div class="col-7">
                                    <h6 class="asc-adventure-title"><?php echo strtoupper($event->post_title) ?></h6>
                                    <p class="asc-date"><?php echo tribe_get_start_date($event->ID, true,'m/d g:i A') ? tribe_get_start_date($event->ID, true,'m/d g:i A') : 'EXHIBIT' ?></p>
                                </div>
                                <div class="col-2 px-0">
                                    <a href="#" class="asc-remove-event" data-eventid="<?php echo $event->ID ?>"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>

                            <div class="row asc-buy-general-admission" id="asc-buy-list-btn-<?php /*echo $event->ID */?>" style="display: <?php echo count($asc_events_simple) > 0 ? '' : 'none' ?> ">
                                <div class="col p-0 mb-2">
                                    <a href="javascript: void(0)" id="asc-buy-<?php echo $event->ID ?>" data-url="<?php echo get_field('altru_link', $event->ID) ?>" data-eventid="<?php echo $event->ID ?>" class="asc_btn_cta blue mb-3 float-right"><span class="cta-asc-text"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/ticket.svg' ?>" alt=""> BUY TICKET</span></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <br>
                <!-- Suggested Events-->
                <?php
                $events = tribe_get_events( [
                    'featured' => true
                ] );

                if(count($events) > 0) {
                ?>

                    <span class="featured-title">SUGGESTED</span><br>
                    <div class="container asc-featured-events mt-1">

                        <?php
                        foreach ($events as $event){
                            $is_on_list = asc_event_on_list($event->ID);
                            $url_event = strlen(get_the_post_thumbnail_url($event->ID)) > 5 ? get_the_post_thumbnail_url($event->ID) : 'https://via.placeholder.com/80';
                            if(!$is_on_list){
                                ?>
                                <div class="row asc-event-row featured" id="asc-event-<?php echo $event->ID ?>">
                                    <div class="col-3 p-0">
                                        <img style="width: 80px;height: 80px" src="<?php echo $url_event ?>" alt="">
                                    </div>
                                    <div class="col-7">
                                        <h6 class="asc-adventure-title"><?php echo strtoupper($event->post_title) ?></h6>
                                    </div>
                                    <div class="col-2 px-0">
                                        <a href="javascript: void(0)" data-date="<?php echo tribe_get_start_date($event->ID, true,'m/d g:i A') ? tribe_get_start_date($event->ID, true,'m/d g:i A') : 'EXHIBIT' ?>" data-altru="<?php echo get_field('altru_link', $event->ID) ?>" data-type="<?php echo asc_get_type_event($event->ID) ?>" data-mainurl="<?php echo get_stylesheet_directory_uri() . '/assets/img/ticket.svg' ?>" data-eventid="<?php echo $event->ID ?>" <?php echo $is_on_list ? 'class="asc_btn_cta disabled no-text  asc-add-featured-event"' : ' class="asc_btn_cta actionable asc-event asc-event-' .  $event->ID .' no-text asc-add-featured-event"' ?> >
                                            <span class="cta-asc-text"><i class="fa fa-plus"></i></span>
                                        </a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        } ?>
                    </div>
                </div>
                <!--<div class="row asc-buy-general-admission" style="display: <?php /*echo count($asc_events) > 0 ? '' : 'none' */?> ">
                    <div class="col p-0">
                        <a href="javascript: void(0)"  class="asc_btn_cta blue mt-3 float-right"><span class="cta-asc-text"><img src="<?php /*echo get_stylesheet_directory_uri() . '/assets/img/ticket.svg' */?>" alt=""> BUY GENERAL ADMISSION</span></a>
                    </div>
                </div>-->




            </div>
            <!--<div class="modal-footer modal-footer-fixed">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>-->
        </div>
    </div>
</div>

<!-- Search Modal Full Screen-->
<div class="modal full fade" id="asc_search_modal" tabindex="-1" role="dialog" aria-labelledby="asc_search_modal">
    <div class="modal-dialog" role="document">
        <div class="asc-event-mask" style="display: none"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/loading.svg' ?>" alt=""></div>
        <div class="modal-content">
            <div class="modal-header d-none">
                <h5 class="modal-title">Full Screen Modal Title</h5>
                <button type="button" class="fa fa-" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex" style="margin-top: 80px">
                <div class="container asc-search-modal-container">
                    <div class="row">
                        <div class="col-12 float-right mb-3 pr-0">
                            <button type="button" class="btn asc-search-btn-close float-right" data-dismiss="modal" aria-label="Close">
                               <img style="max-width: 200% !important;" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/close.svg' ?>" alt="">
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <input class="form-control" type="search" placeholder="Search" id="asc-main-search">
                            <span class="input-group-append">
                                <div class="input-group-text search-container"><img class="search-icon" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/search.svg' ?>"></div>
                            </span>
                        </div>
                    </div>

                    <div class="row search-label">
                        <p>SEARCH RESULTS</p>
                    </div>

                    <div class="asc-results-search"></div>
                </div>
            </div>

        </div>
    </div>
</div>