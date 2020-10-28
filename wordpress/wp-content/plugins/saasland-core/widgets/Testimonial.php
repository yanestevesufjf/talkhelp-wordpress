<?php
namespace SaaslandCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Testimonial
 * @package SaaslandCore\Widgets
 */
class Testimonial extends \Elementor\Widget_Base {

    public function get_name() {
        return 'saasland_testimonial';
    }

    public function get_title() {
        return __( 'Saasland Testimonials', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_style_depends() {
        return [ 'owl-carousel' ];
    }

     public function get_script_depends() {
        return [ 'owl-carousel', 'slick', 'imagesloaded', 'isotope' ];
    }

     protected function render() {
        $settings = $this->get_settings();
        $testimonials = isset($settings['testimonials']) ? $settings['testimonials'] : '';
        $testimonials2 = isset($settings['testimonials2']) ? $settings['testimonials2'] : '';
        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';

         if ( $settings['style'] == 'style_01' ) {
             include 'testimonials/part-one.php';
         }

         if ( $settings['style'] == 'style_02' ) {
             include 'testimonials/part-two.php';
         }

         if ( $settings['style'] == 'style_03' ) {
             include 'testimonials/part-three.php';
         }

         if ( $settings['style'] == 'style_04' ) {
             include 'testimonials/part-four.php';
         }

    }


    protected function _register_controls() {

        // ------------------------------  Title ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => __( 'Title', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01', 'style_02']
                ]
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => "We've heard things like"
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                ],
                'default' => 'h2',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-center.mb_60' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sec_title .f_600.w_color' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .text-center.mb_60,
                    {{WRAPPER}} .sec_title .f_600.w_color
                    ',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Description  ------------------------------
        $this->start_controls_section(
            'desc_sec', [
                'label' => __( 'Description', 'saasland-core' ),
                'condition' => [
                    'style' => [ 'style_01', 'style_02']
                ]
            ]
        );

        $this->add_control(
            'desc', [
                'label' => esc_html__( 'Description Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_desc', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sec_title p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_desc',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .sec_title p',
            ]
        );

        $this->end_controls_section(); // End description section


        // ------------------------------  Contents ------------------------------
        $this->start_controls_section(
            'content_sec', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
			'testimonials', [
				'label' => __( 'Testimonials', 'saasland-core' ),
				'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
				'title_field' => '{{{ name }}}',
                'condition' => [
                    'style' => ['style_01', 'style_03', 'style_04']
                ],
				'fields' => [
					[
						'name' => 'name',
						'label' => __( 'Name', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Mark Tony'
					],
					[
						'name' => 'designation',
						'label' => __( 'Designation', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Software Developer'
					],
					[
						'name' => 'content',
						'label' => __( 'Testimonial Text', 'saasland-core' ),
						'type' => Controls_Manager::TEXTAREA,
					],
					[
						'name' => 'testimonial_image',
						'label' => __( 'Author Image', 'saasland-core' ),
						'type' => Controls_Manager::MEDIA,
					],
				],
			]
		);


        $this->add_control(
			'testimonials2', [
				'label' => __( 'Testimonials', 'saasland-core' ),
				'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
				'title_field' => '{{{ name }}}',
                'condition' => [
                    'style' => ['style_02']
                ],
				'fields' => [
					[
						'name' => 'name',
						'label' => __( 'Name', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Mark Tony'
					],
					[
						'name' => 'designation',
						'label' => __( 'Designation', 'saasland-core' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'default' => 'Driver'
					],
					[
						'name' => 'date',
						'label' => __( 'Date', 'saasland-core' ),
						'type' => Controls_Manager::DATE_TIME,
                        'picker_options' => [
                            'enableTime' => false,
                            'dateFormat' => 'M d, Y'
                        ]
					],
					[
						'name' => 'content',
						'label' => __( 'Testimonial Text', 'saasland-core' ),
						'type' => Controls_Manager::TEXTAREA,
					],
					[
						'name' => 'testimonial_image',
						'label' => __( 'Author Image', 'saasland-core' ),
						'type' => Controls_Manager::MEDIA,
					],
				],
			]
		);

        $this->end_controls_section();

        /**
         * Slider Settings
         */
        $this->start_controls_section(
            'slider_settings', [
                'label' => __( 'Slider Settings', 'saasland-core' ),
                'condition' => [
                    'style' => ['style_01']
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Loop', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => esc_html__( 'True', 'saasland-core' ),
                    'false' => esc_html__( 'False', 'saasland-core' ),
                ],
                'default' => 'true'
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true' => esc_html__( 'True', 'saasland-core' ),
                    'false' => esc_html__( 'False', 'saasland-core' ),
                ],
                'default' => 'true'
            ]
        );

        $this->add_control(
            'slide_speed',
            [
                'label' => __( 'Slide Speed', 'saasland-core' ),
                'description' => __( 'Set the slide speed in millisecond', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2500
            ]
        );

        $this->add_control(
            'transition_anim',
            [
                'label' => __( 'Transition Effect', 'saasland-core' ),
                'type' => Controls_Manager::ANIMATION,
                'default' => 'fadeOut'
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Title Content ------------------------------
        $this->start_controls_section(
            'style_counter_sec', [
                'label' => __( 'Style Title Content', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_title_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .media-body h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_item .author_info h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .author_description h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_counter_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .media-body h5,
                    {{WRAPPER}} .app_testimonial_item .author_info h6,
                    {{WRAPPER}} .agency_testimonial_info .author_description h4
                    ',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style Designation ------------------------------
        $this->start_controls_section(
            'style_designation_sec', [
                'label' => __( 'Style Designation', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'designation_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .media-body h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_item .author_info p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .author_description h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_designation',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .media-body h6,
                    {{WRAPPER}} .app_testimonial_item .author_info p,
                    {{WRAPPER}} .agency_testimonial_info .author_description h6
                ',
            ]
        );

        $this->end_controls_section();


        //------------------------------ Style subtitle ------------------------------
        $this->start_controls_section(
            'style_content_sec', [
                'label' => __( 'Style Content', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feedback_item p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_item .f_300' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .testimonial_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_contents',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .feedback_item p,
                    {{WRAPPER}} .app_testimonial_item .f_300,
                    {{WRAPPER}} .agency_testimonial_info .testimonial_item p
                ',
            ]
        );

        $this->end_controls_section();


        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_bg_title', [
                'label' => __( 'Style Background Title', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['style_03']
                ]
            ]
        );

        $this->add_control(
            'bg_title', [
                'label' => esc_html__( 'Background Title text', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => "Feedback"
            ]
        );

        $this->add_control(
            'color_bg_title', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_testimonial_area .text_shadow:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_bg_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .app_testimonial_area .text_shadow:before',
            ]
        );

        $this->end_controls_section();


        // ------------------------------------- Style Item padding ---------------------------//
        $this->start_controls_section(
            'style_item_padding_sec', [
                'label' => __( 'Item Padding', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => 'style_04'
                ],
            ]
        );

        $this->add_responsive_control(
            'style_item_padding', [
                'label' => __( 'Padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .support_testimonial_info .testimonial_slider .testimonial_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        // ------------------------------------- Style Section ---------------------------//
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
                    'style_02' => esc_html__( 'Style Two (Dark Background)', 'saasland-core' ),
                    'style_03' => esc_html__( 'Style Three', 'saasland-core' ),
                    'style_04' => esc_html__( 'Style Four', 'saasland-core' ),
                ],
                'default' => 'style_01'
            ]
        );

        $this->add_control(
            'bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .feedback_area' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .app_testimonial_area' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_center_box_color', [
                'label' => __( 'Testimonial Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_info .testimonial_slider' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_control(
            'accent_color', [
                'label' => __( 'Accent Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_info .owl-prev:hover, .agency_testimonial_info .owl-next:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .agency_testimonial_info .testimonial_slider .owl-dots .owl-dot.active' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'style' => 'style_01'
                ]
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .agency_testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .feedback_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .app_testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .agency_testimonial_info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->end_controls_section();
    }
}