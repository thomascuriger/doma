<?php
/** 
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_89');

/** MySQL database username */
define('DB_USER', 'wordpress_c0');

/** MySQL database password */
define('DB_PASSWORD', 'gXK!zQ63o9');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'nGq2M5k8RmUggAm*VzEEZ6Xa#h#5P7X3xlzUvsUlFeF8fzqKB*Sr4lsmj@Ls@fAW');
define('SECURE_AUTH_KEY',  'DudyBTI(k!&jDEDuw@zdoNswX74aWCcaR%6ghhzluiTQ&Os^C7KM4l^ITlAvtz!c');
define('LOGGED_IN_KEY',    '7^UOJ9V#s8hjTckHC(*IDzdAh))V%e#ip090Yt3MjSGtnQuQfAX6dmKbFy)zTnpF');
define('NONCE_KEY',        'eB4SZIX3JBKKZ*HLR@2!tbIO6hCB@kWA%^dPWEPs(wRy^kNMqdOLaDBV4c6H0rL1');
define('AUTH_SALT',        'i@0xXBxueiwJqW*E(AAqCj7Xa5jVh6o1kiOJBF8)dSGQauEWtA5Pd2Nj#pTSIiZl');
define('SECURE_AUTH_SALT', 'uWpO09@Z4gwAL@zVGSGns1%Zadw!uFOEf3Aw(^Jq#0@2!qGW8@2Kal#wtio6dDRU');
define('LOGGED_IN_SALT',   'tp7q29o@t7y2YU9Vxh6X&iSKqJjVbYJ6VIqCBpaR()YExlxz04%5NkGQpOQOekq%');
define('NONCE_SALT',       '(5S30i0omu#sFLPdU5xG&YboVczKEmMACLDQz%Y0B(wUfGaLyzgnPGAL#JBhi^5@');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'In9fuaEl9Z_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', 'en_US');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');

//--- disable auto upgrade
define( 'AUTOMATIC_UPDATER_DISABLED', true );
?>
