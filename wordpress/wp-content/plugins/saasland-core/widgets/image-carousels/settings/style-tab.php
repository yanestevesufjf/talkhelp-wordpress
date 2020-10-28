<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

$this->start_controls_section(
    'style_title', [
        'label' => __( 'Style section title', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
);

$this->add_control(
    'color_title', [
        'label' => __( 'Text Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .t_color3.mb_20' => 'color: {{VALUE}};',
            '{{WRAPPER}} .section_title h2' => 'color: {{VALUE}};',
            '{{WRAPPER}} .u_content h2' => 'color: {{VALUE}};',
            '{{WRAPPER}} .portfolio_area_two h2' => 'color: {{VALUE}};'
        ],
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(), [
        'name' => 'typography_title',
        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '
            {{WRAPPER}} .t_color3.mb_20,
            {{WRAPPER}} .section_title h2,
            {{WRAPPER}} .u_content h2,
            {{WRAPPER}} .portfolio_area_two h2',
    ]
);

$this->end_controls_section();


//------------------------------ Style subtitle ------------------------------
$this->start_controls_section(
    'style_subtitle', [
        'label' => __( 'Style subtitle', 'saasland-core' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
            'style' => ['style_01', 'style_02', 'style_03', 'style_06' ]
        ]
    ]
);

$this->add_control(
    'color_subtitle', [
        'label' => __( 'Text Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .sec_title p' => 'color: {{VALUE}};',
            '{{WRAPPER}} .section_title p' => 'color: {{VALUE}};',
            '{{WRAPPER}} .u_content p' => 'color: {{VALUE}};',
        ],
    ]
);

$this->add_group_control(
    Group_Control_Typography::get_type(), [
        'name' => 'typography_subtitle',
        'scheme' => Scheme_Typography::TYPOGRAPHY_1,
        'selector' => '
            {{WRAPPER}} .sec_title p,
            {{WRAPPER}} .section_title p,
            {{WRAPPER}} .u_content p',
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
    'bg_color', [
        'label' => __( 'Background Color', 'saasland-core' ),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .app_screenshot_area' => 'background-color: {{VALUE}};',
            '{{WRAPPER}} .slider_demos_area' => 'background: {{VALUE}};',
            '{{WRAPPER}} .blog_area' => 'background: {{VALUE}};',
            '{{WRAPPER}} .portfolio_area' => 'background: {{VALUE}};',
            '{{WRAPPER}} .portfolio_area_two' => 'background: {{VALUE}};',
            '{{WRAPPER}} .portfolio_area_three' => 'background: {{VALUE}};',
        ],
    ]
);

$this->add_responsive_control(
    'sec_padding', [
        'label' => __( 'Section padding', 'saasland-core' ),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px', '%', 'em' ],
        'selectors' => [
            '{{WRAPPER}} .app_screenshot_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .slider_demos_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .blog_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .portfolio_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .portfolio_area_two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .portfolio_area_three' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        'default' => [
            'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

        ],
    ]
);

$this->end_controls_section();