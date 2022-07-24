<?php

use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Democlass extends Widget_Base {

    //widget id
    public function get_name() {
        return 'hello-world';
    }

    //widget id
    public function get_title() {
        return __('Hello World', 'textdomain');
    }

    //widget id
    public function get_icon() {
        return 'eicon-posts-ticker';
    }

    //widget id
    public function get_categories() {
        return ['general', 'naajihun-widgets'];
    }

    //widget id
    public function get_script_depends() {
        return [''];
    }

    //widget id
    public function get_style_depends() {
        return [''];
    }

    //register_controls
    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'textdomain'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'widget_title',
            [
                'label'       => __('Title', 'textdomain'),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __('Default title', 'textdomain'),
                'placeholder' => __('Type your title here', 'textdomain'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'textdomain'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_transform',
            [
                'label'     => __('Text Transform', 'textdomain'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    ''           => __('None', 'textdomain'),
                    'uppercase'  => __('UPPERCASE', 'textdomain'),
                    'lowercase'  => __('lowercase', 'textdomain'),
                    'capitalize' => __('Capitalize', 'textdomain'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    //display
    protected function render() {
        $settings = $this->get_settings_for_display();

        echo '<div class="title">';
        echo $settings['widget_title'];
        echo '</div>';
    }

    //display with js
    protected function content_template() {

    }
}