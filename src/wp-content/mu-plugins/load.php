<?php
/*
  Plugin Name: YAO MU-Plugins
  Plugin URI: https://www.yaoin.net
  Description: Boilerplate MU-plugin for custom actions and filters to run for a site instead of setting in WP-config.php
  Version: 0.1
  Author: YAO
  Author URI: https://www.yaoin.net
*/

\Sentry\init(['dsn' => 'https://9b8eda057b194ff1a129867cc2e2a132@o1169359.ingest.sentry.io/6262113']);

add_filter('max_srcset_image_width', '__return_false');

add_filter('wp_calculate_image_srcset', '__return_false');

add_filter('wp_get_attachment_image_src', function ($image, $attachment_id, $size, $icon) {
    // 不是阿里云oss
    if (strpos($image[0], 'aliyuncs') === false) {
        return $image;
    }

    // 已经resize
    if (strpos($image[0], 'x-oss-process') !== false) {
        return $image;
    }
    $sizes = [
        sprintf('-%dx%d', $image[1], $image[2]),
        '-60x60',
        '-150x150',
        '-300x300'
    ];
    $image[0] = sprintf(
        '%s?x-oss-process=image/resize,m_%s,h_%d,w_%d',
        str_replace($sizes, '', $image[0]),
        'fill',
        $image[2],
        $image[1]
    );
    return $image;
}, 1, 4);

function onepress_fonts_url()
{
    return esc_url_raw('');
}
