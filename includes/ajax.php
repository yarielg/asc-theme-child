<?php


/**
 * Ajax requests (Adding Event to My Adventure)
 */
add_action( 'wp_ajax_asc_add_event', 'asc_add_event' );
add_action( 'wp_ajax_nopriv_asc_add_event', 'asc_add_event' );
function asc_add_event(){
    $id = $_POST['id'];
    $ids = array();
    //Checking if the cookie exist to create the event list for the user
    if(!isset($_COOKIE['asc_user_id'])){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $random_characters = 'user_' . substr(str_shuffle($permitted_chars),0, 15);
        setcookie('asc_user_id',$random_characters, time() + (86400 * 30 * 7), "/");
        update_option($random_characters, serialize(array($id)));
    }else{
        $user_id = $_COOKIE['asc_user_id'];
        $ids = unserialize(get_option($user_id,true));
        $ids = !empty($ids) ? $ids : array();
        // Checking if the event is not in the list
        if(!in_array($id, $ids)){
            array_push($ids, $id);
            update_option($user_id, serialize($ids));
            $post = get_post($id);
            if($post){
                $url_event = strlen(get_the_post_thumbnail_url($id)) > 5 ? get_the_post_thumbnail_url($id) : 'https://via.placeholder.com/80';
                echo wp_send_json_success( array('id' => $id, 'event_name' => $post->post_title, 'url' => $url_event, 'type' => asc_get_type_event($id)) );
                wp_die();
            }

        }else{
            wp_send_json_error(array('msg' => 'You already have this in your list!'));
        }

    }
    echo json_encode('Error, Try to add the event again');
    wp_die();
}

/**
 * Removing event from My Adventure
 */
add_action( 'wp_ajax_asc_remove_event', 'asc_remove_event' );
add_action( 'wp_ajax_nopriv_asc_remove_event', 'asc_remove_event' );
function asc_remove_event(){
    $id = $_POST['id'];
    $ids = [];
    if(isset($_COOKIE['asc_user_id'])){
        $user_id = $_COOKIE['asc_user_id'];
        $ids = unserialize(get_option($user_id,true));
        //$count = count($ids);
        if (($key = array_search($id, $ids)) !== false) {
            unset($ids[$key]);
            update_option($user_id, serialize($ids));
        }
    }

    echo json_encode( array('id' => $ids) );
    wp_die();
}

/**
 * Get events by searching term
 */
add_action( 'wp_ajax_asc_get_posts', 'asc_get_posts' );
add_action( 'wp_ajax_nopriv_asc_get_posts', 'asc_get_posts' );
function asc_get_posts(){
    $term = $_POST['term'];

    global $wpdb;

    $posts = $wpdb->get_results("SELECT p.ID,p.post_title,pm.meta_value FROM $wpdb->prefix" . "posts p INNER JOIN $wpdb->prefix" . "postmeta pm ON(p.ID=pm.post_id) WHERE post_type='tribe_events' AND pm.meta_key='asc_event_overview' AND post_title LIKE '%". $term ."%' LIMIT 5");
    $sanitized_posts = array();
    foreach ($posts as $post){
        array_push($sanitized_posts, array(
            'id' => $post->ID,
            'post_title' => $post->post_title,
            'link' => get_post_permalink($post->ID),
            'overview' => ucfirst(strtolower( substr(strip_tags($post->meta_value),0,250)))

        ));
    }
    echo wp_send_json_success( array('posts' => $sanitized_posts) );
    wp_die();
}

/**
 * Get events by searching term
 */
add_action( 'wp_ajax_asc_remove_event_redirection', 'asc_remove_event_redirection' );
add_action( 'wp_ajax_nopriv_asc_remove_event_redirection', 'asc_remove_event_redirection' );
function asc_remove_event_redirection(){
    $id = $_POST['id'];
    $ids = array();
    if(isset($_COOKIE['asc_user_id'])){
        $user_id = $_COOKIE['asc_user_id'];
        $ids = unserialize(get_option($user_id,true));
        //$count = count($ids);
        if (($key = array_search($id, $ids)) !== false) {
            unset($ids[$key]);
            update_option($user_id, serialize($ids));
        }
    }

    echo json_encode( array('id' => $ids) );
    wp_die();
}

/**
 * Send my adventure email
 */
add_action( 'wp_ajax_asc_send_adventure_email', 'asc_send_adventure_email' );
add_action( 'wp_ajax_nopriv_asc_send_adventure_email', 'asc_send_adventure_email' );
function asc_send_adventure_email(){
    $email = $_POST['email'];

    $general_events = asc_get_user_events_general();
    $featured_events = asc_get_user_events_featured();
    $others_events = asc_get_user_just_events();
    $hello = 'asdasd';
    ob_start();
    include(get_stylesheet_directory() . '/includes/email.php');
    $email_content = ob_get_contents();
    ob_end_clean();

    $subject = 'Your Adventure is here';
    $headers = array('Content-Type: text/html; charset=UTF-8');


    $sent = wp_mail( $email, $subject, $email_content, $headers );
    
    echo json_encode( array('success' => $sent,'general' => $general_events) );
    wp_die();
}


