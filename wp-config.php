<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/mtcmarke/shopzozo.com/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'mtcmarke_zozo');

/** MySQL database username */
define('DB_USER', 'mtcmarke_zozo');

/** MySQL database password */
define('DB_PASSWORD', 'DbS47p)56-');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'p3y8opkv5badzizuqwdzhqe0nojoyxgbkauyqjolvcm3jhnqbd8hbdbfcmd564zc');
define('SECURE_AUTH_KEY',  'vahjlddabcyhqakpbdc14tsfbvuhvbstncpknoxyvk9z0hrb4ehdyhwhrlau6zio');
define('LOGGED_IN_KEY',    'elkwhalrcqbyqnpodrvih0htxeboyjkt554el7yq4djotwof7j9xbdmtmnhhj02f');
define('NONCE_KEY',        '3u4opcunklqt8x6rfluwbyeettgevxkg0ub19pf11wizxtqdcluk0jxxtq5gvr8g');
define('AUTH_SALT',        '2s5haxazlmgbxbg51m5gh2hyesmqr8ygec7p3s0zxhf3cslrfqzciyxgzbihd802');
define('SECURE_AUTH_SALT', '4nhsnmzmqlpyweogvcb27bbpvf1wljufos7tsiada9obwicvbnx3r2gchbj7t97g');
define('LOGGED_IN_SALT',   'byjitozjphq1ntcmc9ixp1z6grt5swokznr28uptybvxieueda5p0istaaiacgts');
define('NONCE_SALT',       'dpdq5meekdnwtmkys7hfjr7elwifkbbm87hulakx7v6s0xfit4wvnqun6tcfexkr');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpuj_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
