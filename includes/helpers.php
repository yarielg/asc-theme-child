<?php

/**
 * @desciption Return all the event within the user's adventure list
 * @return array
 */
function asc_get_user_events(){
    $posts = array();
    if(isset($_COOKIE['asc_user_id'])){

        $user_id = $_COOKIE['asc_user_id'];

        $ids =  unserialize(get_option($user_id,true));

        foreach ($ids as $id){
            $post = get_post($id);
            array_push($posts, $post);
        }
        return $posts;

    }
    return [];
}

/**
 * @description Get all the Event that are not General or Featured (Others Events)
 * @return array
 */
function asc_get_user_just_events(){
    $posts = array();
    if(isset($_COOKIE['asc_user_id'])){

        $user_id = $_COOKIE['asc_user_id'];

        $ids =  unserialize(get_option($user_id,true));

        foreach ($ids as $id){
            if(get_field('event_type',$id) != 'general' && !Tribe__Events__Featured_Events::is_featured($id) ){
                $post = get_post($id);
                array_push($posts, $post);
            }

        }
        return $posts;

    }
    return [];
}

/**
 * @description Get all the General Events
 * @return array
 */
function asc_get_user_events_general(){
    $posts = array();
    if(isset($_COOKIE['asc_user_id'])){

        $user_id = $_COOKIE['asc_user_id'];

        $ids =  unserialize(get_option($user_id,true));

        foreach ($ids as $id){
            if(get_field('event_type',$id) == 'general'){
                $post = get_post($id);
                array_push($posts, $post);
            }

        }
        return $posts;

    }
    return [];
}

/**
 * @description Get all the Featured Events
 * @return array
 */
function asc_get_user_events_featured(){
    $posts = array();
    if(isset($_COOKIE['asc_user_id'])){

        $user_id = $_COOKIE['asc_user_id'];

        $ids =  unserialize(get_option($user_id,true));

        foreach ($ids as $id){
            if(Tribe__Events__Featured_Events::is_featured($id)){
                $post = get_post($id);
                array_push($posts, $post);
            }

        }
        return $posts;

    }
    return [];
}
/**
 * @description Check if an event is on the list
 * @param $id
 */
function asc_event_on_list($id){

    if(isset($_COOKIE['asc_user_id'])){
        $user_id = $_COOKIE['asc_user_id'];
        $ids =  unserialize(get_option($user_id,true));
        if (array_search($id, $ids) !== false) {
            return true;
        } 
    }

    return false;

}

/**
 * @description Get the Event Type by ID
 * @param $id
 * @return string
 */
function asc_get_type_event($id){

    $type = Tribe__Events__Featured_Events::is_featured($id) ? 'featured' : '';
    if($type != 'featured') $type = get_field('event_type',$id);

    return $type;

}

