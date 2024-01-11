<?php

// Don't load directly.
if (!defined('ABSPATH')) {
    die('-1');
}

add_action('init', function () {
    error_log('app:bootstrap:init');
});
