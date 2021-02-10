<?php

/**
 * Return Current year
 */
add_shortcode( 'asc_year', 'site_year' );
function site_year(){
    ob_start();
    echo date( 'Y' );
    $output = ob_get_clean();
    return $output;
}

/**
 * Add button modal
 */
add_shortcode( 'asc_cta_modal', 'asc_cta_modal' );
function asc_cta_modal($atts){

    $a = shortcode_atts(array(
        'button_text' => 'My Adventure', //it's category id
        'modal_target' => '',
        'icon_class' => 'fa fa-list',
        'just_icon' => false,
        'img' => '',
        'css' => 'width:100%;margin-left:0'
    ), $atts);
    $just_icon = $a['just_icon'] ? 'just_icon' : '';

    if( isset($a['img']) && !empty($a['img']) ){
        return '<a style="' . $a['css'] . '"  href="javascript: void(0)" class="nav-link asc_btn_cta spanable ' . $just_icon .'" data-toggle="modal" data-target="#cta_my_adventure">
            <img src="' . $a['img'] . '"> <span>' . $a['button_text'] .'</span>
        </a>';
    }else{
        return '<a style="' . $a['css'] . '"  href="javascript: void(0)" class="nav-link asc_btn_cta spanable ' . $just_icon .'" data-toggle="modal" data-target="#cta_my_adventure">
        <i class="' . $a['icon_class'] . '"></i> <span>' . $a['button_text'] .'</span>
    </a>';
    }
    
}


add_shortcode( 'adventuresci_posts', 'adventuresci_posts_func' );
function adventuresci_posts_func( $atts ) {

    $atts = shortcode_atts( array(
        'limit' => 10,
        'pagination' => 'yes',
    ), $atts, 'events' );

    // the query to set the posts per page to 3
    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $args = array('posts_per_page' => $atts['limit'], 'paged' => $paged,'orderby' => 'post_date', 'order' => 'DESC','post__not_in' => get_option("sticky_posts"));
    $query = new WP_Query( $args );
    
 ?>
 <style type="text/css">
    .flex_row_main_container {
    max-width: 1140px;
    margin: 0 auto;
}
     .flex_row
     {
            -ms-flex-direction: row;
    -webkit-flex-direction: row;
    flex-direction: row;
    box-sizing: border-box;
    border: none;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    overflow: hidden;
    position: relative;
    width: 100%;
        box-shadow: 0px 0px 10px 4px rgba(0,0,0,.1);
    padding: 12px;
    margin-bottom: 30px;
     }
     .post-left-data
     {
            align-self: center;

padding: 0 70px 0 70px;
    -ms-flex: 0 0 65%;
    -webkit-flex: 0 0 65%;
    flex: 0 0 65%;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -ms-flex-direction: column;
    -webkit-flex-direction: column;
    flex-direction: column;
    -ms-flex-align: start;
    -webkit-align-items: flex-start;
    align-items: flex-start;
     }
     .post-right-data
     {

        position: relative;
    width: 35%;
    padding-bottom: 35%;
    height: 0;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
     }
     .post-link a {
    font-weight: bold;
    text-transform: uppercase;
}
.post-link {
    margin-top: 30px;
}
.post-link a i {
    margin-right: 6px;
}
.month-title p
{
 text-transform: uppercase;   
}
.paginate_numbers {
    color: #777777;
    font-size: 15px;
    font-family: "Muli", Arial, sans-serif;
    text-align: center;
    margin: 70px 0px;
}
.paginate_numbers .page-numbers
{
 margin-right: 20px;   
}
span.page-numbers.current {
    color: #007bff;
    font-weight: 600;
}
@media screen and (max-width:767px)
{
.post-left-data-sticky {
    padding: 0 0px 30px 0px;
    -ms-flex: 0 0 65%;
    -webkit-flex: 0 0 100%;
    flex: 0 0 100%;
}
.post-right-data {
    position: relative;
    width: 100%;
    padding-bottom: 100%;
}
.flex_row_sticky {
    display: block;
    margin-top: -25rem;
}
.flex_row_sticky .post-title {
    font-size: 26px;
    line-height: 40px;
}
}
 </style>
 <?php
    
    if ( $query->have_posts() ) {
        $lastmonth = $data ='';
        $data .= '<div class="flex_row_main_container">';
        while ( $query->have_posts() ) {
            $query->the_post();           
            $month = date( 'F', strtotime($query->post->post_date) );
             if ( $month != $lastmonth ) {
                $data .= "<div class='month-title row'><div class='col-12 col-md-12'> <p>$month </p></div></div> ";
             }

             if (has_post_thumbnail( $post->ID ) ){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $query->post->ID ), 'single-post-thumbnail' );
             }

             $data .= '<div class="flex_row">';
             $data .= '<div class="post-left-data col-12 col-md-6">';
            $data .= '<p class="post-date"> '.date( 'm/d/y', strtotime($query->post->post_date) ).' </p>';
            $data .= '<h2 class="post-title"> '.$query->post->post_title.' </h2>';
            $data .= '<p class="post-excerpt"> '.get_the_excerpt($query->post->ID).' </p>';
            $data .= '<div class="post-link"> <a href="'. esc_url( get_permalink($query->post->ID) ) .'"><i class="fas fa-caret-right"></i> Read More </a></div>';
            $data .= '</div>';
            $data .= '<div class="post-right-data col-12 col-md-6" style="background-image: url('.$image[0].')">';
            $data .= '</div>';
            $data .= '</div>';
            $lastmonth = $month;
        }
        global $wp_query;
        if( isset($atts['pagination']) && $atts['pagination'] == 'yes' ) {
            $data .= '<div class="paginate_numbers">';
            $data .= paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf( '<i></i> %1$s', __( '<i class="fas fa-caret-left"></i>', 'text-domain' ) ),
                'next_text'    => sprintf( '%1$s <i></i>', __( '<i class="fas fa-caret-right"></i>', 'text-domain' ) ),
                'add_args'     => false,
                'add_fragment' => '',
            ) );
            $data .= '</div>';
        }
        $data .= '</div>';
    }


