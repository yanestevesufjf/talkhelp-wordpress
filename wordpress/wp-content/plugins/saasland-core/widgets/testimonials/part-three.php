<section class="app_testimonial_area">
    <div class="text_shadow" <?php  echo (!empty($settings['bg_title'])) ? 'data-line="'.esc_attr($settings['bg_title']).'"></div>' : ''; ?>
    <div class="container nav_container">
        <div class="shap one"></div>
        <div class="shap two"></div>
        <div class="app_testimonial_slider owl-carousel">
            <?php
            if (!empty($testimonials)) {
                unset($testimonial);
                foreach ($testimonials as $testimonial) {
                    ?>
                    <div class="app_testimonial_item text-center">
                        <div class="author-img">
                            <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'saasland_100x100' ) ?>
                        </div>
                        <div class="author_info">
                            <?php if (!empty($testimonial['name'])) : ?>
                                <h6 class="f_p f_500 f_size_18 t_color3 mb-0"> <?php echo esc_html($testimonial['name']); ?> </h6>
                            <?php endif; ?>
                            <?php echo !empty($testimonial['designation']) ? wpautop($testimonial['designation']) : ''; ?>
                        </div>
                        <p class="f_300"> <?php echo wp_kses_post($testimonial['content']) ?> </p>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>