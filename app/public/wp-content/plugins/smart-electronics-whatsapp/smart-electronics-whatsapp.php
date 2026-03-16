<?php
/**
 * Plugin Name: Smart Electronics WhatsApp Chat
 * Plugin URI: https://smart-electronics.com
 * Description: Custom WhatsApp chat button for Smart Electronics WooCommerce store
 * Version: 1.0.0
 * Author: Smart Electronics
 * Author URI: https://smart-electronics.com
 * License: GPL v2 or later
 * Text Domain: smart-electronics-whatsapp
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Smart_Electronics_WhatsApp {

    private static $instance = null;

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_footer', array($this, 'render_whatsapp_button'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function enqueue_scripts() {
        wp_enqueue_style(
            'smart-electronics-whatsapp-style',
            plugins_url('css/style.css', __FILE__),
            array(),
            '1.0.0'
        );

        wp_enqueue_script(
            'smart-electronics-whatsapp-script',
            plugins_url('js/script.js', __FILE__),
            array('jquery'),
            '1.0.0',
            true
        );

        wp_localize_script('smart-electronics-whatsapp-script', 'smartElectronicsWhatsApp', array(
            'phoneNumber' => get_option('sewhatsapp_phone_number', ''),
            ' defaultMessage' => get_option('sewhatsapp_default_message', 'Hi! I need help with my order.'),
            'position' => get_option('sewhatsapp_button_position', 'bottom-right'),
            'showOnProducts' => get_option('sewhatsapp_show_products', '1') === '1',
            'showOnHomePage' => get_option('sewhatsapp_show_home', '1') === '1',
        ));
    }

    public function render_whatsapp_button() {
        $phone_number = get_option('sewhatsapp_phone_number', '');

        if (empty($phone_number)) {
            return; // Don't show if no phone number is configured
        }

        $button_text = get_option('sewhatsapp_button_text', 'Chat with us');
        $position = get_option('sewhatsapp_button_position', 'bottom-right');
        $show_on_products = get_option('sewhatsapp_show_products', '1') === '1';
        $show_on_home = get_option('sewhatsapp_show_home', '1') === '1';

        // Check display conditions
        $should_show = true;

        if (is_product() && !$show_on_products) {
            $should_show = false;
        }

        if (is_front_page() && !$show_on_home) {
            $should_show = false;
        }

        if (!$should_show) {
            return;
        }

        // Get current product info if on product page
        $product_info = '';
        if (function_exists('is_product') && is_product()) {
            global $product;
            if ($product) {
                $product_name = $product->get_name();
                $product_info = " - {$product_name}";
            }
        }

        ?>
        <div id="smart-electronics-whatsapp-container" class="sewhatsapp-position-<?php echo esc_attr($position); ?>">
            <div class="sewhatsapp-button-wrapper">
                <a href="https://wa.me/<?php echo esc_attr($phone_number); ?>?text=<?php echo urlencode(get_option('sewhatsapp_default_message', 'Hi! I need help.') . $product_info); ?>"
                   class="sewhatsapp-button"
                   target="_blank"
                   rel="noopener noreferrer">
                    <svg class="sewhatsapp-icon" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 2C8.268 2 2 8.268 2 16c0 2.657.645 5.162 1.779 7.365L2.293 29.707l6.386-1.676C10.78 28.754 13.316 29.453 16 29.453c7.732 0 14-6.268 14-14S23.732 2 16 2zm0 25.453c-2.319 0-4.508-.665-6.389-1.812l-.458-.273-3.777.992.992-3.777-.273-.458C5.045 20.051 4.375 17.862 4.375 15.543c0-6.393 5.203-11.596 11.596-11.596s11.596 5.203 11.596 11.596-5.203 11.41-11.596 11.41z"/>
                        <path d="M21.707 19.543c-.273-.137-1.621-.801-1.875-.896-.254-.095-.438-.137-.621.137-.184.273-.713.896-.877 1.079-.164.184-.328.207-.602.069-1.34-.67-2.488-1.484-3.422-2.883-.258-.387-.025-.596.135-.754.139-.137.305-.357.457-.535.059-.068.119-.137.166-.205.082-.115.109-.221.164-.328.055-.109.027-.205-.014-.293-.041-.087-.621-1.5-.852-2.055-.225-.541-.453-.467-.621-.475-.152-.008-.326-.01-.5-.01-.174 0-.457.064-.695.328-.238.264-.912.891-.912 2.176 0 1.285.936 2.527 1.066 2.709.131.182 1.842 2.813 4.463 3.943.621.268 1.107.428 1.486.549.629.201 1.201.172 1.654.104.506-.074 1.621-.662 1.848-1.301.227-.639.227-1.186.16-1.301-.068-.115-.252-.23-.525-.367z"/>
                    </svg>
                    <span class="sewhatsapp-button-text"><?php echo esc_html($button_text); ?></span>
                </a>
            </div>
            <?php if (get_option('sewhatsapp_show_bubble', '1') === '1'): ?>
            <div class="sewhatsapp-bubble">
                <div class="sewhatsapp-bubble-content">
                    <?php echo esc_html(get_option('sewhatsapp_bubble_text', 'Need help? Chat with us!')); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }

    public function add_admin_menu() {
        add_options_page(
            'Smart Electronics WhatsApp',
            'Smart Electronics WhatsApp',
            'manage_options',
            'smart-electronics-whatsapp',
            array($this, 'settings_page')
        );
    }

    public function register_settings() {
        register_setting('smart_electronics_whatsapp_settings', 'sewhatsapp_phone_number');
        register_setting('smart_electronics_whatsapp_settings', 'sewhatsapp_default_message');
        register_setting('smart_electronics_whatsapp_settings', 'sewhatsapp_button_text');
        register_setting('smart_electronics_whatsapp_settings', 'sewhatsapp_button_position');
        register_setting('smart_electronics_whatsapp_settings', 'sewhatsapp_show_products');
        register_setting('smart_electronics_whatsapp_settings', 'sewhatsapp_show_home');
        register_setting('smart_electronics_whatsapp_settings', 'sewhatsapp_show_bubble');
        register_setting('smart_electronics_whatsapp_settings', 'sewhatsapp_bubble_text');
        register_setting('smart_electronics_whatsapp_settings', 'sewhatsapp_button_color');
        register_setting('smart_electronics_whatsapp_settings', 'sewhatsapp_text_color');
    }

    public function settings_page() {
        ?>
        <div class="wrap">
            <h1>Smart Electronics WhatsApp Chat Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('smart_electronics_whatsapp_settings');
                do_settings_sections('smart_electronics_whatsapp_settings');
                ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">WhatsApp Phone Number</th>
                        <td>
                            <input type="text"
                                   name="sewhatsapp_phone_number"
                                   value="<?php echo esc_attr(get_option('sewhatsapp_phone_number', '')); ?>"
                                   class="regular-text"
                                   placeholder="1234567890">
                            <p class="description">Enter your WhatsApp business number (with country code, no spaces or dashes)</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Default Message</th>
                        <td>
                            <input type="text"
                                   name="sewhatsapp_default_message"
                                   value="<?php echo esc_attr(get_option('sewhatsapp_default_message', 'Hi! I need help with my order.')); ?>"
                                   class="regular-text">
                            <p class="description">Pre-filled message when customers click the button</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Button Text</th>
                        <td>
                            <input type="text"
                                   name="sewhatsapp_button_text"
                                   value="<?php echo esc_attr(get_option('sewhatsapp_button_text', 'Chat with us')); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Button Position</th>
                        <td>
                            <select name="sewhatsapp_button_position">
                                <option value="bottom-right" <?php selected(get_option('sewhatsapp_button_position', 'bottom-right'), 'bottom-right'); ?>>Bottom Right</option>
                                <option value="bottom-left" <?php selected(get_option('sewhatsapp_button_position', 'bottom-right'), 'bottom-left'); ?>>Bottom Left</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Display Options</th>
                        <td>
                            <label>
                                <input type="checkbox"
                                       name="sewhatsapp_show_products"
                                       value="1"
                                       <?php checked(get_option('sewhatsapp_show_products', '1'), '1'); ?>>
                                Show on product pages
                            </label>
                            <br>
                            <label>
                                <input type="checkbox"
                                       name="sewhatsapp_show_home"
                                       value="1"
                                       <?php checked(get_option('sewhatsapp_show_home', '1'), '1'); ?>>
                                Show on home page
                            </label>
                            <br>
                            <label>
                                <input type="checkbox"
                                       name="sewhatsapp_show_bubble"
                                       value="1"
                                       <?php checked(get_option('sewhatsapp_show_bubble', '1'), '1'); ?>>
                                Show greeting bubble
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Bubble Text</th>
                        <td>
                            <input type="text"
                                   name="sewhatsapp_bubble_text"
                                   value="<?php echo esc_attr(get_option('sewhatsapp_bubble_text', 'Need help? Chat with us!')); ?>"
                                   class="regular-text">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Button Color</th>
                        <td>
                            <input type="color"
                                   name="sewhatsapp_button_color"
                                   value="<?php echo esc_attr(get_option('sewhatsapp_button_color', '#25D366')); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Text Color</th>
                        <td>
                            <input type="color"
                                   name="sewhatsapp_text_color"
                                   value="<?php echo esc_attr(get_option('sewhatsapp_text_color', '#FFFFFF')); ?>">
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}

// Initialize the plugin
function smart_electronics_whatsapp_init() {
    return Smart_Electronics_WhatsApp::get_instance();
}
add_action('plugins_loaded', 'smart_electronics_whatsapp_init');