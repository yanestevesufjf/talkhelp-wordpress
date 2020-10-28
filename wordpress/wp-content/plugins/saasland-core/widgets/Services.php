<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Services
 */
class Services extends Widget_Base {
    public function get_name() {
        return 'saasland_services';
    }

    public function get_title() {
        return __( 'Services', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'filter', [
                'label' => __( 'Filter', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'show', [
                'label' => esc_html__( 'Show post count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 4
            ]
        );

        $this->add_control(
            'excerpt', [
                'label' => esc_html__( 'Excerpt Character Limit', 'saasland-core' ),
                'description' => esc_html__( 'Leave the field empty to show the full excerpt. And if excerpt not found in a post, then the excerpt will take from the post content.', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'cat', [
                'label' => esc_html__( 'Category', 'saasland-core' ),
                'description' => esc_html__( 'Enter the category slugs separated by commas (Eg. cat1, cat2)', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();


        // ------------------- Read More Button ----------------------
        $this->start_controls_section(
            'btn_sec', [
                'label' => __( 'Read More Link', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_03', 'style_04']
                ]
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Link Button Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Read More'
            ]
        );

        $this->end_controls_section();


        // Section Style
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_01' => esc_html__( 'Style One', 'saasland-core' ),
                    'style_02' => esc_html__( 'Style Two (Carousel)', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style Three', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style Four', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .app_service_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );


        $this->add_control(
            'sec_bg_color', [
                'label' => __( 'Section Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array( '.app_service_area' => 'background-color: {{VALUE}};' )
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        if (!empty($settings['cat'])) {
            $services = new \WP_Query(array(
                'post_type' => 'service',
                'posts_per_page' => !empty($settings['show']) ? $settings['show'] : 4,
                'order' => $settings['order'],
                'tax_query' => array(
                    array(
                        'taxonomy' => 'service_cat',
                        'field'    => 'slug',
                        'terms'    => explode( ',', str_replace( ' ', '', $settings['cat'])),
                    ),
                ),
            ));
        } else {
            $services = new \WP_Query(array(
                'post_type' => 'service',
                'posts_per_page' => !empty($settings['show']) ? $settings['show'] : 4,
                'order' => $settings['order'],
            ));
        }

        if ( $settings['style'] == 'style_01' ) :
            ?>
            <div class="container custom_container p0">
                <div class="row service_info mt_70 mb_30">
                    <?php
                    while ( $services->have_posts() ) {
                        $services->the_post();
                        $icon = function_exists('get_field') ? get_field('icon') : '';
                        $background_color = get_post_meta(get_the_ID(), 'color_left', true);
                        $background_color2 = get_post_meta(get_the_ID(), 'color_right', true);
                        $bg_color = !empty($background_color) & !empty($background_color) ? "background-image: -webkit-linear-gradient(40deg, $background_color 0%, $background_color2 100%);" : '';
                        $shadow = get_post_meta(get_the_ID(), 'icon_shadow', true);
                        $shadow = get_post_meta(get_the_ID(), 'icon_shadow', true) ? "box-shadow: 0px 14px 30px 0px $shadow;" : '';
                        ?>
                        <div class="col-lg-3 col-sm-6 mb-30">
                            <div class="service_item">
                                <div class="icon s_icon_one" style="<?php echo $bg_color.$shadow; ?>">
                                    <?php if (!empty($icon)) : ?>
                                        <i class="<?php echo $icon ?>"></i>
                                    <?php endif; ?>
                                </div>
                                <h4 class="f_600 f_size_20 l_height28 t_color2 mb_20"> <?php the_title() ?> </h4>
                                <?php the_excerpt() ?>
                                <?php the_post_thumbnail( 'full', array('class' => 'float-right')) ?>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        <?php

        elseif ( $settings['style'] == 'style_02' ) :
            wp_enqueue_style( 'owl-carousel' );
            wp_enqueue_script( 'owl-carousel' );
            ?>
            <div class="container custom_container">
                <div class="service_carousel owl-carousel">
                    <?php
                    while($services->have_posts()) {
                        $services->the_post();
                        $icon = function_exists('get_field') ? get_field('icon') : '';;
                        $background_color = get_post_meta(get_the_ID(), 'color_left', true);
                        $background_color2 = get_post_meta(get_the_ID(), 'color_right', true);
                        $bg_color = !empty($background_color) & !empty($background_color) ? "background-image: -webkit-linear-gradient(40deg, $background_color 0%, $background_color2 100%);" : '';
                        $shadow = get_post_meta(get_the_ID(), 'icon_shadow', true);
                        $shadow = get_post_meta(get_the_ID(), 'icon_shadow', true) ? "box-shadow: 0px 14px 30px 0px $shadow;" : '';
                        if ( !empty($settings['excerpt']) ) {
                            $excerpt = get_the_excerpt() ? saaslandCore_limit_latter(get_the_excerpt(), $settings['excerpt'], '') : saaslandCore_limit_latter(get_the_content(), $settings['excerpt'], '');
                        }
                        else {
                            $excerpt = get_the_excerpt() ? get_the_excerpt() : saaslandCore_limit_latter(get_the_content(), 120, '');
                        }
                        ?>
                        <div class="service_item">
                            <div class="icon s_icon_one" style="<?php echo $bg_color.$shadow; ?>">
                                <?php if ( !empty($icon) ) : ?>
                                    <i class="<?php echo $icon ?>"></i>
                                <?php endif; ?>
                            </div>
                            <a href="<?php the_permalink(); ?>">
                                <h4 class="f_600 f_size_20 l_height28 t_color2 mb_20">
                                    <?php the_title() ?>
                                </h4>
                            </a>
                            <?php echo wp_kses_post(wpautop($excerpt)); ?>
                            <?php the_post_thumbnail( 'full', array( 'class' => 'float-right' ) ) ?>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php

        elseif ( $settings['style'] == 'style_03' ) :
            ?>
            <section class="app_service_area">
                <div class="container">
                    <div class="row app_service_info">
                        <?php
                        $i = 1;
                        while($services->have_posts()) {
                            $services->the_post();
                            $color1 = get_field( 'color_left' ) ? get_field( 'color_left' ) : '#2171d4';
                            $color2 = get_field( 'color_right' ) ? get_field( 'color_right' ) : '#2cc4f0';
                            $shadow = get_field( 'shadow_color' ) ? "text-shadow: 0px 14px 30px ".get_field( 'shadow_color' ).";" : "text-shadow: 0px 14px 30px rgba(44, 130, 237, 0.4);";
                            if (!empty($settings['excerpt'])) {
                                $excerpt = get_the_excerpt() ? saaslandCore_limit_latter(get_the_excerpt(), $settings['excerpt'], '') : saaslandCore_limit_latter(get_the_content(), $settings['excerpt'], '');
                            }
                            else {
                                $excerpt = get_the_excerpt() ? get_the_excerpt() : saaslandCore_limit_latter(get_the_content(), 120, '');
                            }
                            ?>
                            <style>
                                .<?php echo 'service_item'.$i; ?> .app_icon:before {
                                    <?php echo "background-image: -webkit-linear-gradient(0deg, $color1 0%, $color2 100%);"; ?>
                                    -webkit-background-clip: text;
                                    -webkit-text-fill-color: transparent;
                                    <?php echo $shadow ?>
                                }
                            </style>
                            <div class="col-lg-4">
                                <div class="app_service_item wow fadeInUp <?php echo 'service_item'.$i; ?>" data-wow-delay="0.2s">
                                    <i class="<?php echo esc_attr(the_field( 'icon')) ?> app_icon one"></i>
                                    <h5 class="f_p f_size_18 f_600 t_color3 mt_40 mb-30"> <?php the_title() ?> </h5>
                                    <p class="f_size_15 mb-30"> <?php echo $excerpt;  ?> </p>
                                    <a href="<?php the_permalink() ?>" class="learn_btn_two">
                                        <?php echo esc_html($settings['btn_label']) ?>
                                        <i class="ti-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                            <?php
                            ++$i;
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
            <?php

        elseif ( $settings['style'] == 'style_04' ) :
            ?>
            <section class="saas_service_area">
                <div class="container">
                    <?php
                    $i = 0;
                    while($services->have_posts()) {
                        $services->the_post();
                        $shadow = get_field( 'shadow_color' ) ? "box-shadow: 0px 10px 20px 0px" . get_field( 'shadow_color' ) . ";" : "box-shadow: 0px 10px 20px 0px rgba(44, 130, 237, 0.4);";
                        if (!empty($settings['excerpt'])) {
                            $excerpt = get_the_excerpt() ? saaslandCore_limit_latter(get_the_excerpt(), $settings['excerpt'], '') : saaslandCore_limit_latter(get_the_content(), $settings['excerpt'], '');
                        }
                        else {
                            $excerpt = get_the_excerpt() ? get_the_excerpt() : saaslandCore_limit_latter(get_the_content(), 120, '');
                        }
                        ?>
                        <div class="row saas_service_item <?php echo ($i % 2 == 0) ? '' : 'flex-row-reverse'; ?>">
                            <?php
                            if (get_field( 'color_left' ) & get_field( 'color_right')) {
                                ?>
                                <style>
                                    .saas_service_item .saas_service_content .icon.icon<?php echo $i ?> {
                                        background-image: -webkit-linear-gradient(40deg, <?php echo get_field( 'color_left' ); ?> 0%, <?php echo get_field( 'color_right' ); ?> 100%);
                                    <?php echo $shadow; ?>
                                    }
                                </style>
                                <?php
                            }
                            ?>
                            <div class="col-lg-6">
                                <div class="saas_service_img wow fadeInLeft" data-wow-delay="0.5s">
                                    <?php the_post_thumbnail( 'full' ) ?>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center">
                                <div class="saas_service_content pr_100 wow fadeInRight" data-wow-delay="0.7s">
                                    <div class="icon icon_one <?php echo 'icon'.$i; ?>"><i class="<?php echo esc_attr(the_field( 'icon')) ?>"></i></div>
                                    <h4 class="f_500 f_p t_color"> <?php the_title() ?> </h4>
                                    <?php if ($excerpt) : ?>
                                        <p class="f_p f_300"> <?php echo $excerpt ?> </p>
                                    <?php endif ?>
                                    <?php if (!empty($settings['btn_label'])) : ?>
                                        <a href="<?php the_permalink() ?>" class="gr_btn">
                                            <span class="text"> <?php echo esc_html($settings['btn_label']) ?> </span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        ++$i;
                    };
                    wp_reset_postdata();
                    ?>
                </div>
            </section>
            <?php
        endif;
    }
}