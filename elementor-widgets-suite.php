<?php
/**
 * Plugin Name: Elementor Widgets Suite
 * Description: A growing set of Elementor widgets (starting with Download Card) with enable/disable controls from the dashboard.
 * Version:     1.0.0
 * Author:      Noman Khaliq
 * Author URI:  https://www.nomankhaliq.dev/
 */

if (!defined('ABSPATH')) {
    exit;
}

// Option key for widget toggles.
const EWS_TOGGLE_OPTION = 'ews_widget_toggles';

/**
 * Get enabled widgets map with safe defaults.
 */
function ews_get_enabled_widgets() {
    $saved = get_option(EWS_TOGGLE_OPTION, []);
    if (!is_array($saved)) {
        $saved = [];
    }

    // Default: our current widget is enabled.
    if (!array_key_exists('download_card_widget', $saved)) {
        $saved['download_card_widget'] = 1;
    }

    return $saved;
}

/**
 * Save enabled widgets map.
 */
function ews_save_enabled_widgets($data) {
    $clean = [];
    foreach ($data as $key => $val) {
        $clean[sanitize_key($key)] = $val ? 1 : 0;
    }
    update_option(EWS_TOGGLE_OPTION, $clean);
}

// Admin menu to toggle widgets.
    add_action('admin_menu', function () {
        $hook = add_menu_page(
            __('Elementor Widgets Suite', 'download-card-widget'),
            __('Elementor Widgets', 'download-card-widget'),
            'manage_options',
        'elementor-widgets-suite',
        'ews_render_admin_page',
        'dashicons-admin-plugins',
        58
    );

    // Enqueue admin styles only on our page.
    add_action('admin_enqueue_scripts', function ($screen) use ($hook) {
        if ($screen !== $hook) {
            return;
        }

        wp_enqueue_style(
            'ews-admin-style',
            plugins_url('assets/ews-admin.css', __FILE__),
            [],
            '1.0.0'
        );

        wp_enqueue_script(
            'ews-admin-script',
            plugins_url('assets/ews-admin.js', __FILE__),
            ['jquery'],
            '1.0.0',
            true
        );
    });
});

/**
 * Render admin page with toggles.
 */
function ews_render_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $widgets = [
        'download_card_widget' => [
            'label' => __('Download Card Widget', 'download-card-widget'),
            'img'   => plugins_url('assets/widget-previews/download-card-widget.png', __FILE__),
            'desc'  => __('Displays a file download card with title, description, auto file type detection, size, and customizable button/icon.', 'download-card-widget'),
        ],
    ];

    // Handle save.
    if (!empty($_POST['ews_nonce']) && wp_verify_nonce($_POST['ews_nonce'], 'ews_save_widgets')) {
        $incoming = isset($_POST['ews_widgets']) ? (array) $_POST['ews_widgets'] : [];
        $state    = [];
        foreach ($widgets as $key => $label) {
            $state[$key] = isset($incoming[$key]) ? 1 : 0;
        }
        ews_save_enabled_widgets($state);
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__('Settings saved.', 'download-card-widget') . '</p></div>';
    }

    $enabled = ews_get_enabled_widgets();
    ?>
    <div class="wrap dcw-admin">
        <h1><?php esc_html_e('Elementor Widgets Suite', 'download-card-widget'); ?></h1>
        <p class="dcw-lead"><?php esc_html_e('Enable only the widgets you need. Disabled widgets will not load on the site.', 'download-card-widget'); ?></p>
        <form method="post">
            <?php wp_nonce_field('ews_save_widgets', 'ews_nonce'); ?>
            <div class="dcw-grid">
                <?php foreach ($widgets as $key => $label) : ?>
                    <?php
                    $is_array = is_array($label);
                    $img      = $is_array ? $label['img'] : '';
                    $title    = $is_array ? $label['label'] : $label;
                    $desc     = $is_array && isset($label['desc']) ? $label['desc'] : '';
                    ?>
                    <div class="dcw-card">
                        <div class="dcw-thumb">
                            <?php if ($img) : ?>
                                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>" />
                            <?php else : ?>
                                <span class="dcw-noimg"><?php esc_html_e('No preview', 'download-card-widget'); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="dcw-row">
                            <div class="dcw-title"><?php echo esc_html($title); ?></div>
                            <p class="dcw-desc">
                                <?php
                                echo $desc
                                    ? esc_html($desc)
                                    : '<span style="color:#9ca3af;">' . esc_html__('No description', 'download-card-widget') . '</span>';
                                ?>
                            </p>
                            <div class="dcw-actions-inline">
                                <label class="dcw-toggle">
                                    <label class="dcw-switch">
                                        <input type="checkbox" name="ews_widgets[<?php echo esc_attr($key); ?>]" value="1" <?php checked(isset($enabled[$key]) ? $enabled[$key] : 0, 1); ?> />
                                        <span class="dcw-slider"></span>
                                    </label>
                                    <span><?php esc_html_e('Enable', 'download-card-widget'); ?></span>
                                </label>

                                <button type="button" class="dcw-ghost-btn" data-dcw-modal data-title="<?php echo esc_attr($title); ?>" data-desc="<?php echo esc_attr($desc); ?>" data-img="<?php echo esc_attr($img); ?>">
                                    <?php esc_html_e('View details', 'download-card-widget'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="dcw-actions">
                <button type="submit" class="button button-primary"><?php esc_html_e('Save Changes', 'download-card-widget'); ?></button>
            </div>
        </form>
    </div>
    <div class="dcw-modal-backdrop" id="dcw-modal">
        <div class="dcw-modal">
            <button type="button" class="dcw-modal-close" aria-label="<?php esc_attr_e('Close', 'download-card-widget'); ?>">&times;</button>
            <h2 id="dcw-modal-title"></h2>
            <div id="dcw-modal-img"></div>
            <p class="dcw-modal-desc" id="dcw-modal-desc"></p>
        </div>
    </div>
    <?php
}

// Register widget (and its CSS)
add_action('plugins_loaded', function () {
    $enabled = ews_get_enabled_widgets();
    if (empty($enabled['download_card_widget'])) {
        return;
    }

    if (did_action('elementor/loaded')) {
        add_action('elementor/widgets/register', function ($widgets_manager) {
            require_once __DIR__ . '/includes/widgets/class-download-card-widget.php';
            $widgets_manager->register(new \Download_Card_Widget());
        });

        // Ensure CSS is registered for Elementor to enqueue per widget.
        add_action('wp_enqueue_scripts', function () {
            wp_register_style(
                'download-card-widget',
                plugins_url('includes/widgets/download-card-widget.css', __FILE__),
                [],
                '1.0.3'
            );
        });
    }
});