return $data;
}


add_shortcode( 'adventuresci_stickyposts', 'adventuresci_stickyposts_func' );
function adventuresci_stickyposts_func( $atts ) {

    $args = array('posts_per_page' => 1, 'orderby' => 'post_date',    'order' => 'DESC','post__in' => get_option("sticky_posts"));
    $query = new WP_Query( $args );
    ?>
    <style type="text/css">
    .flex_row_main_container {
    max-width: 1140px;
    margin: 0 auto;
}
     .flex_row_sticky
     {
            -ms-flex-direction: row;
    -webkit-flex-direction: row;
    flex-direction: row;
    box-sizing: border-box;
    border: none;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    overflow: hidden;
    position: relative;
    width: 100%;
        margin-top: -20rem;
     }
     .post-left-data-sticky
     {
padding: 0 70px 0 0px;
    -ms-flex: 0 0 65%;
    -webkit-flex: 0 0 65%;
    flex: 0 0 65%;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -ms-flex-direction: column;
    -webkit-flex-direction: column;
    flex-direction: column;
    -ms-flex-align: start;
    -webkit-align-items: flex-start;
    align-items: flex-start;
     }
     .post-right-data
     {

        position: relative;
    width: 35%;
    padding-bottom: 35%;
    height: 0;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
     }
     .post-link a {
    font-weight: bold;
    text-transform: uppercase;
}
.post-link {
    margin-top: 30px;
}
.post-link a i {
    margin-right: 6px;
}
.month-title p
{
 text-transform: uppercase;   
}
.paginate_numbers {
    color: #777777;
    font-size: 15px;
    font-family: "Muli", Arial, sans-serif;
    text-align: center;
    margin: 70px 0px;
}
.paginate_numbers .page-numbers
{
 margin-right: 20px;   
}
span.page-numbers.current {
    color: #007bff;
    font-weight: 600;
}
.content-under-nav {
    display: none;
}
.flex_row_sticky .post-title
{
        font-size: 56px;
    color: white;
    text-align: left;
    line-height: 64px;
    font-weight: 700;
    font-family: 'Oswald', sans-serif !important;
    text-transform: uppercase;
}
#header-main
{
    min-height: 35em;
}
.post-sticky-title
{
    color:#ffffff;
    text-transform: uppercase;
}
@media screen and (max-width:767px)
{
.flex_row .post-left-data {
    padding: 0 0px 30px 0px;
    -ms-flex: 0 0 65%;
    -webkit-flex: 0 0 100%;
    flex: 0 0 100%;
}
.flex_row .post-right-data {
    position: relative;
    width: 100%;
    padding-bottom: 100%;
}
.flex_row_main_container .flex_row {
    display: block;
}
.flex_row_main_container .flex_row .post-title {
    font-size: 26px;
    line-height: 40px;
}
}
 </style>
    <?php
    if ( $query->have_posts() ) {
       $data ='';
       $data .= '<div class="flex_row_main_container">';
        while ( $query->have_posts() ) {
            $query->the_post();           
            
            if (has_post_thumbnail( $post->ID ) ){
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $query->post->ID ), 'single-post-thumbnail' );
            }

            $data .= '<div class="flex_row_sticky">';
             $data .= '<div class="post-left-data-sticky col-12 col-md-6">';
            $data .= '<p class="post-sticky-title" style=""> Latest Blog Post </p>';
            $data .= '<h2 class="post-title"> '.$query->post->post_title.' </h2>';
            $data .= '<div class="post-link"> <a href="'. esc_url( get_permalink($query->post->ID) ) .'"><i class="fas fa-caret-right"></i> Read More </a></div>';
            $data .= '</div>';
            $data .= '<div class="post-right-data col-12 col-md-6" style="background-image: url('.$image[0].')"></div>';
            $data .= '</div>';
        }
        $data .= '</div>';
    }


