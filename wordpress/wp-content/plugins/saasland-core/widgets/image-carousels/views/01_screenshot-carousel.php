<?php
wp_enqueue_style( 'owl-carousel' );
wp_enqueue_script( 'owl-carousel' );
?>

<section class="app_screenshot_area sec_pad">
    <div class="container custom_container p0">
        <div class="sec_title text-center mb_70">
            <?php if (!empty($settings['title_text'])) : ?>
                <<?php echo $title_tag; ?> class="f_p f_size_30 l_height30 f_700 t_color3 mb_20 wow fadeInUp" data-wow-delay="0.2s">
                    <?php echo $settings['title_text']; ?>
                </<?php echo $title_tag; ?>>
            <?php endif; ?>
            <?php if (!empty($settings['subtitle_text'])) : ?>
                <?php echo '<p class="f_300 f_size_16 wow fadeInUp" data-wow-delay="0.4s">'.nl2br(wp_kses_post($settings['subtitle_text'])).'</p>';
            endif;
            ?>
        </div>
        <div class="app_screen_info">
            <div class="app_screenshot_slider owl-carousel">
                <?php
                foreach ($images as $image) {
                    echo '<div class="item">
                            <div class="screenshot_img">
                                <a href="'.$image['url'].'" class="image-link">
                                    '.wp_get_attachment_image($image['id'], 'full' ).'
                                </a>
                             </div>
                          </div>';
                }

                ?>
            </div>
        </div>
    </div>
</section>