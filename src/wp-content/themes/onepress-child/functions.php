<?php

function yaoin_get_post_thumbnail(): string
{
    $default = '<img alt="" src="' . get_template_directory_uri() . '/assets/images/placholder2.png' . '">';

    if (has_post_thumbnail()) {
        // ?x-oss-process=image/resize,m_fill,h_150,w_300
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        if ($thumbnail) {
            return sprintf('<img class="wp-post-image" alt="" src="%s?x-oss-process=image/resize,m_%s,h_%d,w_%d" />', $thumbnail[0], 'fill', 150, 300);
        } else {
            return $default;
        }
    } else {
        return $default;
    }
}