return $data;
}


add_shortcode( 'adventuresci_events', 'adventuresci_events_func' );
function adventuresci_events_func( $atts ) {
    $atts = shortcode_atts( array(
        'topfield' => '',
        'filterkey' => '',
        'filterval' => '',
        'sorting' => 'yes',
        'featuredonly' => 'no',
        'limit' => 9,
        'col' => 3,
        'titlesec' => '',
        'colorcode' => '',
        'pagination' => 'no'
    ), $atts, 'events' );


    $data ='';
    $order = 'ASC';
    if( isset($_GET['sort']) && !empty($_GET['sort']) ){
        $order = $_GET['sort'];
    }

    if( isset($atts['limit'])){
        $limit = $atts['limit'];
    }

    
    if( isset($atts['filterkey']) && !empty($atts['filterkey']) && isset($atts['filterval']) ){
        
        $filterarr =  array(
            'relation' => 'AND',
            array(
                'key'     => $atts['filterkey'],
                'value'   => $atts['filterval'],
            ),
            array(
                'key'     => '_EventEndDate',
                'value'   => date("Y-m-d H:i:s"),
                'compare' => '>='
            )
            );            
            
    }else{
        $filterarr =  array(
            'relation' => 'AND',
            array(
                'key'     => '_EventEndDate',
                'value'   => date("Y-m-d H:i:s"),
                'compare' => '>='
            )
            );
    }

    $featuedmeta = 'NOT EXISTS';
    if( isset($atts['featuredonly']) && $atts['featuredonly'] == 'yes'  ){
        $featuedmeta = 'EXISTS';
    }
    $featured = array(
        'key'     => '_tribe_featured',
        'value'   => '1',
        'compare' => $featuedmeta
    );
    $filterarr = array_merge( $filterarr, array($featured) );

    $col = $atts['col'];
    $bootstrapcol = 12/$col;

    $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $args = array(
        'post_type' => 'tribe_events', 
        'posts_per_page' => $limit, 
        'paged' => $paged,
        'orderby' => 'meta_value',    
        'order' => $order, 
        'meta_key' => '_EventStartDate', 
        'meta_query' => $filterarr
    );
    $query = new WP_Query( $args );

    
    if ( $query->have_posts() ) {
        $i = 1;
        $data .= '<div class="events">';
        if( isset($atts['sorting']) && $atts['sorting'] == 'yes' ){
            $data .= '<div class="row events_shorting"> <div class="col-12 col-md-6"><p>'.$atts['titlesec'].'</p></div> <div class="col-12 col-md-6 text-sm-right"><form action="" method="get"> <select name="sort" onchange="javascript:this.form.submit()"><option>Sort by
</option> <option value="asc">asc</option><option value="desc">desc</option></select> </form></div> </div>';
        }
        $data .= '<div class="row events_sec_wrapper">';
        while ( $query->have_posts() ) {
            $query->the_post(); 

            if( isset($atts['topfield']) && !empty( $atts['topfield'] ) ){
                $topfiledval = get_post_meta( $query->post->ID, $atts['topfield'], true );
            }else{
                $topfiledval = tribe_get_start_time ( $query->post->ID, 'F j');
                if ( date( 'mdy') == tribe_get_start_time ( $query->post->ID, 'mdy') ) {
                    $topfiledval = tribe_get_start_time ( $query->post->ID, 'h:iA') ;
                }
            }

            
            
            $startdate = get_post_meta( $query->post->ID, '_EventStartDate', true );
            $thumbnail_size = apply_filters( 'tribe_events_list_widget_thumbnail_size', 'post-thumbnail' );
 
            $featured_image_link = apply_filters( 'tribe_events_list_widget_featured_image_link', true );
            $post_thumbnail      = get_the_post_thumbnail( null, 'event_vertical_img' );
	    $post_thumbnail_url  = wp_get_attachment_image_src( get_post_thumbnail_id( $query->post->ID ) )[0];

 
            if ( $featured_image_link ) {
            
            }
            
            $data .= '<div class="col-12 col-md-'.$bootstrapcol.' mb-4">';
           
			$data .= '<div class="events_sec">';
			$data .= '<div class="post-img-data">';
			$data .= '<div class="thumbnail-bg-img" style="background-image:url('.$post_thumbnail_url.'); background-repeat:no-repeat; background-position: 50% 50%; background-size: cover; min-width:338px; min-height:388px; filter: blur(4px); position: absolute;"></div>';
            if ( ! empty( $topfiledval ) ) {
                $data .= '<div class="post-date" style="z-index:1; background-color:'.$atts['colorcode'].';"> <span class="plus_icon_text">'. $topfiledval .'</span> <span class="plus_icon"><i class="fas fa-plus"></i></span></div>';
            }
            $data .= '<a class="event-thumbnail-link" href="' . esc_url( tribe_get_event_link() ) . '"> '.$post_thumbnail.'</a>';
            $data .= '</div>';
            $data .= '<div class="px-5"><h2 class="post-title"> <a href="' . esc_url( tribe_get_event_link() ) . '">'.$query->post->post_title.'</a> </h2></div>';
            $data .= '<p class="post-excerpt"> '.get_the_excerpt($query->post->ID).' </p>'; 
            $data .= '<div class="post-hover-link"><a href="' . esc_url( tribe_get_event_link() ) . '"><i class="fas fa-caret-right"></i><span>CHECK IT OUT</span>  </a></div>';
            
            $data .= '</div>';
			$data .= '</div>';

            $lastmonth = $month;
           
            if($i % $col == 0) {
                $data .= '</div> <div class="row events_sec_wrapper">';
            }
            $i++;
        }
        $data .= '</div>';

        global $wp_query;
        if( isset($atts['pagination']) && $atts['pagination'] == 'yes' ){
            $data .= '<div class="paginate_numbers">';
            $data .= paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'plain',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf( '<i></i> %1$s', __( '<i class="fas fa-caret-left"></i>', 'text-domain' ) ),
                'next_text'    => sprintf( '%1$s <i></i>', __( '<i class="fas fa-caret-right"></i>', 'text-domain' ) ),
                'add_args'     => false,
                'add_fragment' => '',
            ) );
            $data .= '</div>';
        }
        $data .= '</div>';
    }


