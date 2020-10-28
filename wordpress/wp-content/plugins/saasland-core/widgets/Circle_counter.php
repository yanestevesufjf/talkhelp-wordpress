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
 * Circle Counter
 */
class Circle_counter extends Widget_Base {

    public function get_name() {
        return 'saasland_circle_counter';
    }

    public function get_title() {
        return __( 'Circle Counter', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-counter-circle';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'waypoints', 'appear', 'counterup', 'circle-progress' ];
    }

    protected function _register_controls() {


        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'counters_sec', [
                'label' => __( 'Counter', 'saasland-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => __( 'Title', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Innovations'
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label' => __( 'Subtitle', 'saasland-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'count_to',
            [
                'label' => __( 'Count to %', 'saasland-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 72,
                ],
            ]
        );

        $repeater->add_control(
            'color',
            [
                'label' => __( 'Color', 'saasland-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#aa6ffa'
            ]
        );

        $this->add_control(
            'counters', [
                'label' => __( 'Counters', 'saasland-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'title_field' => '{{{ title }}}',
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Happy Clients',
                        'subtitle' => 'Charles Jeffrey up the kyver loo in my flat blimey.!',
                        'count_to' => [ 'unit' => '%', 'size' => 92 ],
                        'color' => '#00c99c'
                    ],
                ]
            ]
        );

        $this->end_controls_section(); // Facts

    }

    protected function render() {
        $settings = $this->get_settings();
        $counters = isset($settings['counters']) ? $settings['counters'] : '';
        ?>
        <section class="progress_bar_area">
            <div class="container">
                <div class="row">
                <?php
                $i = 0;
                $count_items = count($counters);
                if (is_array($counters)) {
                    foreach ($counters as $counter) {
                        ?>
                        <div class="col-lg-3 col-md-4 progress_item <?php echo "elementor-repeater-item-{$counter['_id']}"; ?>">
                            <div class="circle" data-value="0.<?php echo esc_attr($counter['count_to']['size']) ?>" data-fill="{&quot;color&quot;: &quot;<?php echo $counter['color'] ?>&quot;}" data-trackcolor="">
                                <div class="number"><span class="counter"> <?php echo esc_html($counter['count_to']['size']) ?> </span>%</div>
                            </div>
                            <?php if (!empty($counter['title'])) : ?>
                                <h4> <?php echo wp_kses_post(nl2br($counter['title'])) ?> </h4>
                            <?php endif; ?>
                            <?php if (!empty($counter['subtitle'])) : ?>
                                <?php echo wp_kses_post(wpautop($counter['subtitle'])) ?>
                            <?php endif; ?>
                        </div>
                <?php ++$i; }} ?>
                </div>
            </div>
        </section>

        <script>
            ;(function($){
                "use strict";
                $(document).ready(function () {
                    $(".circle").each(function() {
                        $(".circle").appear(function() {
                            $( '.circle' ).circleProgress({
                                startAngle:-14.1,
                                size: 200,
                                duration: 9000,
                                easing: "circleProgressEase",
                                emptyFill: '#f1f1fa ',
                                lineCap: 'round',
                                thickness:10,
                            })
                        }, {
                            triggerOnce: true,
                            offset: 'bottom-in-view'
                        })
                    })
                });
            })(jQuery)
        </script>
        <?php
    }

}