<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Posts Carousel
 */
class Posts_carousel extends Widget_Base {
    public function get_name() {
        return 'saasland_posts_carousel';
    }

    public function get_title() {
        return __( 'Posts Carousel', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-posts-carousel';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'owl-carousel' ];
    }

    public function get_script_depends() {
        return [ 'owl-carousel' ];
    }

    protected function _register_controls() {

        // ---------------------------------- Filter Options ------------------------
        $this->start_controls_section(
            'filter', [
                'label' => __( 'Filter', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'post_type', [
                'label' => esc_html__( 'Post Type', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'post' => 'Post',
                    'service' => 'Service',
                    'job' => 'Job',
                    'portfolio' => 'Portfolio'
                ],
                'default' => 'post'
            ]
        );

        $this->add_control(
            'category_name', [
                'label' => esc_html__( 'Category Name', 'saasland-core' ),
                'description' => esc_html__( 'Enter the category name slug. Use comma to separate multiple category slugs.', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show Posts Count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 4
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

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        if ( !empty($settings['category_name']) ) {
            $posts = new WP_Query(array(
                'post_type' => $settings['post_type'],
                'posts_per_page'=> $settings['show_count'],
                'order' => $settings['order'],
                'category_name' => $settings['category_name']
            ));
        }
        else {
            $posts = new WP_Query(array(
                'post_type' => $settings['post_type'],
                'posts_per_page' => $settings['show_count'],
                'order' => $settings['order'],
            ));
        }
        ?>

        <div class="case_studies_slider owl-carousel">
            <?php
            while($posts->have_posts()) : $posts->the_post();
                ?>
                <div class="studies_item">
                    <?php the_post_thumbnail( 'saasland_370x360' ) ?>
                    <div class="text">
                        <a href="<?php the_permalink() ?>">
                            <h4 title="<?php the_title() ?>"> <?php echo saaslandCore_limit_latter(get_the_title(), 25) ?> </h4>
                        </a>
                        <p> <?php the_category( ', ' ) ?> </p>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                    var CSlider = $(".case_studies_slider");
                    if ( CSlider.length ){
                        CSlider.owlCarousel({
                            loop:true,
                            margin:0,
                            items: 3,
                            autoplay: true,
                            <?php echo ( is_rtl() ) ? "rtl: true," : ''; ?>
                            smartSpeed: 1000,
                            responsiveClass:true,
                            nav: false,
                            dots: true,
                            responsive:{
                                0:{
                                    items: 1
                                },
                                650:{
                                    items:2,
                                },
                                776:{
                                    items:3,
                                },
                                1199:{
                                    items:3,
                                },
                            },
                        })
                    }
                });
            })(jQuery)
        </script>
        <?php
    }
}