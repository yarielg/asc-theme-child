<?php

//List product under certain category
function vt_product_by_category( $atts )
{
    /*$order_by = isset($_GET['orderby']) ? $_GET['orderby'] : null;
    $a = shortcode_atts(array(
        'category_slug' => 'dvds', //it's category id
        'col' => 4,
        'title' => 'Products'
    ), $atts);*/

    $posts = get_posts(array(
        'numberposts'	=> -1,
        'post_type'		=> 'asc-event',
        /*'meta_query'	=> array(
            'relation'		=> 'AND',
            array(
                'key'	 	=> 'color',
                'value'	  	=> array('red', 'orange'),
                'compare' 	=> 'IN',
            ),
            array(
                'key'	  	=> 'featured',
                'value'	  	=> '1',
                'compare' 	=> '=',
            ),
        ),*/
    ));

    $loop = new WP_Query($args);


    $output = "<div class='container inner-body  d-none d-lg-block'>
                            <div class='row header-category-section d-flex justify-content-between '>
                                <h2 class='category-title'>" . $a['title'] . "</h2>
                                <form class='vt-category-filters' method='get' >
	<select data-category='".$a['category_slug']."' name='orderby' class='orderby vt_select_filter_category_shortcode' aria-label='Shop order'>
					<option value='popularity'> Most Popular</option>
					<option value='date'> Newest</option>
					<option value='price'> Price (low to high)</option>
					<option value='price-desc'> Price (high to low)</option>
			</select>
	<input type=\"hidden\" name=\"paged\" value=\"1\">
	</form>
                        </div>
                        
                    <div class='row'>";
    $cont = 0;
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            if($cont == 8) break;
            $loop->the_post();
            if (has_post_thumbnail(get_the_ID())) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');


                $real_product = wc_get_product(get_the_ID());
                $price = $real_product->get_price() > 0 ? $real_product->get_price() : 0;
                $output .= "<div class=' text-center product-category p-3 vt-product-sc-category col-md-3 d-flex flex-column ".$cont."' >" .
                    "<a href='" . get_the_permalink(get_the_ID()) . "'><img class='product-img img-responsive' src='" . $image[0] . "'></a>" .
                    "<p class='product-title' class='py-2'>" . get_the_title() . "</p>" .
                    "<p class='price-product-cat'><sup class='dollar-sign'>$</sup><span>" . number_format($price, 2) . "</span></p>" .
                    "</div>";
                $cont++;

            }
        }
        wp_reset_postdata();
    }
    $output .= "</div></div>";
    $loop = new WP_Query($args);
    $output .= "<div class='container inner-body  d-lg-none'>
                            <div class='row header-category-section d-flex justify-content-between '>
                                <h2 class='category-title'>" . $a['title'] . "</h2>
                                <form class='woocommerce-ordering p-3' method='get'>
	<select name='orderby' class='orderby' aria-label='Shop order'>
					<option value='popularity'> Most Popular</option>
					<option value='date'> Newest</option>
					<option value='price'> Price (low to high)</option>
					<option value='price-desc'> Price (high to low)</option>
			</select>
	<input type=\"hidden\" name=\"paged\" value=\"1\">
	</form>
                        </div>
                        
                    <div class='row swiper-container'><div class='swiper-wrapper'>";
    $cont = 0;
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            if (has_post_thumbnail(get_the_ID())) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));


                $real_product = wc_get_product(get_the_ID());
                $price = $real_product->get_price() > 0 ? $real_product->get_price() : 0;
                $output .= "<div class=' text-center product-category p-3 vt-product-sc-category swiper-slide d-flex flex-column  ".$cont."' >" .
                    "<a href='" . get_the_permalink(get_the_ID()) . "'><img class='product-img img-responsive' src='" . $image[0] . "'></a>" .
                    "<p class='product-title'>" . get_the_title() . "</p>" .
                    "<p class='price-product-cat'><sup class='dollar-sign'>$</sup><span>" . number_format($price, 2) . "</span></p>" .
                    "</div>";
                $cont++;

            }
        }
        wp_reset_postdata();
    }
    $output .= "</div><div class='swiper-pagination'></div></div></div>";
    return $output;
}
add_shortcode( 'vt_prod_bt_cat', 'vt_product_by_category' );