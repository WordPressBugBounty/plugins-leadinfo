<?php

// Deny direct access to plugin files!!
if (!defined('WPINC') || !defined('ABSPATH')) {
    exit;
}


// Check user rights and update leadinfo_id option in database
function update_leadinfo_id(string $id): bool
{

    if (empty($id) || !validate_leadinfo_id($id)) {
        return false;
    }

    update_option('leadinfo_id', $id);
    return true;
}

// Check if leadinfo_id is valid
function validate_leadinfo_id(string $id): bool
{
    if (empty($id)) {
        return false;
    }

    return preg_match('/^(LI\-)([0-9A-Z]+)$/', $id) !== 0;
}