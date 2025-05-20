<?php
/**
 * Plugin Name: Leadinfo
 * Plugin URI: https://wordpress.org/plugins/leadinfo/
 * Description: Leadinfo Plugin
 * Version: 2.1.4
 * Author: Leadinfo
 * Author URI: https://www.leadinfo.com/
 * Copyright 2018
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


// Deny direct access to plugin files!!
if (!defined('WPINC') || !defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'leadinfo.class.php';
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/api/rest.php';


$pluginName = plugin_basename(__FILE__);


$leadinfo = new Leadinfo();
$leadinfo->run();


// Register plugin activation hook
register_activation_hook(__FILE__, 'leadinfo_activate');
function leadinfo_activate()
{
    add_option('leadinfo_id', '', '', 'yes');
}

// Register plugin deactivation hook
register_deactivation_hook(__FILE__, 'leadinfo_deactivate');
function leadinfo_deactivate()
{
    delete_option('leadinfo_id');
}

// Register plugin uninstall hook
register_uninstall_hook(__FILE__, 'leadinfo_uninstall');
function leadinfo_uninstall()
{
    delete_option('leadinfo_id');
}


// Generate settings link in menu
add_filter("plugin_action_links_" . $pluginName, 'leadinfo_settings_link');
function leadinfo_settings_link($links)
{
    $settings_link = '<a href=' . admin_url("admin.php?page=leadinfo>Settings") . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}