<?php
/**
 * Custom Post Types
 */
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Custom Post Types', 'saasland' ),
    'id'        => 'cpt_opt',
    'icon'      => 'dashicons dashicons-admin-post',
));

/**
 * Post Types
 */
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Post Types', 'saasland' ),
    'id'        => 'cpt',
    'icon'      => '',
    'subsection'=> true,
    'fields'    => array(
        array(
            'id'        => 'cpt_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Enable Disable Custom Post Types', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'desc'      => esc_html__( 'If you want, you can disable any custom post type of Saasland from here.', 'saasland' )
        ),

        array(
            'id'       => 'is_service_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Services', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_team_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Team', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_portfolio_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Portfolios', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_case_study_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('Case Studies', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_faq_cpt',
            'type'     => 'switch',
            'title'    => esc_html__('FAQs', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_job_cpt',
            'type'     => 'switch',
            'title'    => esc_html__( 'Jobs', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_mega_menu_cpt',
            'type'     => 'switch',
            'title'    => esc_html__( 'Mega Menu', 'saasland' ),
            'subtitle' => esc_html__( 'If you want to use third party navigation menu (Eg, Elementor pro, Jet menu etc), you need to disable the Mega Menu feature from here.', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'        => 'note_headers_footers',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note:', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'desc'      => sprintf(
                '%1$s <a href="%2$s"> %3$s </a> %4$s',
                esc_html__( 'If you are using Elementor Pro and not able to create Popup, disable the Header & Footer from here. We recommend you to create custom Header, Footer using Elementor pro. Learn more', 'saasland' ),
                'https://is.gd/XO9OzB',
                esc_html__( 'here', 'saasland' ),
                'https://is.gd/XO9OzB'
            ),
        ),

        array(
            'id'       => 'is_header_cpt',
            'type'     => 'switch',
            'title'    => esc_html__( 'Headers', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),

        array(
            'id'       => 'is_footer_cpt',
            'type'     => 'switch',
            'title'    => esc_html__( 'Footers', 'saasland' ),
            'on'       => esc_html__( 'Enabled', 'saasland' ),
            'off'      => esc_html__( 'Disabled', 'saasland' ),
            'default'  => true,
        ),
    )
));

/**
 * Slug Re-write
 */
Redux::setSection( 'saasland_opt', array(
    'title'     => esc_html__( 'Post Type Slugs', 'saasland' ),
    'id'        => 'saasland_cp_slugs',
    'icon'      => '',
    'subsection'=> true,
    'fields'    => array(
        array(
            'id'        => 'cp_slug_note',
            'type'      => 'info',
            'style'     => 'warning',
            'title'     => esc_html__( 'Slug Re-write:', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'desc'      => sprintf (
                '%1$s <a href="%2$s"> %3$s</a> %4$s',
                esc_html__( "These are the custom post's slugs offered by Saasland. You can customize the permalink structure (site_domain/post_type_slug/post_slug) by changing the post type slug (post_type_slug) from here. Don't forget to save the permalinks settings from", 'saasland' ),
                get_admin_url( null, 'options-permalink.php' ),
                esc_html__( 'Settings > Permalinks', 'saasland' ),
                esc_html__( 'after changing the slug value.', 'saasland' )
            )
        ),
        
        array(
            'title'     => esc_html__( 'Service Slug', 'saasland' ),
            'id'        => 'service_slug',
            'type'      => 'text',
            'required'  => array( 'is_service_cpt', '=', '1' ),
            'default'   => 'service'
        ),
        
        array(
            'title'     => esc_html__( 'Portfolio Slug', 'saasland' ),
            'id'        => 'portfolio_slug',
            'type'      => 'text',
            'required'  => array( 'is_portfolio_cpt', '=', '1' ),
            'default'   => 'portfolio'
        ),
        
        array(
            'title'     => esc_html__( 'Case Study Slug', 'saasland' ),
            'id'        => 'case_study_slug',
            'type'      => 'text',
            'required'  => array( 'is_case_study_cpt', '=', '1' ),
            'default'   => 'case_study'
        ),

        array(
            'title'     => esc_html__( 'Jobs Slug', 'saasland' ),
            'id'        => 'job_slug',
            'type'      => 'text',
            'required'  => array( 'is_job_cpt', '=', '1' ),
            'default'   => 'job'
        ),
    )
));

/**
 * Portfolio
 */
Redux::setSection( 'saasland_opt', array(
    'title'         => esc_html__( 'Portfolio', 'saasland' ),
    'id'            => 'portfolio_settings',
    'icon'          => '',
    'subsection'    => true,
    'fields'        => array(
        array(
            'id'        => 'portfolio_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'required'  => array( 'is_portfolio_cpt', '=', '' ),
            'desc'      => esc_html__( "Portfolio post type is disabled that's why the portfolio settings are gone from here. Enable the portfolio post type from 'Theme Settings > Custom Post Types > Post Types' To show the portfolio settings.", 'saasland' )
        ),

        array(
            'title'     => esc_html__( 'Default Layout', 'saasland' ),
            'subtitle'  => esc_html__( 'Select the default portfolio layout for portfolio details page', 'saasland' ),
            'id'        => 'portfolio_layout',
            'type'      => 'select',
            'default'   => 'leftc_righti',
            'required'  => array( 'is_portfolio_cpt', '=', '1' ),
            'options'   => array(
                'leftc_righti' => esc_html__( 'Left Content Right Images', 'saasland' ),
                'lefti_rightc' => esc_html__( 'Left Images Right Content', 'saasland' ),
                'topi_bottomc' => esc_html__( 'Top Images Bottom Content', 'saasland' ),
            )
        ),

        // Portfolio Share Options
        array(
            'id'        => 'portfolio_share_start',
            'type'      => 'section',
            'title'     => __( 'Share Options', 'saasland' ),
            'subtitle'  => __( 'Enable/Disable social media share options as you want.', 'saasland' ),
            'indent'    => true,
            'required'  => array( 'is_portfolio_cpt', '=', '1' ),
        ),

        array(
            'id'        => 'share_options',
            'type'      => 'switch',
            'title'     => esc_html__( 'Share Options', 'saasland' ),
            'default'   => true,
            'on'        => esc_html__( 'Show', 'saasland' ),
            'off'       => esc_html__( 'Hide', 'saasland' ),
            'required'  => array( 'is_portfolio_cpt', '=', '1' ),
        ),
        array(
            'id'       => 'share_title',
            'type'     => 'text',
            'title'    => esc_html__( 'Title', 'saasland' ),
            'default'  => esc_html__( 'Share on', 'saasland' ),
            'required' => array( 'share_options','=','1' ),
        ),
        array(
            'id'       => 'is_portfolio_fb',
            'type'     => 'switch',
            'title'    => esc_html__( 'Facebook', 'saasland' ),
            'default'  => true,
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_twitter',
            'type'     => 'switch',
            'title'    => esc_html__( 'Twitter', 'saasland' ),
            'default'  => true,
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_googleplus',
            'type'     => 'switch',
            'title'    => esc_html__( 'Google Plus', 'saasland' ),
            'default'  => true,
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_linkedin',
            'type'     => 'switch',
            'title'    => esc_html__( 'Linkedin', 'saasland' ),
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),
        array(
            'id'       => 'is_portfolio_pinterest',
            'type'     => 'switch',
            'title'    => esc_html__( 'Pinterest', 'saasland' ),
            'required' => array( 'share_options','=','1' ),
            'on'       => esc_html__( 'Show', 'saasland' ),
            'off'      => esc_html__( 'Hide', 'saasland' ),
        ),

        array(
            'id'     => 'portfolio_share_end',
            'type'   => 'section',
            'indent' => false,
        ),
    )
));

/**
 * Job
 */
Redux::setSection( 'saasland_opt', array(
    'title'            => esc_html__( 'Job', 'saasland' ),
    'id'               => 'job_opt',
    'icon'             => '',
    'subsection'       => true,
    'fields'           => array(
        array(
            'id'        => 'job_note',
            'type'      => 'info',
            'style'     => 'success',
            'title'     => esc_html__( 'Important Note', 'saasland' ),
            'icon'      => 'dashicons dashicons-info',
            'required'  => array( 'is_job_cpt', '=', '' ),
            'desc'      => esc_html__( "The Job post type is disabled that's why the job settings are gone from here. Enable the job post type from 'Theme Settings > Custom Post Types > Post Types' To show the Job settings.", 'saasland' )
        ),

        array(
            'title'     => esc_html__( 'Form Shortcode', 'saasland' ),
            'subtitle'  => __( 'Get the Job Apply form template from <a href="https://is.gd/N6sJVo" target="_blank">here.</a>', 'saasland' ),
            'id'        => 'apply_form_shortcode',
            'type'      => 'text',
            'required'  => array( 'is_job_cpt', '=', '1' ),
        ),
        array(
            'title'     => esc_html__( 'Apply Button Title', 'saasland' ),
            'id'        => 'apply_btn_title',
            'type'      => 'text',
            'default'   => esc_html__( 'Apply Now', 'saasland' ),
            'required'  => array( 'is_job_cpt', '=', '1' ),
        ),
        array(
            'title'     => esc_html__( 'Before Apply Form', 'saasland' ),
            'subtitle'  => esc_html__( 'Place contents to show before the Apply Form', 'saasland' ),
            'id'        => 'before_form',
            'type'      => 'editor',
            'required'  => array( 'is_job_cpt', '=', '1' ),
            'args'    => array(
                'wpautop'       => true,
                'media_buttons' => false,
                'textarea_rows' => 10,
                //'tabindex' => 1,
                //'editor_css' => '',
                'teeny'         => false,
                //'tinymce' => array(),
                'quicktags'     => false,
            )
        ),

        // Styling
        array(
            'id'            => 'job_divide_start',
            'type'          => 'section',
            'title'         => esc_html__( 'Job Details Page Styling', 'saasland' ),
            'indent'        => true,
            'required'  => array( 'is_job_cpt', '=', '1' ),
        ),

        array(
            'title'         => esc_html__( 'Icons Color', 'saasland' ),
            'subtitle'      => esc_html__( 'Job attribute icons color', 'saasland' ),
            'id'            => 'job_atts_icon_color',
            'type'          => 'color',
            'output'        => array (
                'color'      => '.job_info .info_item i, .job_info .info_head i',
                'required'  => array( 'is_job_cpt', '=', '1' ),
            ),
        ),

        array(
            'title'         => esc_html__( 'Job Info Background', 'saasland' ),
            'subtitle'      => esc_html__( 'Job info box background color', 'saasland' ),
            'id'            => 'job_info_bg_color',
            'type'          => 'color',
            'required'  => array( 'is_job_cpt', '=', '1' ),
            'output'        => array (
                'background'      => '.job_info',
            ),
        ),

        array(
            'title'         => esc_html__( 'Attribute Title Color', 'saasland' ),
            'id'            => 'job_atts_title_color',
            'type'          => 'color',
            'required'      => array( 'is_job_cpt', '=', '1' ),
            'output'        => array (
                'color'      => '.job_info .info_item h6, .job_info .info_head h6',
            ),
        ),

        array(
            'title'         => esc_html__( 'Attribute Value Color', 'saasland' ),
            'id'            => 'job_atts_value_color',
            'type'          => 'color',
            'required'      => array( 'is_job_cpt', '=', '1' ),
            'output'        => array (
                'color'      => '.job_info .info_item p',
            ),
        ),
        array(
            'id'            => 'job_divide_end',
            'type'          => 'section',
            'required'      => array( 'is_job_cpt', '=', '1' ),
            'indent'        => false,
        ),
    )
));