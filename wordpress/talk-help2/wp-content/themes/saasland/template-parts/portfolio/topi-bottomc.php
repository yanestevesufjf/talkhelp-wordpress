<?php
$opt = get_option( 'saasland_opt' );
?>
<div class="row p_details_three">
    <div class="col-lg-12 mb_50">
        <?php
        while (have_posts()) : the_post();
            $images = get_field( 'portfolio_images' );

            if (empty($images)) {
                the_post_thumbnail( 'full', array( 'class' => 'img-fluid'));
            }

            if ($images) {
                wp_enqueue_script( 'owl-carousel' );
                wp_enqueue_style( 'saasland-owl.carousel' );
                echo '<div class="pr_slider owl-carousel">';
                the_post_thumbnail( 'full' );
                foreach ($images as $image) {
                    echo wp_get_attachment_image($image['ID'], 'full' );
                }
                echo '</div>';
            }
            ?>
        <?php endwhile; ?>
    </div>
    <div class="col-lg-6 portfolio_details_gallery_two pr_100">
        <?php
        while (have_posts()) : the_post();
            the_content();
        endwhile;
        ?>

    </div>
    <div class="col-lg-6">
        <div class="portfolio_category d-flex justify-content-between">
            <?php
            if (have_rows( 'portfolio_attributes')):

                // loop through the rows of data
                while (have_rows( 'portfolio_attributes')) : the_row();
                    ?>
                    <div class="p_category_item mb-30">
                        <h6 class="f_p f_size_15 f_400 t_color3 mb-0 l_height28">
                            <?php echo get_sub_field('attribute_title'); ?>
                        </h6>
                        <p class="f_size_15 f_300 mb-0"> <?php echo get_sub_field('attribute_value'); ?> </p>
                    </div>
                <?php
                endwhile;
            endif;
            ?>
        </div>
    </div>
</div>
