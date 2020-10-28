<?php

/**
 * Add theme image sizes
 */
add_image_size( 'saasland_370x360', 370, 360, true); // Posts carousel thumbnail
add_image_size( 'saasland_770x480', 770, 480, true); // Blog list thumbnail
add_image_size( 'saasland_570x340', 570, 340, true);
add_image_size( 'saasland_110x80', 110, 80, true);
add_image_size( 'saasland_800x400', 800, 400, true);
add_image_size( 'saasland_455x600', 455, 600, true);
add_image_size( 'saasland_520x300', 520, 300, true);
add_image_size( 'saasland_75x75', 75, 75, true);
add_image_size( 'saasland_240x200', 240, 200, true);
add_image_size( 'saasland_370x350', 370, 350, true);
add_image_size( 'saasland_240x250', 240, 250, true);
add_image_size( 'saasland_350x365', 350, 365, true); // Related post thumb in full width mode

/**
 * Add category nick names in body and post class
 * @param $classes
 * @return array
 */
function saasland_post_class( $classes ) {
    global $post;
    if ( !has_post_thumbnail() ) {
        $classes[] = 'no-post-thumbnail';
    }
    return $classes;
}
add_filter( 'post_class', 'saasland_post_class' );


/**
 * Body classes
 */
add_filter( 'body_class', function($classes) {
    $opt = get_option( 'saasland_opt' );
    $shop_view_style = !empty($_GET['view']) ? $_GET['view'] : '';
    $is_header_top = isset( $opt['is_header_top'] ) ? $opt['is_header_top'] : '';
    $error_img_select = !empty( $opt['error_img_select'] ) ? $opt['error_img_select'] : '1';
    $my_theme = wp_get_theme();
    $theme_name = strtolower($my_theme->get('Name'));
    $theme_version = $theme_name.'-'.$my_theme->get( 'Version' );
    if ( !has_nav_menu( 'main_menu' ) ) {
        $classes[] = 'no_main_menu';
    }
    if ( $shop_view_style == 'grid' ) {
        $classes[] = 'shop_grid';
    }
    if ( $shop_view_style == 'list' ) {
        $classes[] = 'shop_list';
    }
    if ( $is_header_top == '1' && ( !empty( $opt['ht_left_content']) || !empty($opt['ht_right_content']) ) ) {
        $classes[] = 'header_top_shown';
    }
    if ( !is_user_logged_in() ) {
        $classes[] = 'not_logged_in';
    }
    if ( is_404() && $error_img_select == '2' ) {
        $classes[] = 'error_page2';
    }
    if ( is_home() ) {
        $classes[] = $opt['blog_layout'] == 'list' ? 'blog-list-layout' : '';
    }
    if ( is_page_template('page-job-apply-form.php') ) {
        $classes[] = 'page-job-apply';
    }

    $classes[] = $theme_version;

    return $classes;
});

add_filter( 'admin_body_class', function($classes) {
    if ( function_exists('elementor_pro_load_plugin') ) {
        $classes = 'el-pro-activated';
    }
    return $classes;
});


/**
 * Show post excerpt by default
 * @param $user_login
 * @param $user
 */
function saasland_show_post_excerpt( $user_login, $user ) {
    $unchecked = get_user_meta( $user->ID, 'metaboxhidden_post', true );
    $key = is_array($unchecked) ? array_search( 'postexcerpt', $unchecked ) : FALSE;
    if ( FALSE !== $key ) {
        array_splice( $unchecked, $key, 1 );
        update_user_meta( $user->ID, 'metaboxhidden_post', $unchecked );
    }
}
add_action( 'wp_login', 'saasland_show_post_excerpt', 10, 2 );

/**
 * filter to replace class on reply link
 */
add_filter( 'comment_reply_link', function($class){
    $class = str_replace("class='comment-reply-link", "class='comment_reply", $class);
    return $class;
});

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function saasland_pingback_header() {
    if ( is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'saasland_pingback_header' );


/**
 * Move the comment field to bottom
 */
add_filter( 'comment_form_fields', function ( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
});

/**
 * Remove WordPress admin bar default CSS
 */
add_action( 'get_header', function() {
    remove_action( 'wp_head', '_admin_bar_bump_cb' );
});

/**
 * Elementor post type support
 */
function saasland_add_cpt_support() {

    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );

    //check if option DOESN'T exist in db
    if ( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'header', 'footer', 'cs_study' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    //if it DOES exist, but header is NOT defined
    elseif ( !in_array( 'header', $cpt_support ) ) {
        $cpt_support[] = 'header'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    //if it DOES exist, but footer is NOT defined
    elseif ( !in_array( 'footer', $cpt_support ) ) {
        $cpt_support[] = 'footer'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    //if it DOES exist, but footer is NOT defined
    elseif ( !in_array( 'cs_study', $cpt_support ) ) {
        $cpt_support[] = 'cs_study'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
}
add_action( 'after_switch_theme', 'saasland_add_cpt_support' );

/**
 * Redirect after theme activation
 */
add_action( 'after_switch_theme', function() {
    if ( isset( $_GET['activated'] ) ) {
        wp_safe_redirect( admin_url('admin.php?page=saasland') );
        exit;
    }
});

/**
 * Notice dismiss handle
 */
add_action( 'admin_init', function() {
    if ( isset($_GET['dismissed']) && $_GET['dismissed'] == 1 ) {
        update_option('notice_dismissed', '1');
    }
});