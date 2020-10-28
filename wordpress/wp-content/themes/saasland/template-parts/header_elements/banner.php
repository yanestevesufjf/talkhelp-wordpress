<?php
$opt = get_option('saasland_opt');
$titlebar_align = !empty($opt['titlebar_align']) ? $opt['titlebar_align'] : 'center';
$background_type = function_exists('get_field') ? get_field('banner_background_type') : '';
$background_image = '';
if ( $background_type == 'image' ) {
    $background_image = function_exists('get_field') ? get_field('banner_background_image') : '';
    $background_image = !empty($background_image) ? "style='background: url($background_image); background-size: cover; background-position: center center; background-repeat: no-repeat;'" : '';
    $banner_shape_image = '';
} elseif ( $background_type == 'color' ) {
    $banner_shape_image = function_exists('get_field') ? get_field('banner_shape_image') : '';
    $background_image = '';
}
?>
<section class="breadcrumb_area <?php echo esc_attr($titlebar_align) ?>" <?php echo wp_kses_post($background_image); ?>>
    <?php
    if ( !empty($banner_shape_image) ) {
        echo wp_get_attachment_image( $banner_shape_image, 'full', false, array('class'=>'breadcrumb_shap') );
    }
    else {
        $default_shape_image = !empty($opt['banner_shape_image']['url']) ? $opt['banner_shape_image']['url'] : SAASLAND_DIR_IMG.'/banners/banner_bg.png';
        echo "<img src='".esc_url($default_shape_image)."' class='breadcrumb_shap' alt='".get_the_title()."'>";
    }
    ?>
    <div class="container">
        <div class="breadcrumb_content text-center">
            <h1 class="f_p f_700 f_size_50 w_color l_height50 mb_20">
                <?php saasland_banner_title(); ?>
            </h1>
            <p class="f_300 w_color f_size_16 l_height26"> <?php saasland_banner_subtitle() ?> </p>
        </div>
    </div>
</section>