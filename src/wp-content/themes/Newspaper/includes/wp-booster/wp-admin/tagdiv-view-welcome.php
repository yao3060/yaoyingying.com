<?php
require_once TAGDIV_ROOT_DIR . "/includes/wp-booster/wp-admin/tagdiv-view-header.php";

$td_theme_buy_link = 'https://themeforest.net/item/newspaper/5489609?utm_source=NP_theme_panel&utm_medium=click&utm_campaign=cta&utm_content=buynew';
if ('Newsmag' == TD_THEME_NAME) {
    $td_theme_buy_link = 'https://themeforest.net/item/newsmag-news-magazine-newspaper/9512331?utm_source=NM_theme_panel&utm_medium=click&utm_campaign=cta&utm_content=buynew';
}
?>
<div class="td-admin-wrap about-wrap td-wp-admin-welcome">
    <div class="td-welcome-content">
        <h1>Fast Start Your Website</h1>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path d="M14.009,6.786a0.727,0.727,0,0,0-.585-0.232,0.848,0.848,0,0,0-.586.268l-3.96,4.286V0.857A0.842,0.842,0,0,0,8.636.25,0.783,0.783,0,0,0,8.051,0h-1.1a0.783,0.783,0,0,0-.585.25,0.842,0.842,0,0,0-.241.607v10.25L2.162,6.821a0.847,0.847,0,0,0-.585-0.268,0.727,0.727,0,0,0-.585.232l-0.758.821a0.885,0.885,0,0,0,0,1.214L6.915,15.75a0.811,0.811,0,0,0,1.171,0l6.681-6.929a0.885,0.885,0,0,0,0-1.214Z"/></svg>

        <?php
        $theme_setup = tagdiv_theme_plugins_setup::get_instance();
        $theme_setup->theme_plugins();
        ?>


        <?php
        if ( defined('TD_COMPOSER' ) ) { ?>
            <div class="td-wp-admin-step-demos">
            <?php
                $td_demo = td_demo_state::get_installed_demo();
                if ($td_demo !== false) {
                    $td_demo_api_data = td_global::$demo_list[$td_demo['demo_id']];
                    $td_demo_img = 'https://demo.tagdiv.com/select_demo/images/' . strtolower(TD_THEME_NAME) . '/demos/' . $td_demo['demo_id'] . '.jpg';
                    ?>
                    <div class="td-wp-admin-websites td-tagdiv-current-demo">
                        <h2>2. Prebuilt Website Installed:</h2>
                        <p class="about-description"><?php echo $td_demo_api_data['text'] ?></p>
                        <svg class="td-wp-admin-ok-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#6dc25f" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>
                        <a class="td-wp-admin-button-simple" href="admin.php?page=td_theme_demos">Other Prebuilt Websites</a>
                    </div>
                    <img class="td-tagdiv-demos td-tagdiv-current-demo-img td-demo-img-right" src="<?php echo $td_demo_img ?>" width="311" height="350" />
                    <img class="td-tagdiv-demos td-tagdiv-current-demo-img td-demo-img-left" src="<?php echo $td_demo_img ?>" width="311" height="350" />
                <?php } else { ?>
                    <div class="td-wp-admin-websites">
                        <h2>2. Choose to Install a Prebuilt Website</h2>
                        <p class="about-description">Dozens of Ready-to-use Prebuilt Websites are waiting you. Build your site in minutes! </p>
                        <a class="td-wp-admin-button" href="admin.php?page=td_theme_demos">Prebuilt Websites</a>
                    </div>
                    <img class="td-tagdiv-demos" src="<?php echo get_template_directory_uri() ?>/includes/wp-booster/wp-admin/images/plugins/<?php echo TD_THEME_NAME ?>.png" />
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <div class="td-welcome-sidebar">
        <div class="td-welcome-widget td-widget-system-status">
            <h2>System Status</h2>
            <?php
            $phpversion = PHP_VERSION;
            $memory_limit_bytes = wp_convert_hr_to_bytes(WP_MEMORY_LIMIT);
            $memory_limit = size_format($memory_limit_bytes);
            $max_input_vars = ini_get('max_input_vars');
            $max_execution_time = ini_get('max_execution_time');
            ?>
            <!-- PHP Version -->
            <div class="td-wp-admin-status">
                <span class="td-system-desc">PHP Version</span>
                <?php if (version_compare( $phpversion, '7.0' ) >= 0) { ?>
                    <span class="td-system-green td-system-svg-icon"></span>
                    <span class="td-system-value"><?php echo esc_html($phpversion); ?><br></span>
                <?php } else { ?>
                    <span class="td-system-yellow td-system-svg-icon"></span>
                    <span class="td-system-value"><?php echo esc_html($phpversion); ?><br></span>
                    <span class="td-system-error">&rBarr; You should use PHP 7 (recommended: PHP 7.2.2 or above).</span>
                <?php } ?>
            </div>
            <!-- PHP Memory Limit -->
            <div class="td-wp-admin-status">
                <span class="td-system-desc">WP Memory Limit</span>
                <?php if ($memory_limit_bytes >= 268435456) { ?>
                    <span class="td-system-green td-system-svg-icon"></span>
                    <span class="td-system-value"><?php echo esc_html($memory_limit); ?><br></span>
                <?php } else { ?>
                    <span class="td-system-yellow td-system-svg-icon"></span>
                    <span class="td-system-value"><?php echo esc_html($memory_limit); ?><br></span>
                    <span class="td-system-error">&rBarr; We recommend memory to at least <b>256 MB</b>. <a target="_blank" href="https://wordpress.org/support/article/editing-wp-config-php/#increasing-memory-allocated-to-php">Read more</a></span>
                <?php } ?>
            </div>
            <!-- PHP Execution Time -->
            <div class="td-wp-admin-status">
                <span class="td-system-desc">PHP Execution Time</span>
                <?php if ($max_execution_time == 0 or $max_execution_time >= 60) { ?>
                    <span class="td-system-green td-system-svg-icon"></span>
                    <span class="td-system-value"><?php echo esc_html($max_execution_time); ?><br></span>
                <?php } else { ?>
                    <span class="td-system-yellow td-system-svg-icon"></span>
                    <span class="td-system-value"><?php echo esc_html($max_execution_time); ?><br></span>
                    <span class="td-system-error">&rBarr; We recommend to increase this value to <b>60</b> or more. <a target="_blank" href="http://forum.tagdiv.com/system-status-parameters-guide/">Read more</a></span>
                <?php } ?>
            </div>
            <!-- PHP Max Input Vars -->
            <div class="td-wp-admin-status">
                <span class="td-system-desc">PHP Max Input Vars</span>
                <?php if ($max_input_vars == 0 or $max_input_vars >= 2000) { ?>
                    <span class="td-system-green td-system-svg-icon"></span>
                    <span class="td-system-value"><?php echo esc_html($max_input_vars); ?><br></span>
                <?php } else { ?>
                    <span class="td-system-yellow td-system-svg-icon"></span>
                    <span class="td-system-value"><?php echo esc_html($max_input_vars); ?><br></span>
                    <span class="td-system-error">&rBarr; We recommend to increase this value to <b>2000</b> or more. <a target="_blank" href="http://forum.tagdiv.com/system-status-parameters-guide/">Read more</a></span>
                <?php } ?>
            </div>
            <?php if ( defined('TD_COMPOSER' ) ) { ?>
                <a class="td-wp-admin-button-simple" href="admin.php?page=td_system_status">Full System Status</a>
            <?php } ?>
        </div>
        <div class="td-welcome-widget">
            <h2>Buy Another License</h2>
            <p class="about-description">If you do not have a license or you need a new one for your next project, you can easily get one.</p>
            <a class="td-wp-admin-button-simple" target="_blank" href="<?php echo $td_theme_buy_link ?>">Purchase License Now</a>
        </div>
        <div class="td-welcome-widget td-cloud-library-widget" <?php if ( !defined('TD_COMPOSER' ) || !defined( 'TD_CLOUD_LIBRARY' ) || TD_THEME_NAME != 'Newspaper' ) echo 'style="display:none"' ?>>
            <h2>tagDiv Cloud Library</h2>
            <p class="about-description">Quickly improve your beautiful website. Over 1350+ One-Click, ready-to-download Templates & Elements are waiting for you.</p>
            <a class="td-wp-admin-button-simple td-open-cloud-library" href="#">Access Library</a>
        </div>
    </div>
</div>
