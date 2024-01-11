<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'onepress-child-style',
        get_stylesheet_uri(),
        array('onepress-style'),
        wp_get_theme()->get('Version') // this only works if you have Version in the style header
    );
});

function get_category_names()
{
    $cats = get_the_category();
    if (!$cats) {
        return '';
    }
    $names = \Illuminate\Support\Arr::pluck($cats, 'name');
    echo join(',', $names);
}

add_action('wp_head', function () {
    echo '<meta name="theme-color" content="#ffffff" />';
    echo sprintf('<link rel="manifest" href="%s/assets/js/manifest.json" />', get_stylesheet_directory_uri());
});

add_action('wp_footer', function () {

?>
    <script type="text/javascript">
        // Don't register the service worker
        // until the page has fully loaded
        window.addEventListener('load', () => {
            // Is service worker available?
            if ('serviceWorker' in navigator) {

                navigator.serviceWorker.register('/sw.js').then(() => {
                    console.log('Service worker registered!');
                }).catch((error) => {
                    console.warn('Error registering service worker:');
                    console.warn(error);
                });
            }
        });
    </script>
<?php
});
