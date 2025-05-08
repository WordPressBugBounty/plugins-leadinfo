<?php

// Deny direct access to plugin files!!
if (!defined('WPINC') || !defined('ABSPATH')) {
    exit;
}


// Init tracker_code update endpoint
add_action('rest_api_init', function () {
    if (!current_user_can('manage_options')) {
        return;
    }

    register_rest_route('/leadinfo/v1', '/tracker_code', array(
        'methods' => 'POST',
        'callback' => 'add_leadinfo_tracker_code',
    ));
});

// Update tracker_code function
function add_leadinfo_tracker_code(array $data): void
{
    if (empty($data['tracker_code']) || !validate_leadinfo_id($data['tracker_code'])) {
        return;
    }

    if (!current_user_can('manage_options')) {
        return;
    }

    update_leadinfo_id($data['tracker_code']);
}