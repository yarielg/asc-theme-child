<?php

//Plan My adventure shortcode
function asc_plan_my_adventure($atts)
{
    $subjects = get_terms( 'tribe_events_cat', array(
        'hide_empty' => false,
    ) );
    $count = 4;
    $html_subjects = '';
    $aux_html_open = "<div class='row ml-2'>";
    $aux_html_close = "</div>";

    foreach ($subjects as $subject){

        /*if($count%4 == 0){
            $html_subjects .= $aux_html_open;
        }*/
        $html_subjects .= "<div class='form-check form-check-inline col-12 col-md-3 col-lg-3 col-xl-3'>
                              <input name='asc_subjects[]' class='form-check-input' type='checkbox' id='sub_" . $subject->term_id ."' value='" . $subject->term_id ."'>
                              <label class='form-check-label' for='sub_" . $subject->term_id ."'>" . $subject->name ."</label>
                           </div>";
       /* if(($count + 1)%4 == 0){
            $html_subjects .= $aux_html_close;
        }
        $count ++;*/
    }

    $output = "<form method='post' action='#suggestions'>
                    <div id='plan-accordion'>
                        
                          <div class='d-flex justify-content-between mt-3'>
                              <span><p>What day are you visiting the museum?</p> </span>
                              <span><input type='text' name='event_date' id='tribeevent-datepicker' required value=''></span>
                          </div>
                          <div class='first-content-accordion'></div>
                          
                          <div class='d-flex justify-content-between mt-3'><p>How long are you staying?</p><p> <span class='search-accordion-info-right'>Select a time frame</span> <i class='fa fa-caret-right'></i></p></div>
                          <div>
                            <div class='row ml-2'>
                                <div class='form-check form-check-inline col'>
                                  <input class='form-check-input' name='stay[]' type='checkbox' id='stay_1' value='1'>
                                  <label class='form-check-label' for='stay_1'>< 1 hour</label>
                                </div>
                                <div class='form-check form-check-inline col'>
                                  <input class='form-check-input' name='stay[]' type='checkbox' id='stay_2' value='2'>
                                  <label class='form-check-label' for='stay_2'>1-2 hours</label>
                                </div>
                                <div class='form-check form-check-inline col'>
                                  <input class='form-check-input' name='stay[]' type='checkbox' id='stay_3' value='3'>
                                  <label class='form-check-label' for='stay_3'>2-3 hours</label>
                                </div>
                                <div class='form-check form-check-inline col'>
                                  <input class='form-check-input' name='stay[]' type='checkbox' id='stay_4' value='4'>
                                  <label class='form-check-label' for='stay_4'>Full day</label>
                                </div>
                            </div>
                          </div>
                          
                          <div  class='d-flex justify-content-between mt-3'><p>What age are in your group?</p><p> <span class='search-accordion-info-right'>Select an age group</span> <i class='fa fa-caret-right'></i></p></div>
                          <div>
                            <div class='row ml-2'>
                                <div class='form-check form-check-inline col'>
                                  <input name='age[]' class='form-check-input' type='checkbox' id='age_1' value='1'>
                                  <label class='form-check-label' for='age_1'>Under 10</label>
                                </div>
                                <div class='form-check form-check-inline col'>
                                  <input name='age[]' class='form-check-input' type='checkbox' id='age_2' value='2'>
                                  <label class='form-check-label' for='age_2'>Age 10-13</label>
                                </div>
                                <div class='form-check form-check-inline col'>
                                  <input name='age[]' class='form-check-input' type='checkbox' id='age_3' value='3'>
                                  <label class='form-check-label' for='age_3'>Age 14-17</label>
                                </div>
                                <div class='form-check form-check-inline col'>
                                  <input name='age[]' class='form-check-input' type='checkbox' id='age_4' value='4'>
                                  <label class='form-check-label' for='age_4'>Adults</label>
                                </div>
                            </div>
                          </div>
                          
                          <div  class='d-flex justify-content-between mt-3'><p>What subjects are you interested in?</p><p><span class='search-accordion-info-right'>Select a subject</span> <i class='fa fa-caret-right'></i></p></div>
                          <div>
                              <div class='row ml-2'>
                                " .  $html_subjects . "
                              </div>
                          </div>
                    </div>
                <button name='asc_see_result' type='submit'   id='asc_suggestions_result' class='asc_btn_cta blue mt-3'><span class=\"cta-asc-text\">SEE MY RESULTS</span></button></form>";
    $args = array(
        'numberposts'	=> -1,
        'post_type'		=> 'tribe_events'
    );
    /*if(isset($_POST['event_date']) && !empty($_POST['event_date'])){
        $date = date_create($_POST['event_date']);
        
         $args['meta_query'][] = array(
            'key' => '_EventStartDate',
            'value' => date_format($date,"Y-m-d H:i:s"),
            'type'  => 'DATE',
            'compare' => '='
        );
    }*/

    if(isset($_POST['asc_subjects']) && !empty($_POST['asc_subjects'])){
        $args['tax_query'] = array(
			array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'id',
				'terms' => $_POST['asc_subjects']
			)
		);
    }

    if(isset($_POST['age']) && !empty($_POST['age'])){ 
        if( is_array($_POST['age']) && count($_POST['age']) > 1){
            $age_arr = array('relation' => 'OR');
            foreach($_POST['age'] as $age){
                $age = str_replace('}', '', $age);
                $age_arr[] = array(
                    'key' => 'event_criteria_age_group',
                    'value' => serialize($age),
                    'compare' => 'LIKE'
                ); 
                $age = '';
            }
            $args['meta_query'][] = array(                
                $age_arr
            );
        }else{
                $age = str_replace('}', '', $_POST['age'][0]);
                $args['meta_query'][] = array(
                    'key' => 'event_criteria_age_group',
                    'value' => serialize($age),
                    'compare' => 'LIKE'
                ); 
        }
                 
    }
    if(isset($_POST['stay']) && !empty($_POST['stay'])){        
       

       if( is_array($_POST['stay']) && count($_POST['stay']) > 1){
            $stay_arr = array('relation' => 'OR');
            foreach($_POST['stay'] as $stay){
                $stay = str_replace('}', '', $stay);
                $stay_arr[] = array(
                    'key' => 'event_criteria_visit_staying',
                    'value' => serialize($stay),
                    'compare' => 'LIKE'
                ); 
                $stay = '';
            }
            $args['meta_query'][] = array(                
                $age_arr
            );
        }else{
                $stay = str_replace('}', '', $_POST['stay'][0]);
                $args['meta_query'][] = array(
                    'key' => 'event_criteria_visit_staying',
                    'value' => serialize($stay),
                    'compare' => 'LIKE'
                ); 
        }

   }

   $query = new WP_Query( $args );
 
    $output = "<div class='container-fluid px-0 asc-plan-shortcode'>
                    <div class='container'>
                        <div class='row'>
                        <div class='col-md-4'>
                            <h2>GET STARTED BY ANSWERING A FEW QUESTIONS.</h2>
                            <p>Or view all of our current offerings.</p>
                        </div>
                        <div class='col-md-8'>
                            " . $output ."
                        </div>
                    </div>
                    </div>
                    <div class='container-fluid px-0 mt-4 pb-3  asc-event-suggestions'>
                    <div class='container'>
                    <div class='row'>
                        <div id='suggestions' class='col-12 px-0'><p class='mt-4 ml-3'>SUGGESTIONS</p></div>
                    </div><div class='row'>";

    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
            $img_url = strlen(get_the_post_thumbnail_url(get_the_ID())) > 5 ? get_the_post_thumbnail_url(get_the_ID()) : 'https://via.placeholder.com/400';
            $event_link =  get_the_permalink(get_the_ID()) ;
            $output .= "<div class='col-md-4 mt-2'>
                            <div class='card asc-card-event' style='padding:20px;'><a href='" . $event_link ."'>
					            <div class='post-img-data'>
									<div class='thumbnail-bg-img' style='background-image:url($img_url); background-repeat:no-repeat; background-position: 50% 50%; min-width:338px; min-height:388px; filter: blur(4px); position: absolute;'></div>
									<div class='event-thumbnail-link'><img src='" . $img_url . "' alt='".get_the_title()."'></div>
								</div>
								<div class='event-card-body'>
									<h3 class='my-3 text-center'>" .  get_the_title()."</h3>  
									<p class='text-center'>" . ucfirst(strtolower( substr(strip_tags(get_field( 'asc_event_overview' , get_the_ID() )),0,100)))  . "</p>
								</div>
                           </a></div>
                        </div>";
    endwhile; 
    wp_reset_postdata();
    else :
        $output .= "<h3 class='text-center my-3 py-3'>There are not events with that search criteria</h3>";
    endif;


    return $output . "</div></div></div></div>";
}

add_shortcode('asc_plan_my_adventure', 'asc_plan_my_adventure');
