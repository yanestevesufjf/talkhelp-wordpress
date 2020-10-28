<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package saasland
 */

// Theme settings options
$opt = get_option( 'saasland_opt' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <!-- For IE -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- For Resposive Device -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?> data-spy="scroll" data-target=".navbar" data-offset="70">
    <?php
    if ( function_exists('wp_body_open') ) {
        wp_body_open();
    }
    ?>

    <?php get_template_part('template-parts/header_elements/preloader'); ?>

    <div class="body_wrapper">
        <?php
        $header_style = '';
        if ( !empty($opt['header_style']) && ($opt['header_style'] != 'default' ) ) {
            $header_style = new WP_Query(array(
                'post_type' => 'header',
                'posts_per_page' => -1,
                'p' => $opt['header_style'],
            ));
        }

        /**
         * Header Navbar
         */
        if ( $header_style != '' && !\Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            if ( $header_style->have_posts() ) {
                while ( $header_style->have_posts() ) : $header_style->the_post();
                    the_content();
                endwhile;
                wp_reset_postdata();
            }
        } else {
            $page_navbar_type = function_exists('get_field') ? get_field('navbar_type') : '';
            if ( !empty($page_navbar_type) && $page_navbar_type != 'default' ) {
                $navbar_type = $page_navbar_type;
            } else {
                $navbar_type = !empty($opt['navbar_type']) ? $opt['navbar_type'] : 'classic';
            }
            get_template_part( 'template-parts/header_elements/navbar', $navbar_type );
        }

        /**
        * Title-bar Banner Area
        */
        if ( is_home() ) {
            $banner_style = !empty($opt['blog_banner_style']) ? $opt['blog_banner_style'] : '2';
        } else {
            $banner_style = !empty($opt['banner_style']) ? $opt['banner_style'] : '1';
        }

        // Is Banner
        $is_banner = '1';
        if ( is_home() ) {
            $is_banner = '1';
        } elseif ( is_page() || is_single() ) {
            $is_banner = function_exists( 'get_field' ) ? get_field( 'is_banner' ) : '1';
            $is_banner = isset($is_banner) ? $is_banner : '1';
        }
        if ( is_404() || is_page_template('elementor_canvas') ) {
            $is_banner = '';
        }

        if ( !isset($_GET['elementor_library']) ) {
            if ( $is_banner == '1' ) {
                if ( !is_singular('post') ) {
                    if ( $banner_style == '1' ) {
                        get_template_part( 'template-parts/header_elements/banner' );
                    } elseif ( $banner_style == '2' ) {
                        get_template_part( 'template-parts/header_elements/banner2' );
                    }
                } elseif ( is_singular('post') ) {
                    get_template_part( 'template-parts/header_elements/banner-post' );
                }
            }
        }