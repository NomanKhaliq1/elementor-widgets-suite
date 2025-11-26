<?php

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

class Video_Card_Widget extends Widget_Base {

    public function get_name() {
        return 'video_card_widget';
    }

    public function get_title() {
        return __('Video Card', 'download-card-widget');
    }

    public function get_icon() {
        return 'eicon-play';
    }

    public function get_categories() {
        return ['general'];
    }

    public function get_style_depends() {
        return ['video-card-widget'];
    }

    public function get_script_depends() {
        return ['video-card-widget'];
    }

    protected function register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('Content', 'download-card-widget'),
        ]);

        $this->add_control('icon', [
            'label'   => __('Icon', 'download-card-widget'),
            'type'    => Controls_Manager::ICONS,
            'default' => [
                'value'   => 'fas fa-video',
                'library' => 'fa-solid',
            ],
        ]);

        $this->add_control('tag_text', [
            'label'       => __('Tag', 'download-card-widget'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Platform Training', 'download-card-widget'),
            'placeholder' => __('Platform Training', 'download-card-widget'),
        ]);

        $this->add_control('duration', [
            'label'       => __('Duration', 'download-card-widget'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('12:45', 'download-card-widget'),
            'placeholder' => __('12:45', 'download-card-widget'),
        ]);

        $this->add_control('title', [
            'label'       => __('Title', 'download-card-widget'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Introduction to Eustis TPO Platform', 'download-card-widget'),
            'label_block' => true,
        ]);

        $this->add_control('button_text', [
            'label'       => __('Button Text', 'download-card-widget'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Watch Now', 'download-card-widget'),
            'placeholder' => __('Watch Now', 'download-card-widget'),
        ]);

        $this->add_control('video_url', [
            'label'       => __('Video URL (YouTube)', 'download-card-widget'),
            'type'        => Controls_Manager::URL,
            'placeholder' => __('https://www.youtube.com/watch?v=XXXX', 'download-card-widget'),
            'label_block' => true,
        ]);

        $this->add_control('open_popup', [
            'label'        => __('Open in Popup', 'download-card-widget'),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => __('Yes', 'download-card-widget'),
            'label_off'    => __('No', 'download-card-widget'),
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_card_section', [
            'label' => __('Card', 'download-card-widget'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('card_bg', [
            'label'     => __('Background', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .vcw-card' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('card_border', [
            'label'     => __('Border Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#e5e7eb',
            'selectors' => [
                '{{WRAPPER}} .vcw-card' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('card_padding', [
            'label'      => __('Padding', 'download-card-widget'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'default'    => [
                'top'    => 14,
                'right'  => 16,
                'bottom' => 14,
                'left'   => 16,
                'unit'   => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control('content_gap', [
            'label'      => __('Vertical Gap', 'download-card-widget'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => ['min' => 0, 'max' => 40],
            ],
            'default'    => [
                'size' => 12,
                'unit' => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-card' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('card_radius', [
            'label'      => __('Border Radius', 'download-card-widget'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => ['min' => 0, 'max' => 30],
            ],
            'default'    => [
                'size' => 12,
                'unit' => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-card' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_icon_section', [
            'label' => __('Icon', 'download-card-widget'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('icon_bg', [
            'label'     => __('Icon Background', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#0f766e',
            'selectors' => [
                '{{WRAPPER}} .vcw-icon' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('icon_color', [
            'label'     => __('Icon Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .vcw-icon'       => 'color: {{VALUE}};',
                '{{WRAPPER}} .vcw-icon-inner' => 'color: {{VALUE}}; fill: {{VALUE}};',
            ],
        ]);

        $this->add_control('icon_size', [
            'label'      => __('Icon Size', 'download-card-widget'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => ['min' => 10, 'max' => 40],
            ],
            'default'    => [
                'size' => 18,
                'unit' => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-icon-inner' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('icon_box_size', [
            'label'      => __('Icon Box Size', 'download-card-widget'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => ['min' => 30, 'max' => 100],
            ],
            'default'    => [
                'size' => 44,
                'unit' => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('icon_box_radius', [
            'label'      => __('Icon Box Radius', 'download-card-widget'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => ['min' => 0, 'max' => 30],
            ],
            'default'    => [
                'size' => 10,
                'unit' => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('icon_gap', [
            'label'      => __('Icon/Text Gap', 'download-card-widget'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => ['min' => 0, 'max' => 40],
            ],
            'default'    => [
                'size' => 12,
                'unit' => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-row-top' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_text_section', [
            'label' => __('Text & Meta', 'download-card-widget'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('tag_bg', [
            'label'     => __('Tag Background', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#d0f5f0',
            'selectors' => [
                '{{WRAPPER}} .vcw-tag' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('tag_color', [
            'label'     => __('Tag Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#0f766e',
            'selectors' => [
                '{{WRAPPER}} .vcw-tag' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'tag_typo',
            'selector' => '{{WRAPPER}} .vcw-tag',
        ]);

        $this->add_control('duration_color', [
            'label'     => __('Duration Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#6b7280',
            'selectors' => [
                '{{WRAPPER}} .vcw-duration' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'duration_typo',
            'selector' => '{{WRAPPER}} .vcw-duration',
        ]);

        $this->add_control('title_color', [
            'label'     => __('Title Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1f2937',
            'selectors' => [
                '{{WRAPPER}} .vcw-title' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'title_typo',
            'selector' => '{{WRAPPER}} .vcw-title',
        ]);

        $this->add_control('meta_gap', [
            'label'      => __('Meta Gap', 'download-card-widget'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => ['min' => 0, 'max' => 30],
            ],
            'default'    => [
                'size' => 4,
                'unit' => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-meta' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_button_section', [
            'label' => __('Button', 'download-card-widget'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('btn_text_color', [
            'label'     => __('Text Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .vcw-btn' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('btn_bg_color', [
            'label'     => __('Background', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#0f766e',
            'selectors' => [
                '{{WRAPPER}} .vcw-btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('btn_bg_hover', [
            'label'     => __('Hover Background', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#0d5f58',
            'selectors' => [
                '{{WRAPPER}} .vcw-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('btn_border_color', [
            'label'     => __('Border Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .vcw-btn' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('btn_border_width', [
            'label'      => __('Border Width', 'download-card-widget'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => ['min' => 0, 'max' => 10],
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-btn' => 'border-width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('btn_padding', [
            'label'      => __('Padding', 'download-card-widget'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .vcw-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control('btn_radius', [
            'label'      => __('Radius', 'download-card-widget'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => ['min' => 0, 'max' => 30],
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('btn_hover_border', [
            'label'     => __('Hover Border Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .vcw-btn:hover' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('btn_spacing', [
            'label'      => __('Top Spacing', 'download-card-widget'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => ['min' => 0, 'max' => 40],
            ],
            'default'    => [
                'size' => 0,
                'unit' => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .vcw-btn' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $s          = $this->get_settings_for_display();
        $icon       = $s['icon'];
        $tag        = $s['tag_text'];
        $duration   = $s['duration'];
        $title      = $s['title'];
        $btn_text   = $s['button_text'] ?: __('Watch Now', 'download-card-widget');
        $video_url  = isset($s['video_url']['url']) ? $s['video_url']['url'] : '';
        $open_popup = ($s['open_popup'] === 'yes');
        $widget_id  = $this->get_id();

        $link_attrs = '';
        if ($video_url) {
            $link_attrs .= ' href="' . esc_url($video_url) . '"';
            if (!$open_popup) {
                $link_attrs .= ' target="_blank" rel="noopener"';
            } else {
                $link_attrs .= ' data-popup="1" data-video-url="' . esc_url($video_url) . '" data-widget="' . esc_attr($widget_id) . '"';
            }
        } else {
            $link_attrs .= ' href="#"';
        }
        ?>

        <div class="vcw-card" data-widget="<?php echo esc_attr($widget_id); ?>">
            <div class="vcw-row-top">
                <div class="vcw-icon">
                    <?php
                    if (!empty($icon['value'])) {
                        Icons_Manager::render_icon($icon, [
                            'aria-hidden' => 'true',
                            'class'       => 'vcw-icon-inner',
                        ]);
                    }
                    ?>
                </div>
                <div class="vcw-meta">
                    <div class="vcw-meta-line">
                        <?php if ($tag) : ?>
                            <span class="vcw-tag"><?php echo esc_html($tag); ?></span>
                        <?php endif; ?>
                        <?php if ($duration) : ?>
                            <span class="vcw-duration"><?php echo esc_html($duration); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if ($title) : ?>
                        <div class="vcw-title"><?php echo esc_html($title); ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <a class="vcw-btn"<?php echo $link_attrs; ?> role="button">
                <?php echo esc_html($btn_text); ?>
            </a>

            <?php if ($open_popup) : ?>
                <div class="vcw-modal" data-widget="<?php echo esc_attr($widget_id); ?>" hidden>
                    <div class="vcw-modal-backdrop" data-widget="<?php echo esc_attr($widget_id); ?>"></div>
                    <div class="vcw-modal-content">
                        <button type="button" class="vcw-modal-close" aria-label="<?php esc_attr_e('Close', 'download-card-widget'); ?>">&times;</button>
                        <div class="vcw-modal-iframe-wrap">
                            <iframe src="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php
    }
}
