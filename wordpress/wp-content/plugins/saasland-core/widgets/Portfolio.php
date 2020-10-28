<?php
namespace SaaslandCore\Widgets;

use Elementor\Group_Control_Image_Size;
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
 * Filterable Portfolio
 */
class Portfolio extends Widget_Base {
    public function get_name() {
        return 'saasland_portfolio';
    }

    public function get_title() {
        return __( 'Filterable Portfolio', 'saasland-hero' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'saasland-elements' ];
    }

    public function get_script_depends() {
        return [ 'imagesloaded', 'isotope' ];
    }

    protected function _register_controls() {

        // -------------------------------------------- Filtering
        $this->start_controls_section(
            'portfolio_filter', [
                'label' => __( 'Filter Bar', 'saasland-core' ),
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
            'is_show_count', [
                'label' => esc_html__( 'Show Count', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section();

        /**
         * Query Options
         */
        $this->start_controls_section(
            'portfolio_query', [
                'label' => __( 'Query', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'show_count', [
                'label' => esc_html__( 'Posts Per Page', 'saasland-core' ),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => '8'
            ]
        );

        $this->add_control(
            'order', [
                'label' => esc_html__( 'Order', 'saasland-core' ),
                'description' => esc_html__( '‘ASC‘ – ascending order from lowest to highest values (1, 2, 3; a, b, c). ‘DESC‘ – descending order from highest to lowest values (3, 2, 1; c, b, a).', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'ASC',
                    'DESC' => 'DESC'
                ],
                'default' => 'ASC'
            ]
        );

        $this->add_control(
            'orderby', [
                'label' => esc_html__( 'Order By', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'ID' => 'ID',
                    'author' => 'Author',
                    'title' => 'Title',
                    'name' => 'Name (by post slug)',
                    'date' => 'Date',
                    'rand' => 'Random',
                    'comment_count' => 'Comment Count',
                ],
                'default' => 'none'
            ]
        );

        $this->add_control(
            'exclude', [
                'label' => esc_html__( 'Exclude Portfolio', 'saasland-core' ),
                'description' => esc_html__( 'Enter the portfolio post ID to hide. Input the multiple ID with comma separated', 'saasland-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        /**
         * Layout
         */
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
                'label' => __( 'Grid Column', 'saasland-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => __( 'Two Column', 'saasland-core' ),
                    '4' => __( 'Three Column', 'saasland-core' ),
                    '3' => __( 'Four Column', 'saasland-core' ),
                ],
                'default' => '3'
            ]
        );

        $this->add_control(
            'is_full_width', [
                'label' => __( 'Full Width', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Yes', 'saasland-core' ),
                'label_off' => __( 'No', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'is_cat', [
                'label' => __( 'Categories', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'is_plus_icon', [
                'label' => __( 'Lightbox Plus Icon', 'saasland-core' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'saasland-core' ),
                'label_off' => __( 'Hide', 'saasland-core' ),
                'return_value' => 'yes',
                'condition' => [
                    'style' => 'hover'
                ]
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
            'filter_count_color', [
                'label' => __( 'Filter Count Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .work_portfolio_item span' => 'color: {{VALUE}}',
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

        $portfolios = new WP_Query( array (
            'post_type'     => 'portfolio',
            'posts_per_page'=> $settings['show_count'],
            'order' => $settings['order'],
            'orderby' => $settings['orderby'],
            'post__not_in' => !empty($settings['exclude']) ? explode( ',', $settings['exclude']) : ''
        ));

        $portfolio_cats = get_terms( array (
            'taxonomy' => 'portfolio_cat',
            'hide_empty' => true
        ));

        $settings['thumbnail_size'] = [
            'id' => get_post_thumbnail_id(),
        ];
        $thumbnail_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size' );
        $is_show_count = $settings['is_show_count'] == 'yes' ? "show-portfolio-count" : '';
        $layout = ($settings['is_full_width'] == 'yes' ) ? ' portfolio_fullwidth_area' : ' portfolio_area';
        ?>
        <section class="<?php echo $is_show_count; echo $layout ?>">
            <?php echo ($settings['is_full_width'] == 'yes' ) ? '' : '<div class="container">'; ?>
            <div id="portfolio_filter" class="portfolio_filter mb_50">
                <?php if ( !empty($settings['all_label'] ) ) : ?>
                    <div data-filter="*" class="work_portfolio_item active">
                        <?php echo esc_html($settings['all_label']); ?>
                    </div>
                <?php endif; ?>
                <?php
                if ( is_array($portfolio_cats) ) {
                    foreach ( $portfolio_cats as $portfolio_cat ) {
                        $is_show_count = $settings['is_show_count'] == 'yes' ? "<span>{$portfolio_cat->count}</span>" : '';
                        ?>
                        <div data-filter=".<?php echo $portfolio_cat->slug ?>" class="work_portfolio_item">
                            <?php echo $portfolio_cat->name.$is_show_count ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <?php echo ( $settings['is_full_width'] == 'yes' ) ? '<div class="container-fluid pl-0 pr-0">' : ''; ?>

            <?php
            if ( $settings['style'] == 'hover' ) {
                include ( 'portfolio/portfolio-hover.php' );
            }
            elseif ( $settings['style'] == 'normal' ) {
                include ( 'portfolio/portfolio-normal.php' );
            }

            echo ($settings['is_full_width'] == 'yes' ) ? '</div>' : '';
            ?>
        </section>
        <?php
    }

}