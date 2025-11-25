<?php

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;

class Download_Card_Widget extends Widget_Base {

    public function get_name() {
        return 'download_card_widget';
    }

    public function get_title() {
        return __('Download Card', 'download-card-widget');
    }

    public function get_icon() {
        return 'eicon-download-bold';
    }

    public function get_style_depends() {
        return ['download-card-widget'];
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {

        // --- CONTENT SECTION ---
        $this->start_controls_section('content_section', [
            'label' => __('Content', 'download-card-widget'),
        ]);

        $this->add_control('title', [
            'label'       => __('Title', 'download-card-widget'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Product Guidelines', 'download-card-widget'),
            'label_block' => true,
        ]);

        $this->add_control('description', [
            'label'       => __('Description', 'download-card-widget'),
            'type'        => Controls_Manager::TEXTAREA,
            'default'     => __('Complete guidelines for all mortgage products.', 'download-card-widget'),
            'rows'        => 3,
            'label_block' => true,
        ]);

        $this->add_control('file', [
            'label'       => __('Select File', 'download-card-widget'),
            'type'        => Controls_Manager::MEDIA,
            'dynamic'     => ['active' => true],
            'media_types' => ['application', 'text', 'image'],
        ]);

        $this->add_control('icon', [
            'label'   => __('Icon', 'download-card-widget'),
            'type'    => Controls_Manager::ICONS,
            'default' => [
                'value'   => 'fas fa-file-alt',
                'library' => 'fa-solid',
            ],
        ]);

        $this->add_control('button_text', [
            'label'       => __('Button Text', 'download-card-widget'),
            'type'        => Controls_Manager::TEXT,
            'default'     => __('Download', 'download-card-widget'),
            'placeholder' => __('Download', 'download-card-widget'),
        ]);

        $this->add_control('button_icon', [
            'label'   => __('Button Icon', 'download-card-widget'),
            'type'    => Controls_Manager::ICONS,
            'default' => [
                'value'   => 'fas fa-download',
                'library' => 'fa-solid',
            ],
        ]);

        $this->end_controls_section();

        // --- STYLE: CARD ---
        $this->start_controls_section('style_card_section', [
            'label' => __('Card Container', 'download-card-widget'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('card_padding', [
            'label'      => __('Padding', 'download-card-widget'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'default'    => [
                'top'    => 24,
                'right'  => 24,
                'bottom' => 24,
                'left'   => 24,
                'unit'   => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .dc-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'card_border',
            'selector' => '{{WRAPPER}} .dc-card',
        ]);

        $this->add_responsive_control('card_radius', [
            'label'      => __('Border Radius', 'download-card-widget'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'default'    => [
                'top'    => 16,
                'right'  => 16,
                'bottom' => 16,
                'left'   => 16,
                'unit'   => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .dc-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Background::get_type(), [
            'name'     => 'card_background',
            'label'    => __('Background', 'download-card-widget'),
            'types'    => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .dc-card',
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name'     => 'card_shadow',
            'selector' => '{{WRAPPER}} .dc-card',
        ]);

        $this->add_control('glassmorphism_heading', [
            'label' => __('Glassmorphism', 'download-card-widget'),
            'type'  => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->add_control('glass_blur', [
            'label' => __('Backdrop Blur (px)', 'download-card-widget'),
            'type'  => Controls_Manager::SLIDER,
            'range' => [
                'px' => ['min' => 0, 'max' => 50],
            ],
            'selectors' => [
                '{{WRAPPER}} .dc-card' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px);',
            ],
        ]);

        $this->end_controls_section();

        // --- STYLE: ICON ---
        $this->start_controls_section('style_icon_section', [
            'label' => __('Icon', 'download-card-widget'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('icon_size', [
            'label' => __('Box Size', 'download-card-widget'),
            'type'  => Controls_Manager::SLIDER,
            'range' => [
                'px' => ['min' => 30, 'max' => 100],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 56,
            ],
            'selectors' => [
                '{{WRAPPER}} .dc-icon' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
            ],
        ]);

        $this->add_responsive_control('icon_inner_size', [
            'label' => __('Icon Size', 'download-card-widget'),
            'type'  => Controls_Manager::SLIDER,
            'range' => [
                'px' => ['min' => 10, 'max' => 50],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 28,
            ],
            'selectors' => [
                '{{WRAPPER}} .dc-icon-inner' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important; font-size: {{SIZE}}{{UNIT}} !important;',
            ],
        ]);

        $this->add_control('icon_color', [
            'label' => __('Color', 'download-card-widget'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dc-icon' => 'color: {{VALUE}};',
                '{{WRAPPER}} .dc-icon-inner' => 'color: {{VALUE}}; fill: {{VALUE}};',
                '{{WRAPPER}} .dc-icon-fallback' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('icon_bg_color', [
            'label' => __('Background Color', 'download-card-widget'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dc-icon' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name' => 'icon_border',
            'selector' => '{{WRAPPER}} .dc-icon',
        ]);

        $this->add_control('icon_border_radius', [
            'label' => __( 'Border Radius', 'download-card-widget' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .dc-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // --- STYLE: TEXT ---
        $this->start_controls_section('style_text_section', [
            'label' => __('Text Content', 'download-card-widget'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('title_color', [
            'label'     => __('Title Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#1f2937',
            'selectors' => [
                '{{WRAPPER}} .dc-title' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'title_typo',
            'selector' => '{{WRAPPER}} .dc-title',
        ]);

        $this->add_control('desc_color', [
            'label'     => __('Description Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#4b5563',
            'selectors' => [
                '{{WRAPPER}} .dc-desc' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'desc_typo',
            'selector' => '{{WRAPPER}} .dc-desc',
        ]);

        $this->add_control('meta_color', [
            'label'     => __('Meta Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#9ca3af',
            'selectors' => [
                '{{WRAPPER}} .dc-meta' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'meta_typo',
            'selector' => '{{WRAPPER}} .dc-meta',
        ]);

        $this->end_controls_section();

        // --- STYLE: BUTTON ---
        $this->start_controls_section('style_button_section', [
            'label' => __('Button', 'download-card-widget'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->start_controls_tabs('tabs_button_style');

        // NORMAL STATE
        $this->start_controls_tab('tab_button_normal', [
            'label' => __('Normal', 'download-card-widget'),
        ]);

        $this->add_control('btn_text_color', [
            'label'     => __('Text Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#0f766e',
            'selectors' => [
                '{{WRAPPER}} .dc-download' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Background::get_type(), [
            'name'     => 'btn_background',
            'label'    => __('Background', 'download-card-widget'),
            'types'    => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .dc-download',
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'btn_border',
            'selector' => '{{WRAPPER}} .dc-download',
        ]);

        $this->add_control('btn_radius', [
            'label'      => __('Border Radius', 'download-card-widget'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'default'    => [
                'top'    => 8,
                'right'  => 8,
                'bottom' => 8,
                'left'   => 8,
                'unit'   => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .dc-download' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control('btn_padding', [
            'label'      => __('Padding', 'download-card-widget'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em'],
            'default'    => [
                'top'    => 10,
                'right'  => 20,
                'bottom' => 10,
                'left'   => 20,
                'unit'   => 'px',
            ],
            'selectors'  => [
                '{{WRAPPER}} .dc-download' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control('btn_icon_heading', [
            'label' => __('Icon', 'download-card-widget'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->add_control('btn_icon_color', [
            'label'     => __('Icon Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dc-download-icon' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('btn_icon_size', [
            'label' => __('Icon Size', 'download-card-widget'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => ['min' => 10, 'max' => 50],
            ],
            'selectors' => [
                '{{WRAPPER}} .dc-download-icon' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_tab();

        // HOVER STATE
        $this->start_controls_tab('tab_button_hover', [
            'label' => __('Hover', 'download-card-widget'),
        ]);

        $this->add_control('btn_hover_text_color', [
            'label'     => __('Text Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .dc-download:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Background::get_type(), [
            'name'     => 'btn_hover_background',
            'label'    => __('Background', 'download-card-widget'),
            'types'    => ['classic', 'gradient'],
            'selector' => '{{WRAPPER}} .dc-download:hover',
        ]);

        $this->add_control('btn_hover_border_color', [
            'label'     => __('Border Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dc-download:hover' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name'     => 'btn_hover_shadow',
            'selector' => '{{WRAPPER}} .dc-download:hover',
        ]);

        $this->add_control('btn_hover_icon_color', [
            'label'     => __('Icon Color', 'download-card-widget'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .dc-download:hover .dc-download-icon' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();

        $title    = $s['title'];
        $desc     = $s['description'];
        $file     = $s['file'];
        $icon     = $s['icon'];
        $btn_icon = $s['button_icon'];
        $btn_text = $s['button_text'] ?: __('Download', 'download-card-widget');

        if (empty($file['url'])) {
            echo '<div class="dc-empty">' . esc_html__('Please select a file to download.', 'download-card-widget') . '</div>';
            return;
        }

        $file_url = $file['url'];
        $file_id  = attachment_url_to_postid($file_url);
        $ext      = strtoupper(pathinfo($file_url, PATHINFO_EXTENSION));

        $size = '';
        if ($file_id) {
            $path = get_attached_file($file_id);
            if ($path && file_exists($path)) {
                $size = size_format(filesize($path));
            }
        }

        // Default icon classes if no custom icon is set
        $icon_class = 'dc-icon-generic';
        if ($ext === 'PDF') $icon_class = 'dc-icon-pdf';
        elseif (in_array($ext, ['XLS', 'XLSX'])) $icon_class = 'dc-icon-excel';
        elseif (in_array($ext, ['DOC', 'DOCX'])) $icon_class = 'dc-icon-word';

        $this->add_render_attribute('card', 'class', 'dc-card');
        $this->add_render_attribute('download_link', [
            'class' => 'dc-download',
            'href'  => esc_url($file_url),
            'download' => '',
            'aria-label' => sprintf(__('Download %s', 'download-card-widget'), $title),
        ]);
        ?>

        <div <?php $this->print_render_attribute_string('card'); ?>>
            <div class="dc-header">
                <div class="dc-icon <?php echo esc_attr($icon_class); ?>">
                    <?php
                    if (!empty($icon['value'])) {
                        Icons_Manager::render_icon($icon, [
                            'aria-hidden' => 'true',
                            'class'       => 'dc-icon-inner',
                        ]);
                    } else {
                        echo '<span class="dc-icon-inner dc-icon-fallback">' . esc_html($ext) . '</span>';
                    }
                    ?>
                </div>

                <div class="dc-info">
                    <?php if ($title) : ?>
                        <h3 class="dc-title"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>
                    
                    <?php if ($desc) : ?>
                        <p class="dc-desc"><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>

                    <div class="dc-meta">
                        <span class="dc-meta-ext"><?php echo esc_html($ext); ?></span>
                        <?php if ($size) : ?>
                            <span class="dc-dot">&bull;</span>
                            <span class="dc-meta-size"><?php echo esc_html($size); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <a <?php $this->print_render_attribute_string('download_link'); ?>>
                <?php
                if (!empty($btn_icon['value'])) {
                    Icons_Manager::render_icon($btn_icon, [
                        'aria-hidden' => 'true',
                        'class'       => 'dc-download-icon',
                    ]);
                }
                ?>
                <span class="dc-download-text"><?php echo esc_html($btn_text); ?></span>
            </a>
        </div>

        <?php
    }
}
