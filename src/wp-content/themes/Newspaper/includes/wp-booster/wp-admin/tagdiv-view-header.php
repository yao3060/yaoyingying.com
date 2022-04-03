<?php

global $submenu;

if (isset($submenu['td_theme_welcome'])) {
    $td_welcome_menu_items = $submenu['td_theme_welcome'];
}

$td_theme_desc = '#1 Selling News Theme of All Time';
if ('Newsmag' === TD_THEME_NAME) {
    $td_theme_desc = 'Top Selling Magazine WordPress Theme';
}

if (!empty($td_welcome_menu_items) && is_array($td_welcome_menu_items)) {
    ?>
    <div class="about-wrap td-wp-admin-header ">
        <div class="td-wp-admin-top">
            <img class="td-tagdiv-brand" src="<?php echo get_template_directory_uri() ?>/includes/wp-booster/wp-admin/images/plugins/tagdiv-small.png" />
            <div class="td-wp-admin-theme">
                <h1>Welcome to <?php echo TD_THEME_NAME ?>!</h1>
                <span><?php echo $td_theme_desc ?></span>
            </div>
            <div class="td-welcome-version">Version: <b><?php echo TD_THEME_VERSION ?></b>
            <?php
            if ( defined('TD_COMPOSER' ) ) {
                if (strpos(td_util::get_registration(), chr(42)) > 0) { ?>
                    <span class="td-theme-line"></span><span class="td-theme-key" style="color:#6dc25f">REGISTERED</span>
                <?php } else { ?>
                    <span class="td-theme-line"></span><span class="td-theme-key" style="color:#ff0000">UNREGISTERED</span>
                    <a class="td-wp-admin-button-simple td-wp-admin-button-simple-small" href="admin.php?page=td_cake_panel">Activate now</a>
                <?php }
            }
            ?>
            </div>
        </div>
        <h2 class="nav-tab-wrapper">

            <?php
                foreach ($td_welcome_menu_items as $td_welcome_menu_item) {
                    ?>
                        <a href="admin.php?page=<?php echo esc_attr( $td_welcome_menu_item[2] ) ?>" class="nav-tab <?php if(isset($_GET['page']) and $_GET['page'] == $td_welcome_menu_item[2]) { echo 'nav-tab-active'; }?> "><?php printf( '%1$s', $td_welcome_menu_item[0] ) ?></a>
                    <?php
                }
            ?>
        </h2>
    </div>
    <?php
}

?>


