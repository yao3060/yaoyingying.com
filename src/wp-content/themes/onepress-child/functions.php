<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'onepress-child-style',
        get_stylesheet_uri(),
        array('onepress-style'),
        wp_get_theme()->get('Version') // this only works if you have Version in the style header
    );
});