return $data;
}

add_shortcode('archive_list_wp', 'archive_list_wp_func');
function archive_list_wp_func($atts) {
    $atts = shortcode_atts(
    array(
        'limit' => '',
    ), $atts, 'archive_list_wp' ); 
    ob_start();
    
    
    /*Condition of title attribute*/
    if($atts["limit"] !== '') {
        ?>
        <ul>
            <?php wp_get_archives('type=monthly&limit='.$atts["limit"]); ?>
        </ul>
        <?php 
    }   
    else
    {
        ?>
        <ul>
            <?php wp_get_archives('type=monthly&limit=7'); ?>
        </ul>
        <?php
    }
    /*Condition of title attribute*/
    
    $content = ob_get_clean();
    return $content;
}

add_shortcode('mobile_menu_section', 'mobile_menu_section_func');
function mobile_menu_section_func($atts) {
    $atts = shortcode_atts(
    array(
        'title' => '',
        'sub_title' => '',
        'id' =>'',
    ), $atts, 'mobile_menu_section' ); 
    ob_start();

    $children = get_pages( array( 'child_of' => get_the_ID()) );

    if( count( $children ) == 0 ) {
        //$parent_page_id = wp_get_post_parent_id( get_the_ID() );
    }
    else
    {
        //$parent_page_id = get_the_ID();
        $current_pageargs = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => get_the_ID(),
            'parent' => -1,
            'exclude_tree' => '',
            'number' => '',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
        ); 
        $current_pages = get_pages($current_pageargs);
        if(!empty($current_pages)) {
        echo '<ul class="child_menu" style="padding:0 !important;">';
        foreach ( $current_pages as $current_page ) {
            echo '<li><a href="'.get_page_link($current_page->ID).'">'.$current_page->post_title.'</a></li>';
        }
        echo '</ul>';
        }
    }



    $parent_page_id = wp_get_post_parent_id( get_the_ID() );
    echo $parent_page_id;
    if($parent_page_id != "0") {
        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => get_the_ID(),
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => $parent_page_id,
            'parent' => -1,
            'exclude_tree' => '',
            'number' => '',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish'
        ); 
        $pages = get_pages($args); 
        if(!empty($pages)) {
        echo '<ul class="menu" style="padding:0 !important;">';
        foreach ( $pages as $page ) {
            $children = get_pages( array( 'child_of' => $page->ID) );
            if( count( $children ) == 0 ) {
                echo '<li>';
            }
            else
            {
                echo '<li class="asdasd">';
            }
            echo '<a href="'.get_page_link($page->ID).'">'.$page->post_title.'</a></li>';
        }
        echo '</ul>';
        }
    }

   ?>

   <div class="mobile_main_page_menu">
       <?php echo get_the_title(); ?>
   </div>
   <div class="mobile_main_page_children_menus">
       
   </div>
   <?php 
    
    $content = ob_get_clean();
    return $content;
}
