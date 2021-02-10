<?php
/**
 * The template for displaying single event
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>


<?php
while ( have_posts() ) : the_post();
    $is_on_list = asc_event_on_list(get_the_ID());
    ?>
    <div class="container-fluid asc-event-post">
        <div class="asc-event-overview">
            <div class="container p-0">
                <div class="row">
                    <div class="col-md-6 order-md-12 p-0 asc-event-actions">
                        <p class="d-none d-md-block">TICKETS</p>
                        <a href="#" class="asc_btn_cta blue"><span>Buy Tickets</span></a>
                        <a href="javascript: void(0)" id="asc-event" data-eventid="<?php the_ID() ?>" <?php echo $is_on_list ? 'class="asc_btn_cta disabled"' : ' class="asc_btn_cta actionable"' ?> >
                            <?php
                            if($is_on_list){
                                echo '<span><i class="fa fa-check"></i> Added</span>';
                            }else{
                                echo '<span class="cta-asc-text"><i class="fa fa-plus"></i> Add to my Adventure</span>';
                            }
                            ?>
                        </a>
                    </div>

                    <div class="col-md-6 order-md-1" >
                        <p class="asc-overview-text">OVERVIEW</p>
                        <?php echo get_field('asc_event_overview')?>
                    </div>
                    <h1>asdasdasd</h1>

                </div>
            </div>
        </div>


    </div>
    <div class="asc-post-content">
        <?php the_content() ?>
    </div>

<?php
endwhile; // End of the loop.
?>


<?php
get_sidebar();
get_footer();
