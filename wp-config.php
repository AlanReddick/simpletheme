<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpresstheme');

/** MySQL database username */
define('DB_USER', 'rooting');

/** MySQL database password */
define('DB_PASSWORD', 'Akcidder9');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'L`88INJ *+ az/*;4ZF?jmO/7~>5p=>IE=)D#|]T-FqHBz=;=+M5F&o<Ue]m]5tn');
define('SECURE_AUTH_KEY',  '&1Rpm;ThO!VwZ(d1=.Rf*pP&<9kswqcGO1)(#P+iU5ni^4b*f]dap=`SwV;jW9P*');
define('LOGGED_IN_KEY',    'Hfm[Q&IpF|)$;LV`p|,$ik4#Z.umO?-y%Wu`?9CnC?ouq}qn+^B0[Muhv5$126um');
define('NONCE_KEY',        '7{~ijQcX~mbh[E`*OLdOE}P=2)D!xXrN#+k_6l}9 B0V%J$mg+7Y7A:~YH+zpI9~');
define('AUTH_SALT',        'XO_Wz+c{IR$t$SC4:ioZn;:$;h+PwA{_^F+MoDHf!G+&kB.}9Ch.jtG&2Q@_q3t4');
define('SECURE_AUTH_SALT', 'AmQU!8UIq0Qq.,g%Cd]N^Qm!&k]csTj (hWL-s/A]T+OMw-+!cronr25&Y]}x)y$');
define('LOGGED_IN_SALT',   'D&4cI-Vj4FVU#?.GJ4Toh:9H]1nP]voMXO|$+`2P]Q2#Qv~/i]L-_A|#P=^Kp;/A');
define('NONCE_SALT',       'z~)v>?nMOcv&;[XN_|F4l^W|NmkPD_?-OAT.J|=,ZubYd]OA2nc8W8ADV`cDgpgD');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
