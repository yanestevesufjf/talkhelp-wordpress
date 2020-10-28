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
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Bubble_features extends Widget_Base {

    public function get_name() {
        return 'saasland_bubble_features';
    }

    public function get_title() {
        return esc_html__( 'Bubble Features', 'saasland-core' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'title_sec', [
                'label' => esc_html__( 'Title', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Awesome Features'
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
                    '{{WRAPPER}} .pr_70.mb-30' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => ' 
                    {{WRAPPER}} .pr_70.mb-30',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------  Title  ------------------------------
        $this->start_controls_section(
            'subtitle_sec', [
                'label' => esc_html__( 'Subtitle', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'subtitle', [
                'label' => esc_html__( 'Subtitle Text', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_featured_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_subtitle',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .app_featured_content p',
            ]
        );

        $this->end_controls_section(); // End title section


        // ------------------------------ Button ------------------------------
        $this->start_controls_section(
            'button', [
                'label' => esc_html__( 'Button', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'btn_title', [
                'label' => esc_html__( 'Button label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'See All Features',
            ]
        );

        $this->add_control(
            'btn_url', [
                'label' => esc_html__( 'Button URL', 'saasland-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        $this->add_control(
            'btn_text_color', [
                'label' => esc_html__( 'Text color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_featured_content .learn_btn_two' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_text_color_hover', [
                'label' => esc_html__( 'Text Hover Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .app_featured_content .learn_btn_two:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section(); // End the Button


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'contents', [
                'label' => __( 'Contents', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'features', [
                'label' => __( 'Features', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => __( 'Feature title', 'saasland-core' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Default Title'
                    ],
                    [
                        'name' => 'icon_type',
                        'label' => __( 'Icon Type', 'saasland-core' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'ti',
                        'options' => [
                            'ti' => __( 'Themify Icon', 'saasland-core' ),
                            'image_icon' => __( 'Image icon', 'saasland-core' ),
                        ],
                    ],
                    [
                        'name' => 'ti',
                        'label' => __( 'Themify Icon', 'saasland-core' ),
                        'type' => Controls_Manager::ICON,
                        'options' => saasland_themify_icons(),
                        'include' => saasland_include_themify_icons(),
                        'default' => 'ti-panel',
                        'condition' => [
                            'icon_type' => 'ti'
                        ]
                    ],
                    [
                        'name' => 'bg_color_left',
                        'label' => __( 'Background Color Left', 'saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                    ],
                    [
                        'name' => 'bg_color_right',
                        'label' => __( 'Background Color Right','saasland-core' ),
                        'type' => Controls_Manager::COLOR,
                    ],
                    [
                        'name' => 'image_icon',
                        'label' => __( 'Image Icon', 'saasland-core' ),
                        'type' => Controls_Manager::MEDIA,
                        'condition' => [
                            'icon_type' => 'image_icon'
                        ]
                    ],
                ],
            ]
        );

        $this->end_controls_section();


        //---------------------------- Style subtitle -----------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style section', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'saasland-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .app_featured_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',

                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        $title_tag = !empty($settings['title_html_tag']) ? $settings['title_html_tag'] : 'h2';
        $features = isset($settings['features']) ? $settings['features'] : '';

        ?>
        <section class="app_featured_area">
        <div class="container">
        <div class="row flex-row-reverse app_feature_info">
            <div class="col-lg-6">
                <div class="app_fetured_item">
                    <?php
                    if ($features) {
                    foreach ($features as $i => $feature) {
                        switch ($i) {
                            case 0:
                                $parallax = '{"x": 0, "y": 50}';
                                $index = 'item_one';
                                break;
                            case 1:
                                $parallax = '{"x": 0, "y": -30}';
                                $index = 'item_two';
                                break;
                            case 2:
                                $parallax = '{"x": 50, "y": 10}';
                                $index = 'item_three';
                                break;
                            case 3:
                                $parallax = '{"x": -20, "y": 50}';
                                $index = 'item_four';
                                break;
                        }
                        $bg_color = !empty($feature['bg_color_left']) ? "style='background-image: -webkit-linear-gradient(40deg, {$feature['bg_color_left']} 0%, {$feature['bg_color_right']} 100%)'" : '';
                        ?>
                        <div <?php echo $bg_color; ?> class="app_item <?php echo $index; ?> elementor-repeater-item-<?php echo $feature['_id'] ?>" data-parallax='<?php echo esc_attr($parallax) ?>'>
                            <?php
                            if ($feature['icon_type'] == 'ti' ) { ?>
                                <i class="<?php echo esc_attr($feature['ti']) ?> f_size_40 w_color"></i>
                                <?php
                            } elseif ($feature['icon_type'] == 'image_icon' ) {
                                echo "<img src='{$feature['image_icon']['url']}' alt='{$feature['title']}'>";
                            }
                            ?>
                            <?php if (!empty($feature['title'])) : ?>
                                <h6 class="f_p f_400 f_size_16 w_color l_height45"> <?php echo esc_html($feature['title']) ?> </h6>
                            <?php endif; ?>
                        </div>
                        <?php
                    }}
                    ?>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="app_featured_content">
                    <?php if (!empty($settings['title'])) : ?>
                        <<?php echo $title_tag; ?> class="f_p f_size_30 f_700 t_color3 l_height45 pr_70 mb-30">
                            <?php echo wp_kses_post(nl2br($settings['title'])) ?>
                        </<?php echo $title_tag; ?>>
                    <?php endif; ?>
                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="f_300">
                            <?php echo wp_kses_post(nl2br($settings['subtitle'])) ?>
                        </p>
                    <?php endif; ?>
                    <a href="<?php echo esc_url($settings['btn_url']['url']) ?>" class="learn_btn_two" <?php saasland_is_external($settings['btn_url']) ?>>
                        <?php echo esc_html($settings['btn_title']) ?> <i class="ti-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        </div>
        </section>
        <?php
    }
}