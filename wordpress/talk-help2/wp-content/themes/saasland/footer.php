<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package saasland
 */

$opt = get_option( 'saasland_opt' );
$copyright_text = !empty($opt['copyright_txt']) ? $opt['copyright_txt'] : esc_html__( '© 2020 DroitThemes. All rights reserved', 'saasland' );
$right_content = !empty($opt['right_content']) ? $opt['right_content'] : '';
$footer_visibility = function_exists( 'get_field' ) ? get_field( 'footer_visibility' ) : '1';
$footer_visibility = isset($footer_visibility) ? $footer_visibility : '1';

$footer_style = '';
if ( !empty($opt['footer_style']) ) {
    $footer_style = new WP_Query ( array (
        'post_type'       => 'footer',
        'posts_per_page'  => -1,
        'p'               => $opt['footer_style'],
    ));
}

if ( is_404() ) {
    ?>
    <footer>
        <div class="footer_bottom error_footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-5 col-sm-6">
                        <p class="mb-0 f_400"> <?php echo wp_kses_post(wpautop($copyright_text)); ?> </p>
                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-6">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <?php echo wp_kses_post(wpautop($right_content)) ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php
}
else {
    if ( $footer_visibility == '1' ) {

        if ( !empty($footer_style) && !\Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            if ( $footer_style->have_posts() ) {
                while ( $footer_style->have_posts() ) : $footer_style->the_post();
                    the_content();
                endwhile;
                wp_reset_postdata();
            }
        } else {
            if ( is_active_sidebar( 'footer_widgets') ) { ?>
                <footer class="new_footer_area bg_color">
                    <div class="new_footer_top">
                        <div class="container">
                            <div class="row">
                                <?php dynamic_sidebar( 'footer_widgets' ) ?>
                            </div>
                        </div>
                        <div class="footer_bg">
                            <?php if (!empty($opt['footer_obj_1']['url'])) : ?>
                                <div class="footer_bg_one"></div>
                            <?php endif; ?>
                            <?php if (!empty($opt['footer_obj_2']['url'])) : ?>
                                <div class="footer_bg_two"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="footer_bottom">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-sm-7">
                                    <?php echo wp_kses_post(wpautop($copyright_text)); ?>
                                </div>
                                <div class="col-lg-6 col-sm-5 text-right">
                                    <?php echo wp_kses_post(wpautop($right_content)) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <?php
            }
        }
    }
}

$is_search = !empty($opt['is_search']) ? $opt['is_search'] : '';
if ( $is_search == '1' ) :
    ?>
    <form action="<?php echo esc_url(home_url( '/')) ?>" class="search_boxs" role="search">
        <div class="search_box_inner">
            <div class="close_icon">
                <i class="icon_close"></i>
            </div>
            <div class="input-group">
                <input type="text" name="s" class="form_control search-input" placeholder="<?php esc_attr_e( 'Search here', 'saasland' ) ?>" autofocus>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button"><i class="icon_search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <?php
endif;
?>

</div> <!-- Body Wrapper -->
<?php wp_footer(); ?>
</body>
</html>