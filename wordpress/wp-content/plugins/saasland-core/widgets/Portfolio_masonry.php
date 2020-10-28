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
 * Masonry Portfolio
 */
class Portfolio_masonry extends Widget_Base {
    public function get_name() {
        return 'saasland_portfolio_masonry';
    }

    public function get_title() {
        return __( 'Masonry Portfolio', 'saasland-hero' );
    }

    public function get_icon() {
        return ' eicon-gallery-masonry';
    }

    public function get_script_depends() {
        return ['imagesloaded', 'isotope'];
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    protected function _register_controls() {

        // -------------------------------------------- Filtering
        $this->start_controls_section(
            'portfolio_filter', [
                'label' => __( 'Filter', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'all_label', [
                'label' => esc_html__( 'All filter label', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'See All'
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Show count', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => 8
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


        // -------------------------------------------- Filtering
        $this->start_controls_section(
            'portfolio_layout', [
                'label' => __( 'Layout', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Style', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'hover' => esc_html__( 'Hover Contents', 'saasland-core' ),
                    'normal' => esc_html__( 'Normal Contents', 'saasland-core' ),
                ],
                'default' => 'hover'
            ]
        );

        $this->add_control(
            'column', [
                'label' => __( 'Grid column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two column', 'saasland-core' ),
                    '4' => __( 'Three column', 'saasland-core' ),
                    '3' => __( 'Four column', 'saasland-core' ),
                ],
                'default' => '3'
            ]
        );

        $this->end_controls_section();

        /**
         * Filter Bar Styling
         */
        $this->start_controls_section(
            'portfolio_color', [
                'label' => __( 'Filter Bar', 'saasland-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'filter_color', [
                'label' => __( 'Filter Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio_filter .work_portfolio_item' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'filter_active_color', [
                'label' => __( 'Active Filter Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio_filter .work_portfolio_item.active, .portfolio_filter .work_portfolio_item:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .portfolio_filter .work_portfolio_item.active:before, .portfolio_filter .work_portfolio_item:hover:before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();
        $portfolios = new WP_Query(array(
            'post_type'     => 'portfolio',
            'posts_per_page'=> $settings['show_count'],
            'order' => $settings['order'],
        ));
        $portfolio_cats = get_terms(array(
            'taxonomy' => 'portfolio_cat',
            'hide_empty' => true
        ));

        ?>
        <section class="portfolio_area">
            <div class="container">
                <div id="portfolio_filter" class="portfolio_filter mb_50">
                    <?php if (!empty($settings['all_label'])) : ?>
                        <div data-filter="*" class="work_portfolio_item active">
                            <?php echo esc_html($settings['all_label']); ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    if (is_array($portfolio_cats)) {
                        foreach ($portfolio_cats as $portfolio_cat) { ?>
                            <div data-filter=".<?php echo $portfolio_cat->slug ?>" class="work_portfolio_item">
                                <?php echo $portfolio_cat->name ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="row portfolio_gallery mb_30" id="work-portfolio">
                    <?php
                    while ($portfolios->have_posts()) : $portfolios->the_post();
                        $cats = get_the_terms(get_the_ID(), 'portfolio_cat' );
                        $cat_slug = '';
                        if (is_array($cats)) {
                            foreach ($cats as $cat) {
                                $cat_slug .= $cat->slug.' ';
                            }
                        }
                        $column = !empty($settings['column']) ? $settings['column'] : '6';

                        if (has_post_thumbnail()) {
                            if ($settings['style'] == 'hover' ) {
                                ?>
                                <div class="col-lg-<?php echo esc_attr($column);
                                echo esc_attr( ' ' . $cat_slug); ?> col-sm-6 portfolio_item mb-30">
                                    <div class="portfolio_img" onclick="window.location='<?php the_permalink() ?>';">
                                        <?php the_post_thumbnail( 'full' ) ?>
                                        <div class="hover_content <?php echo ($column == '3' || $column == '4' ) ? 'h_content_two' : ''; ?>">
                                            <a href="<?php the_post_thumbnail_url() ?>" class="img_popup leaf">
                                                <i class="ti-plus"></i>
                                            </a>
                                            <div class="portfolio-description leaf">
                                                <a href="<?php the_permalink() ?>" class="portfolio-title">
                                                    <h3 class="f_500 f_size_20 f_p"> <?php the_title() ?> </h3>
                                                </a>
                                                <div class="links">
                                                    <?php
                                                    if ($cats) {
                                                        $cat_i = 0;
                                                        $cat_count = count($cats);
                                                        foreach ($cats as $cat) {
                                                            $separator = '';
                                                            if (++$cat_i != $cat_count) {
                                                                $separator .= ', ';
                                                            }
                                                            echo "<a href='".get_term_link($cat->term_id)."'> $cat->name $separator </a>";
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } elseif ($settings['style'] == 'normal' ) {
                                ?>
                                <div class="col-lg-<?php echo esc_attr($column);
                                echo esc_attr( ' ' . $cat_slug); ?> col-sm-6 portfolio_item br ux mb_50">
                                    <div class="portfolio_img">
                                        <a href="<?php the_post_thumbnail_url() ?>" class="img_popup">
                                            <img class="img_rounded" src="<?php the_post_thumbnail_url() ?>"
                                                 alt="<?php the_title_attribute() ?>">
                                        </a>
                                        <div class="portfolio-description">
                                            <a href="<?php the_permalink() ?>" class="portfolio-title">
                                                <h3 class="f_500 f_size_20 f_p mt_30"> <?php the_title(); ?> </h3>
                                            </a>
                                            <div class="links">
                                                <?php
                                                if ($cats) {
                                                    $cat_i = 0;
                                                    $cat_count = count($cats);
                                                    foreach ($cats as $cat) {
                                                        $separator = '';
                                                        if (++$cat_i != $cat_count) {
                                                            $separator .= ', ';
                                                        }
                                                        echo "<a href='".get_term_link($cat->term_id)."'> $cat->name $separator </a>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
        <?php
    }

}