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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'm5Pas7U2}m/~{x&c|0I~h|g{hs|@ CJU<!V0B_Y8q~UtiO]L)ypF,JL`@k8#2QzY');
define('SECURE_AUTH_KEY',  'I=bg 8~ Ho2vNuwA+v[`Q/3&r!(0kXSQmN{e8r6Hmr)IZgxJNeyS#<0VV6%) 9tS');
define('LOGGED_IN_KEY',    's$rQW-!.(wuu3b#HM*@a|$A:as;X]=??JUO0Ys`{ZFbh1g0&jeRd>2_,)GfGO,4&');
define('NONCE_KEY',        '}devqh~3;k3d/8z8r+&_kYOJo|xuF9Tidhfp9f!gF^:2~10a7%~8gWf7iwNQ2g#o');
define('AUTH_SALT',        ']yv]&U},6_S.=5a.:|9 s%Og6Y-vQI{P|l.&JI,Am^1G7Gyr[ (wkezN(/Fm#+!7');
define('SECURE_AUTH_SALT', ')OdB8g =4Ll5Gk|<v*l*Zi)raQ1[9TX>]!x,ijkKRzNsTGs~0T1H.sF;25l1/90}');
define('LOGGED_IN_SALT',   '1r./V;jnF9l>l6P4}W*TI{4Xm8E)Wq$ TF}UdlQA(z8O`(~Gj0%/#-l}?hXDLU,`');
define('NONCE_SALT',       'Za8/2sc%`[sEQ3KZ|[o8meKG%vhji[po~8M/.:EfYy _Sx;DRSVD0Su E ,qs%>n');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
