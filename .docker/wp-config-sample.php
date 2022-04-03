<?php

define('WP_CACHE', true);
define('WPCACHEHOME', '/var/www/html/wp-content/plugins/wp-super-cache/');

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv('WORDPRESS_DB_NAME'));

/** MySQL database username */
define('DB_USER', getenv('WORDPRESS_DB_USERNAME'));

/** MySQL database password */
define('DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', getenv('WORDPRESS_DB_HOST'));

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', 'utf8mb4_general_ci');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in ag$
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         getenv('WORDPRESS_AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('WORDPRESS_SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('WORDPRESS_LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('WORDPRESS_NONCE_KEY'));
define('AUTH_SALT',        getenv('WORDPRESS_AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('WORDPRESS_SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('WORDPRESS_LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('WORDPRESS_NONCE_SALT'));


$table_prefix  = 'wp_';

define('WP_DEBUG', (bool) (int) getenv('WORDPRESS_DEBUG'));
if (WP_DEBUG) {
    define('WP_DEBUG_LOG', WP_DEBUG);
}

define('WPLANG', 'zh_CN');
define('WP_AUTO_UPDATE_CORE', false);

define('WP_REDIS_HOST', getenv('WP_REDIS_HOST'));
define('WP_REDIS_PORT', getenv('WP_REDIS_PORT'));
define('WP_REDIS_PASSWORD', getenv('WP_REDIS_PASSWORD'));
define('WP_REDIS_TIMEOUT', 1);
define('WP_REDIS_READ_TIMEOUT', 8);
define('WP_CACHE_KEY_SALT', 'yaoin_');

define('JWT_AUTH_SECRET_KEY', getenv('WP_REDIS_AUTH_SECRET_KEY'));
define('JWT_AUTH_CORS_ENABLE', true);

define('AUTOSAVE_INTERVAL', 160); // Seconds
define('WP_ALLOW_MULTISITE', true);
define('WP_POST_REVISIONS', 2);
define('WP_MEMORY_LIMIT', '128M');

// If we're behind a proxy server and using HTTPS, we need to alert Wordpress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

/** WordPress目录的绝对路径。 */
if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');

require_once __DIR__ . '/vendor/autoload.php';

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
