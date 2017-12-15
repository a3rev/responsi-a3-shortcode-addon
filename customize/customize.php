<?php
class Shortcode_Responsi_Customize
{
    public function __construct()
    {
        
        add_filter('responsi_default_options_a3_shortcode', array(
            $this,
            'controls_settings'
        ));
        add_filter('responsi_customize_register_panels', array(
            $this,
            'panels'
        ));
        add_filter('responsi_customize_register_sections', array(
            $this,
            'sections'
        ));
        add_filter('responsi_customize_register_settings', array(
            $this,
            'controls_settings'
        ));
        add_action('customize_preview_init', array(
            $this,
            'customize_preview_init'
        ), 11);
        add_action('customize_controls_enqueue_scripts', array(
            $this,
            'customize_controls_enqueue_scripts'
        ), 11);
    }

    public function customize_controls_enqueue_scripts()
    {
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    }

    public function customize_preview_init()
    {
        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        wp_enqueue_script('customize-a3-shortcode-preview', RESPONSI_A3_SC_URL . '/customize/js/customize.preview' . $suffix . '.js', array(
            'jquery',
            'customize-preview',
            'responsi-customize-function'
        ), '5.3.0', 1);
    }

    public function global_responsi_settings($options)
    {
        global $responsi_options_a3_shortcode;
        $options = array_merge($options, $responsi_options_a3_shortcode);
        return $options;
    }

    public function panels($panels)
    {
        $_panels                             = array();
        $_panels['responsi_shortcode_panel'] = array(
            'title' => __('Responsi Shortcode', 'responsi-a3-shortcode-addon'),
            'priority' => 29,
            'active_callback' => '_customize_menu_a3_shortcode'
        );
        $panels                              = array_merge($panels, $_panels);
        return $panels;
    }

    public function sections($sections)
    {
        $_sections = array();

        $_sections['responsi_shortcode_settings_section'] = array(
            'title' => __('Settings', 'responsi-a3_shortcode-addon'),
            'priority' => 10,
            'panel' => 'responsi_shortcode_panel'
        );

        $_sections['responsi_shortcode_icons_section'] = array(
            'title' => __('Icons', 'responsi-a3_shortcode-addon'),
            'priority' => 10,
            'panel' => 'responsi_shortcode_panel'
        );

        $_sections['responsi_shortcode_flipboxes_section'] = array(
            'title' => __('Flip Boxes', 'responsi-a3_shortcode-addon'),
            'priority' => 10,
            'panel' => 'responsi_shortcode_panel'
        );

        $_sections['responsi_shortcode_fullwidth_section'] = array(
            'title' => __('Full Width Sections', 'responsi-a3_shortcode-addon'),
            'priority' => 10,
            'panel' => 'responsi_shortcode_panel'
        );

        $_sections['responsi_shortcode_tabs_section'] = array(
            'title' => __('Tabs', 'responsi-a3_shortcode-addon'),
            'priority' => 10,
            'panel' => 'responsi_shortcode_panel'
        );

        $sections = array_merge($sections, $_sections);
        return $sections;
    }

