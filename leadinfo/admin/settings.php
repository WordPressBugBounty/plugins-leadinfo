<?php

if (!defined('WPINC') || !defined('ABSPATH')) {
    exit;
}


/** @var string $leadinfo_id */
/** @var bool $is_saved */
/** @var bool $has_error */
?>

<div class="wrap">
    <h2>Leadinfo Settings</h2>

    <h4>Plugin Configuration</h4>
    <p>If you don’t have an account yet get one free at
        <a href="https://www.leadinfo.com/?utm_source=wordpress"
           target="_blank">leadinfo.com</a>
    </p>

    <p><b>Configuration Options</b></p>

    <ol>
        <li>Visit your Leadinfo Portal, go to "Settings" and select under ‘Trackers’ the URL of the website you wish to
            track.
        </li>
        <li>Copy your Leadinfo Site ID, starting with LI-xxx.</li>
        <li>Return to WordPress and go to Settings > Leadinfo to paste your Leadinfo Site ID.</li>
    </ol>
    <form action="">
        <?= wp_nonce_field('leadinfo_tracking_form'); ?>
        <input type="hidden" name="page" value="leadinfo">
        <div class="fieldwrap">
            <label class="" for="leadinfo_id">Enter your Leadinfo Site ID here</label><br/>
            <input type="text" name="leadinfo_id" size="80" value="<?= sanitize_html_class($leadinfo_id); ?>"
                   placeholder="LI-1234567890" id="leadinfo_id" spellcheck="false" autocomplete="off"/>

            <?php if ($has_error) : ?>
                <div class="notice notice-error is-dismissible">
                    <p>Incorrect Leadinfo Site ID, please try again.</p>
                </div>
            <?php endif; ?>

            <?php if ($is_saved) : ?>
                <div class="notice notice-success is-dismissible">
                    <p>Site ID saved!</p>
                </div>
            <?php endif; ?>
        </div>
        <br/>
        <div id="action">
            <input name="save" type="submit" class="button button-primary button-large" id="save" accesskey="p"
                   value="Save"/>
        </div>
        <div class="clear"></div>
    </form>
</div>