<?php

// Deny direct access to plugin files!!
if (!defined('WPINC') || !defined('ABSPATH')) {
    exit;
}


if (!class_exists('Leadinfo')) {
    class Leadinfo
    {

        // Insert tracking code
        public static function register_plugin_scripts(): void
        {
            if (is_admin()) {
                return;
            }

            $leadinfo_id = sanitize_html_class(get_option('leadinfo_id'));
            if (!$leadinfo_id) {
                return;
            }

            ?>
            <!-- Leadinfo tracking code -->
            <script> (function (l, e, a, d, i, n, f, o) {
                    if (!l[i]) {
                        l.GlobalLeadinfoNamespace = l.GlobalLeadinfoNamespace || [];
                        l.GlobalLeadinfoNamespace.push(i);
                        l[i] = function () {
                            (l[i].q = l[i].q || []).push(arguments)
                        };
                        l[i].t = l[i].t || n;
                        l[i].q = l[i].q || [];
                        o = e.createElement(a);
                        f = e.getElementsByTagName(a)[0];
                        o.async = 1;
                        o.src = d;
                        f.parentNode.insertBefore(o, f);
                    }
                }(window, document, "script", "https://cdn.leadinfo.net/ping.js", "leadinfo", "<?php echo esc_js($leadinfo_id); ?>")); </script>
            <?php
        }


        // Menu page
        public function plugin_admin_add_page()
        {
            add_submenu_page('options-general.php', "Leadinfo", "Leadinfo", 'manage_options', 'leadinfo', array($this, 'add_settings'));
        }


        public function add_settings()
        {
            $option = 'leadinfo_id';
            $is_saved = false;
            $has_error = false;
            $leadinfo_id = get_option($option);

            if (isset($_GET['save']) && isset($_GET['leadinfo_id']) && check_admin_referer('leadinfo_tracking_form')) {
                if (is_admin() && current_user_can('manage_options')) {
                    if (update_leadinfo_id($_GET['leadinfo_id'])) {
                        $leadinfo_id = $_GET['leadinfo_id'];
                        $is_saved = true;
                    } else {
                        $has_error = true;
                    }
                }
            }

            require_once plugin_dir_path(__FILE__) . 'admin/settings.php';
        }


        public function run()
        {
            add_action('admin_menu', array($this, 'plugin_admin_add_page'));
            add_action('wp_footer', array('Leadinfo', 'register_plugin_scripts'));
        }
    }
}
