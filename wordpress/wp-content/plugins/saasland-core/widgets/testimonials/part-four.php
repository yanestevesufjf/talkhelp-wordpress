<div class="container">
    <div class="agency_testimonial_info support_testimonial_info">
        <div class="testimonial_slider owl-carousel">
            <?php
            if (!empty($testimonials)) {
                foreach ($testimonials as $index => $testimonial) {
                    switch ($index) {
                        case 0:
                            $align_class = 'left';
                            break;
                        case 1:
                            $align_class = 'center';
                            break;
                        case 2:
                            $align_class = 'right';
                            break;
                        default:
                            $align_class = 'left';
                    }
                    ?>
                    <div class="testimonial_item text-center <?php echo esc_attr($align_class) ?>">
                        <div class="author_img">
                            <?php echo wp_get_attachment_image($testimonial['testimonial_image']['id'], 'saasland_100x100' ) ?>
                        </div>
                        <div class="author_description">
                            <?php if (!empty($testimonial['name'])) : ?>
                                <h4 class="f_500 t_color3 f_size_18"><?php echo esc_html($testimonial['name']); ?></h4>
                            <?php endif; ?>
                            <?php if (!empty($testimonial['designation'])) : ?>
                                <h6><?php echo esc_html($testimonial['designation']); ?></h6>
                            <?php endif; ?>
                        </div>
                        <?php echo !empty($testimonial['content']) ? wpautop($testimonial['content']) : ''; ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>