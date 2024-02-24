<?php
/*
  Plugin Name: YAO MU-Plugins
  Plugin URI: https://www.yaoin.net
  Description: Boilerplate MU-plugin for custom actions and filters to run for a site instead of setting in WP-config.php
  Version: 0.1
  Author: YAO
  Author URI: https://www.yaoin.net
*/

require_once WPMU_PLUGIN_DIR . '/rest-api/index.php';

function onepress_fonts_url()
{
    return esc_url_raw('');
}

add_filter('max_srcset_image_width', '__return_false');

add_filter('wp_calculate_image_srcset', '__return_false');

function yyy_wp_get_attachment_image_src($image, $attachment_id, $size, $icon)
{

    // 不是阿里云oss
    if (strpos($image[0], 'aliyuncs') === false) {
        return $image;
    }

    $attachment_url = wp_get_attachment_url($attachment_id);

    // 已经resize
    if (strpos($attachment_url, 'x-oss-process') !== false) {
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
        $attachment_url,
        'fill',
        $image[2],
        $image[1]
    );
    return $image;
}

add_filter('wp_get_attachment_image_src', 'yyy_wp_get_attachment_image_src', 1, 4);

function yyy_wp_prepare_attachment_for_js($post, $attachment, $meta)
{
    $full_url = $post['url'];

    $sizes = $post['sizes'];

    foreach ($sizes as $key => $size) {
        if (strpos($size['url'], 'aliyuncs') === false) {
            continue;
        }
        // 已经resize
        if (strpos($size['url'], 'x-oss-process') !== false) {
            continue;
        }

        $sizes[$key]['url'] = sprintf(
            '%s?x-oss-process=image/resize,m_%s,h_%d,w_%d',
            $full_url,
            'fill',
            $size['height'],
            $size['width']
        );
    }

    $post['sizes'] = $sizes;

    return $post;
}
add_filter('wp_prepare_attachment_for_js', 'yyy_wp_prepare_attachment_for_js', 10, 3);