    public function controls_settings($controls_settings)
    {

        global $responsi_options_a3_shortcode;

        $_sc_icon_size = array(
            'small' => 'Small - 10px',
            'medium' => 'Medium - 18px',
            'large' => 'Large - 40px'
        );
        for ($i = 9; $i <= 70; $i++) {
            $_sc_icon_size[$i] = $i . 'px';
        }

        $_controls_settings = array();

        $_controls_settings['lbsc1'] = array(
            'control' => array(
                'label' => __('WordPress [HR] Tags', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_style_border'] = array(
            'control' => array(
                'label' => __('HR Line Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'settings' => 'responsi_style_border',
                'type' => 'icolor',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_style_border']) ? $responsi_options_a3_shortcode['responsi_style_border'] : '#DBDBDB',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['lbsc2'] = array(
            'control' => array(
                'label' => __('WordPress Quote Tags', 'responsi-a3-shortcode-addon'),
                'description' => __("WordPress Blockquote and Shortcode Quote Icon", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_blockquote_icon'] = array(
            'control' => array(
                'label' => __('Quotation Icon', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'settings' => 'responsi_blockquote_icon',
                'type' => 'icheckbox',
                'input_attrs' => array(
                    'class' => 'collapsed-custom'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_blockquote_icon']) ? $responsi_options_a3_shortcode['responsi_blockquote_icon'] : 'false',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_blockquote_icon_color'] = array(
            'control' => array(
                'label' => __('Quote Icon Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'settings' => 'responsi_blockquote_icon_color',
                'type' => 'icolor',
                'input_attrs' => array(
                    'class' => 'hide-custom'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_blockquote_icon_color']) ? $responsi_options_a3_shortcode['responsi_blockquote_icon_color'] : '#CCCCCC',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['lbsc3'] = array(
            'control' => array(
                'label' => __('Shortcode Quote Boxed Background', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => 'hide-custom'
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_blockquote_boxed'] = array(
            'control' => array(
                'label' => __('Shortcode Quote Boxed Display', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'settings' => 'responsi_blockquote_boxed',
                'type' => 'icheckbox',
                'input_attrs' => array(
                    'class' => 'collapsed hide-custom'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_blockquote_boxed']) ? $responsi_options_a3_shortcode['responsi_blockquote_boxed'] : 'false',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_blockquote_boxed_bg'] = array(
            'control' => array(
                'label' => __('Quote Background Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'settings' => 'multiple',
                'type' => 'ibackground',
                'input_attrs' => array(
                    'class' => 'hide hide-custom'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_blockquote_boxed_bg']) ? $responsi_options_a3_shortcode['responsi_blockquote_boxed_bg'] : array( 'onoff' => 'true', 'color' => '#F9F9F9'),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_blockquote_boxed_border_top'] = array(
            'control' => array(
                'label' => __('Quote Border - Top', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => 'hide hide-custom'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_blockquote_boxed_border_top']) ? $responsi_options_a3_shortcode['responsi_blockquote_boxed_border_top'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#DBDBDB'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_blockquote_boxed_border_bottom'] = array(
            'control' => array(
                'label' => __('Quote Border - Bottom', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => 'hide hide-custom'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_blockquote_boxed_border_bottom']) ? $responsi_options_a3_shortcode['responsi_blockquote_boxed_border_bottom'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#DBDBDB'
                ),
                'transport' => 'hide postMessage'
            )
        );

        $_controls_settings['responsi_blockquote_boxed_border_lr'] = array(
            'control' => array(
                'label' => __('Quote Border - Left and Right', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => 'hide hide-custom'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_blockquote_boxed_border_lr']) ? $responsi_options_a3_shortcode['responsi_blockquote_boxed_border_lr'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#DBDBDB'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_blockquote_boxed_border_radius'] = array(
            'control' => array(
                'label' => __('Quote Border Corner Style', 'responsi-a3-shortcode-addon'),
                //'description' => __("Rounded - Move slider right to increase the px value (rounded corner effect), left to decrease. Applies to all 4 corners.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => 'hide hide-custom'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_blockquote_boxed_border_radius']) ? $responsi_options_a3_shortcode['responsi_blockquote_boxed_border_radius'] : array(
                    'corner' => 'rounded',
                    'rounded_value' => '5'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_blockquote_boxed_box_shadow'] = array(
            'control' => array(
                'label' => __('Quote Border Shadow  ', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_settings_section',
                'settings' => 'multiple',
                'type' => 'box_shadow',
                'input_attrs' => array(
                    'class' => 'hide hide-custom last hide-custom-last'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_blockquote_boxed_box_shadow']) ? $responsi_options_a3_shortcode['responsi_blockquote_boxed_box_shadow'] : array(
                    'onoff' => 'true',
                    'h_shadow' => '0px',
                    'v_shadow' => '0px',
                    'blur' => '8px',
                    'spread' => '0px',
                    'color' => '#DBDBDB',
                    'inset' => 'inset'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['lbsc4'] = array(
            'control' => array(
                'label' => __('Shortcode Icons Default Style', 'responsi-a3-shortcode-addon'),
                'description' => __("<strong>Conditionals:</strong><br/>1. Set a Default style for the 592 Font Awesome icons that can be inserted by shortcode.<br/>2. Default style can be customized for each individual icon when inserting it by shortcode.<br/>3. Changing the Font Awesome default style updates all icons that have been embedded using the default style.<br/>4. Changing the Font Awesome default style does not affect icons inserted with a custom style.<br/>5. Default style created here applies to Unorder List Icons shortcode.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_icons_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_sc_icon_size'] = array(
            'control' => array(
                'label' => __('Default Size', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_icons_section',
                'settings' => 'responsi_sc_icon_size',
                'type' => 'iselect',
                'choices' => $_sc_icon_size,
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_icon_size']) ? $responsi_options_a3_shortcode['responsi_sc_icon_size'] : 'small',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_icon_color'] = array(
            'control' => array(
                'label' => __('Default Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_icons_section',
                'settings' => 'responsi_sc_icon_color',
                'type' => 'icolor',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_icon_color']) ? $responsi_options_a3_shortcode['responsi_sc_icon_color'] : '#000000',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_icon_background'] = array(
            'control' => array(
                'label' => __('Default Background Colour', 'responsi-a3-shortcode-addon'),
                'description' => __("For no colour replace the Hex # (e.g #000000) with the word - transparent", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_icons_section',
                'settings' => 'multiple',
                'type' => 'ibackground',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_icon_background']) ? $responsi_options_a3_shortcode['responsi_sc_icon_background'] : array( 'onoff' => 'true', 'color' => '#ffffff' ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_icon_border'] = array(
            'control' => array(
                'label' => __('Border', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_icons_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_icon_border']) ? $responsi_options_a3_shortcode['responsi_sc_icon_border'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#000000'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_icon_border_radius'] = array(
            'control' => array(
                'label' => __('Border Corner', 'responsi-a3-shortcode-addon'),
                'description' => __("Use the slider to apply round to Border Corners. 0 = Square. Set at max 100 = Circle.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_icons_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => 'circle'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_icon_border_radius']) ? $responsi_options_a3_shortcode['responsi_sc_icon_border_radius'] : array(
                    'corner' => 'rounded',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_icon_shadow'] = array(
            'control' => array(
                'label' => __('Border Shadow', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_icons_section',
                'settings' => 'multiple',
                'type' => 'box_shadow',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_icon_shadow']) ? $responsi_options_a3_shortcode['responsi_sc_icon_shadow'] : array(
                    'onoff' => 'false',
                    'h_shadow' => '0px',
                    'v_shadow' => '0px',
                    'blur' => '0px',
                    'spread' => '0px',
                    'color' => '#000000',
                    'inset' => ''
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_icon_margin'] = array(
            'control' => array(
                'label' => __('Margin', 'responsi-a3-shortcode-addon'),
                //'description' => __("Numeric px vales ex. 10 = 10px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_icons_section',
                'settings' => 'multitext',
                'type' => 'multitext',
                'choices' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => array(
                    isset($responsi_options_a3_shortcode['responsi_sc_icon_margin_top']) ? $responsi_options_a3_shortcode['responsi_sc_icon_margin_top'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_icon_margin_bottom']) ? $responsi_options_a3_shortcode['responsi_sc_icon_margin_bottom'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_icon_margin_left']) ? $responsi_options_a3_shortcode['responsi_sc_icon_margin_left'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_icon_margin_right']) ? $responsi_options_a3_shortcode['responsi_sc_icon_margin_right'] : '3'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_icon_padding'] = array(
            'control' => array(
                'label' => __('Padding', 'responsi-a3-shortcode-addon'),
                //'description' => __("Numeric px vales ex. 10 = 10px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_icons_section',
                'settings' => 'multitext',
                'type' => 'multitext',
                'choices' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => array(
                    isset($responsi_options_a3_shortcode['responsi_sc_icon_padding_top']) ? $responsi_options_a3_shortcode['responsi_sc_icon_padding_top'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_icon_padding_bottom']) ? $responsi_options_a3_shortcode['responsi_sc_icon_padding_bottom'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_icon_padding_left']) ? $responsi_options_a3_shortcode['responsi_sc_icon_padding_left'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_icon_padding_right']) ? $responsi_options_a3_shortcode['responsi_sc_icon_padding_right'] : '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['lbsc5'] = array(
            'control' => array(
                'label' => __('Shortcode Flip Boxes Front Side Default Style', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_sc_flip_boxes_front_heading'] = array(
            'control' => array(
                'label' => __('Heading Font', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'settings' => 'multiple',
                'type' => 'typography',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_flip_boxes_front_heading']) ? $responsi_options_a3_shortcode['responsi_sc_flip_boxes_front_heading'] : array(
                    'size' => '18',
                    'line_height' => '1',
                    'face' => 'Rokkitt',
                    'style' => 'normal',
                    'color' => '#333333'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_flip_boxes_front_text'] = array(
            'control' => array(
                'label' => __('Content Font', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'settings' => 'multiple',
                'type' => 'typography',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_flip_boxes_front_text']) ? $responsi_options_a3_shortcode['responsi_sc_flip_boxes_front_text'] : array(
                    'size' => '12',
                    'line_height' => '1.5',
                    'face' => 'Calibri,Candara,Segoe,Optima,sans-serif',
                    'style' => 'normal',
                    'color' => '#747474'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_flip_boxes_front_bg'] = array(
            'control' => array(
                'label' => __('Background Color', 'responsi-a3-shortcode-addon'),
                'description' => __("Controls the color of frontside background color.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'settings' => 'multiple',
                'type' => 'ibackground',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_flip_boxes_front_bg']) ? $responsi_options_a3_shortcode['responsi_sc_flip_boxes_front_bg'] : array( 'onoff' => 'true', 'color' => '#f6f6f6' ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_flip_boxes_front_border'] = array(
            'control' => array(
                'label' => __('Border', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_flip_boxes_front_border']) ? $responsi_options_a3_shortcode['responsi_sc_flip_boxes_front_border'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#ffffff'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_flip_boxes_front_radius'] = array(
            'control' => array(
                'label' => __('Border Corner', 'responsi-a3-shortcode-addon'),
                'description' => __("Use the slider to apply round to Border Corners. 0 = Square. Set at max 100 = Circle.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_flip_boxes_front_radius']) ? $responsi_options_a3_shortcode['responsi_sc_flip_boxes_front_radius'] : array(
                    'corner' => 'rounded',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['lbsc6'] = array(
            'control' => array(
                'label' => __('Shortcode Flip Boxes Back Side Default Style', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_sc_flip_boxes_back_heading'] = array(
            'control' => array(
                'label' => __('Heading Font', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'settings' => 'multiple',
                'type' => 'typography',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_flip_boxes_back_heading']) ? $responsi_options_a3_shortcode['responsi_sc_flip_boxes_back_heading'] : array(
                    'size' => '18',
                    'line_height' => '1',
                    'face' => 'Rokkitt',
                    'style' => 'normal',
                    'color' => '#eeeded'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_flip_boxes_back_text'] = array(
            'control' => array(
                'label' => __('Content Font', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'settings' => 'multiple',
                'type' => 'typography',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_flip_boxes_back_text']) ? $responsi_options_a3_shortcode['responsi_sc_flip_boxes_back_text'] : array(
                    'size' => '12',
                    'line_height' => '1.5',
                    'face' => 'Calibri,Candara,Segoe,Optima,sans-serif',
                    'style' => 'normal',
                    'color' => '#ffffff'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_flip_boxes_back_bg'] = array(
            'control' => array(
                'label' => __('Background Color', 'responsi-a3-shortcode-addon'),
                'description' => __("Controls the color of backside background color.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'settings' => 'multiple',
                'type' => 'ibackground',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_flip_boxes_back_bg']) ? $responsi_options_a3_shortcode['responsi_sc_flip_boxes_back_bg'] : array( 'onoff' => 'true', 'color' => '#a0ce4e' ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_flip_boxes_back_border'] = array(
            'control' => array(
                'label' => __('Border', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_flip_boxes_back_border']) ? $responsi_options_a3_shortcode['responsi_sc_flip_boxes_back_border'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#ffffff'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_flip_boxes_back_radius'] = array(
            'control' => array(
                'label' => __('Border Corner', 'responsi-a3-shortcode-addon'),
                'description' => __("Use the slider to apply round to Border Corners. 0 = Square. Set at max 100 = Circle.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_flipboxes_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_flip_boxes_back_radius']) ? $responsi_options_a3_shortcode['responsi_sc_flip_boxes_back_radius'] : array(
                    'corner' => 'rounded',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['lbsc7'] = array(
            'control' => array(
                'label' => __('Shortcode Full Width Section Default Style', 'responsi-a3-shortcode-addon'),
                'description' => __("Conditionals:<br>1. Use with Full Width 100% page template to create full width sections that span the entire width of your browser window, or keep content contained inside a set px width. Add section background images, borders, colours, padding, positioning and content with the shortcode<br>2. Use with Posts and Pages to create custom full content width sections (not edge to edge of the browser screen)<br>3. The settings below are default settings. All can be edited from the Full Content Section insert shortcode pop-up settings.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_fullwidth_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_sc_fullwidth_bg'] = array(
            'control' => array(
                'label' => __('Full Width Section Background Colour', 'responsi-a3-shortcode-addon'),
                'description' => __("Default Full Width Section Background colour.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_fullwidth_section',
                'settings' => 'multiple',
                'type' => 'ibackground',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_fullwidth_bg']) ? $responsi_options_a3_shortcode['responsi_sc_fullwidth_bg'] : array( 'onoff' => 'true', 'color' => 'transparent' ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_fullwidth_border'] = array(
            'control' => array(
                'label' => __('Full Width Section Top and Bottom Borders', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_fullwidth_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_fullwidth_border']) ? $responsi_options_a3_shortcode['responsi_sc_fullwidth_border'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#eae9e9'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_fullwidth_content_width'] = array(
            'control' => array(
                'label' => __('Default Interior Content Width', 'responsi-a3-shortcode-addon'),
                'description' => __("Default Interior Content Width in px if the Interior Content Width option is used for the Full Width Section.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_fullwidth_section',
                'settings' => 'responsi_sc_fullwidth_content_width',
                'type' => 'slider',
                'input_attrs' => array(
                    'min' => '600',
                    'max' => '3000',
                    'step' => '10',
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_fullwidth_content_width']) ? $responsi_options_a3_shortcode['responsi_sc_fullwidth_content_width'] : 940,
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['lbsc8'] = array(
            'control' => array(
                'label' => __('Tabs Container Style', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_sc_tab_border'] = array(
            'control' => array(
                'label' => __('Border', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_border']) ? $responsi_options_a3_shortcode['responsi_sc_tab_border'] : array(
                    'width' => '1',
                    'style' => 'solid',
                    'color' => '#ebeaea'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_corner'] = array(
            'control' => array(
                'label' => __('Border Corner', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_corner']) ? $responsi_options_a3_shortcode['responsi_sc_tab_corner'] : array(
                    'corner' => 'square',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_ctmargin_on'] = array(
            'control' => array(
                'label' => __('Margin', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_ctmargin_on',
                'type' => 'icheckbox',
                'input_attrs' => array(
                    'class' => 'collapsed'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_ctmargin_on']) ? $responsi_options_a3_shortcode['responsi_sc_tab_ctmargin_on'] : 'false',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_ctmargin'] = array(
            'control' => array(
                'label' => "",
                //'description' => __("Numeric px vales ex. 10 = 10px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multitext',
                'type' => 'multitext',
                'choices' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom'
                ),
                'input_attrs' => array(
                    'class' => 'hide last'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => array(
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_ctmargin_top']) ? $responsi_options_a3_shortcode['responsi_sc_tab_ctmargin_top'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_ctmargin_bottom']) ? $responsi_options_a3_shortcode['responsi_sc_tab_ctmargin_bottom'] : '20'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['lbsc9'] = array(
            'control' => array(
                'label' => __('Tabs Style', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_sc_tab_font'] = array(
            'control' => array(
                'label' => __('Font', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'typography',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_font']) ? $responsi_options_a3_shortcode['responsi_sc_tab_font'] : array(
                    'size' => '14',
                    'face' => 'Rokkitt',
                    'line_height' => '1',
                    'style' => 'normal',
                    'color' => '#333333'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_icon_color'] = array(
            'control' => array(
                'label' => __('Icon Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_icon_color',
                'type' => 'icolor',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_icon_color']) ? $responsi_options_a3_shortcode['responsi_sc_tab_icon_color'] : '#333333',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_backgroundcolor'] = array(
            'control' => array(
                'label' => __('Background Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'ibackground',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_backgroundcolor']) ? $responsi_options_a3_shortcode['responsi_sc_tab_backgroundcolor'] : array('onoff' => 'true', 'color' => '#ebeaea'),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_bordertop'] = array(
            'control' => array(
                'label' => __('Border - Top', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_bordertop']) ? $responsi_options_a3_shortcode['responsi_sc_tab_bordertop'] : array(
                    'width' => '3',
                    'style' => 'solid',
                    'color' => '#ebeaea'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_borderbottom'] = array(
            'control' => array(
                'label' => __('Border - Bottom', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_borderbottom']) ? $responsi_options_a3_shortcode['responsi_sc_tab_borderbottom'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#ebeaea'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_borderleft'] = array(
            'control' => array(
                'label' => __('Border - Left', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_borderleft']) ? $responsi_options_a3_shortcode['responsi_sc_tab_borderleft'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#ebeaea'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_borderright'] = array(
            'control' => array(
                'label' => __('Border - Right', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_borderright']) ? $responsi_options_a3_shortcode['responsi_sc_tab_borderright'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#ebeaea'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cornertopleft'] = array(
            'control' => array(
                'label' => __('Border Corner - Top Left', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_cornertopleft']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cornertopleft'] : array(
                    'corner' => 'square',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cornertopright'] = array(
            'control' => array(
                'label' => __('Border Corner - Top Right', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_cornertopright']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cornertopright'] : array(
                    'corner' => 'square',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cornerbottomleft'] = array(
            'control' => array(
                'label' => __('Border Corner - Bottom Left', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_cornerbottomleft']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cornerbottomleft'] : array(
                    'corner' => 'square',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cornerbottomright'] = array(
            'control' => array(
                'label' => __('Border Corner - Bottom Right', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_cornerbottomright']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cornerbottomright'] : array(
                    'corner' => 'square',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_margin_on'] = array(
            'control' => array(
                'label' => __('Margin', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_margin_on',
                'type' => 'icheckbox',
                'input_attrs' => array(
                    'class' => 'collapsed'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_margin_on']) ? $responsi_options_a3_shortcode['responsi_sc_tab_margin_on'] : 'true',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_margin'] = array(
            'control' => array(
                'label' => "",
                //'description' => __("Numeric px vales ex. 10 = 10px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multitext',
                'type' => 'multitext',
                'choices' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'input_attrs' => array(
                    'class' => 'hide last'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => array(
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_margin_top']) ? $responsi_options_a3_shortcode['responsi_sc_tab_margin_top'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_margin_bottom']) ? $responsi_options_a3_shortcode['responsi_sc_tab_margin_bottom'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_margin_left']) ? $responsi_options_a3_shortcode['responsi_sc_tab_margin_left'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_margin_right']) ? $responsi_options_a3_shortcode['responsi_sc_tab_margin_right'] : '1'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_padding_on'] = array(
            'control' => array(
                'label' => __('Padding', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_padding_on',
                'type' => 'icheckbox',
                'input_attrs' => array(
                    'class' => 'collapsed'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_padding_on']) ? $responsi_options_a3_shortcode['responsi_sc_tab_padding_on'] : 'true',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_padding'] = array(
            'control' => array(
                'label' => "",
                //'description' => __("Numeric px vales ex. 10 = 10px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multitext',
                'type' => 'multitext',
                'choices' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'input_attrs' => array(
                    'class' => 'hide last'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => array(
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_padding_top']) ? $responsi_options_a3_shortcode['responsi_sc_tab_padding_top'] : '10',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_padding_bottom']) ? $responsi_options_a3_shortcode['responsi_sc_tab_padding_bottom'] : '10',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_padding_left']) ? $responsi_options_a3_shortcode['responsi_sc_tab_padding_left'] : '15',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_padding_right']) ? $responsi_options_a3_shortcode['responsi_sc_tab_padding_right'] : '15'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['lbsc10'] = array(
            'control' => array(
                'label' => __('Tabs Inactive Style', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_sc_tab_coloractive'] = array(
            'control' => array(
                'label' => __('Font Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_coloractive',
                'type' => 'icolor',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_coloractive']) ? $responsi_options_a3_shortcode['responsi_sc_tab_coloractive'] : '#333333',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_backgroundcoloractive'] = array(
            'control' => array(
                'label' => __('Background Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'ibackground',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_backgroundcoloractive']) ? $responsi_options_a3_shortcode['responsi_sc_tab_backgroundcoloractive'] : array('onoff' => 'true', 'color' => '#ffffff'),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_bordertopactive'] = array(
            'control' => array(
                'label' => __('Border Top Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_bordertopactive',
                'type' => 'icolor',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_bordertopactive']) ? $responsi_options_a3_shortcode['responsi_sc_tab_bordertopactive'] : '#a0ce4e',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_borderbottomactive'] = array(
            'control' => array(
                'label' => __('Border Bottom Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_borderbottomactive',
                'type' => 'icolor',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_borderbottomactive']) ? $responsi_options_a3_shortcode['responsi_sc_tab_borderbottomactive'] : '#ebeaea',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_borderleftactive'] = array(
            'control' => array(
                'label' => __('Border Left Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_borderleftactive',
                'type' => 'icolor',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_borderleftactive']) ? $responsi_options_a3_shortcode['responsi_sc_tab_borderleftactive'] : '#ebeaea',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_borderrightactive'] = array(
            'control' => array(
                'label' => __('Border Right Colour', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_borderrightactive',
                'type' => 'icolor',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_borderrightactive']) ? $responsi_options_a3_shortcode['responsi_sc_tab_borderrightactive'] : '#ebeaea',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['lbsc11'] = array(
            'control' => array(
                'label' => __('Content Tabs Style', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'type' => 'ilabel',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
            )
        );

        $_controls_settings['responsi_sc_tab_fontcontent'] = array(
            'control' => array(
                'label' => __('Font', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'typography',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_fontcontent']) ? $responsi_options_a3_shortcode['responsi_sc_tab_fontcontent'] : array(
                    'size' => '12',
                    'line_height' => '1.5',
                    'face' => 'Lato',
                    'style' => 'normal',
                    'color' => '#333333'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cbordertop'] = array(
            'control' => array(
                'label' => __('Border - Top', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_cbordertop']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cbordertop'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#ebeaea'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cborderbottom'] = array(
            'control' => array(
                'label' => __('Border - Bottom', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_cborderbottom']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cborderbottom'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#ebeaea'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cborderleft'] = array(
            'control' => array(
                'label' => __('Border - Left', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_cborderleft']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cborderleft'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#ebeaea'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cborderright'] = array(
            'control' => array(
                'label' => __('Border - Right', 'responsi-a3-shortcode-addon'),
                //'description' => __("No Border = 0px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_cborderright']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cborderright'] : array(
                    'width' => '0',
                    'style' => 'solid',
                    'color' => '#ebeaea'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_ccornertopleft'] = array(
            'control' => array(
                'label' => __('Border Corner - Top Left', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_ccornertopleft']) ? $responsi_options_a3_shortcode['responsi_sc_tab_ccornertopleft'] : array(
                    'corner' => 'square',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_ccornertopright'] = array(
            'control' => array(
                'label' => __('Border Corner - Top Right', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_ccornertopright']) ? $responsi_options_a3_shortcode['responsi_sc_tab_ccornertopright'] : array(
                    'corner' => 'square',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_ccornerbottomleft'] = array(
            'control' => array(
                'label' => __('Border Corner - Bottom Left', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_ccornerbottomleft']) ? $responsi_options_a3_shortcode['responsi_sc_tab_ccornerbottomleft'] : array(
                    'corner' => 'square',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_ccornerbottomright'] = array(
            'control' => array(
                'label' => __('Border Corner - Bottom Right', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multiple',
                'type' => 'border_radius',
                'input_attrs' => array(
                    'class' => ''
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_ccornerbottomright']) ? $responsi_options_a3_shortcode['responsi_sc_tab_ccornerbottomright'] : array(
                    'corner' => 'square',
                    'rounded_value' => '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cmargin_on'] = array(
            'control' => array(
                'label' => __('Content Margin', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_cmargin_on',
                'type' => 'icheckbox',
                'input_attrs' => array(
                    'class' => 'collapsed'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_cmargin_on']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cmargin_on'] : 'false',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cmargin'] = array(
            'control' => array(
                'label' => "",
                //'description' => __("Numeric px vales ex. 10 = 10px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multitext',
                'type' => 'multitext',
                'choices' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'input_attrs' => array(
                    'class' => 'hide last'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => array(
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_cmargin_top']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cmargin_top'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_cmargin_bottom']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cmargin_bottom'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_cmargin_left']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cmargin_left'] : '0',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_cmargin_right']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cmargin_right'] : '0'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cpadding_on'] = array(
            'control' => array(
                'label' => __('Content Padding', 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'responsi_sc_tab_cpadding_on',
                'type' => 'icheckbox',
                'input_attrs' => array(
                    'class' => 'collapsed'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => isset($responsi_options_a3_shortcode['responsi_sc_tab_cpadding_on']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cpadding_on'] : 'true',
                'transport' => 'postMessage'
            )
        );

        $_controls_settings['responsi_sc_tab_cpadding'] = array(
            'control' => array(
                'label' => "",
                //'description' => __("Numeric px vales ex. 10 = 10px.", 'responsi-a3-shortcode-addon'),
                'section' => 'responsi_shortcode_tabs_section',
                'settings' => 'multitext',
                'type' => 'multitext',
                'choices' => array(
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                    'left' => 'Left',
                    'right' => 'Right'
                ),
                'input_attrs' => array(
                    'class' => 'hide last'
                )
            ),
            'setting' => array(
                'type' => 'option',
                'default' => array(
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_cpadding_top']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cpadding_top'] : '15',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_cpadding_bottom']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cpadding_bottom'] : '15',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_cpadding_left']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cpadding_left'] : '15',
                    isset($responsi_options_a3_shortcode['responsi_sc_tab_cpadding_right']) ? $responsi_options_a3_shortcode['responsi_sc_tab_cpadding_right'] : '15'
                ),
                'transport' => 'postMessage'
            )
        );

        $_controls_settings = apply_filters('_a3_shortcode_controls_settings', $_controls_settings);
        $controls_settings  = array_merge($controls_settings, $_controls_settings);
        return $controls_settings;
    }
}
new Shortcode_Responsi_Customize();
?>
