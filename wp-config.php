<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'truework' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8UzSquJIbkqTg:{;8f_iU,`PL=R_5->bfjx^?*3kjDq)OZHLX6)w_^Bm8rT!^O=7' );
define( 'SECURE_AUTH_KEY',  'sMi+g9V#gVvab8Z`F{(B>af.~<, j1f,M2nLv]s/HkGy5ygB+T1aTu>VYgOoNz:u' );
define( 'LOGGED_IN_KEY',    '6hyM ]Y)i(3O_.b P-6G0%fE0oQFHHO*>V:{WKaxkheJe^xJ++PW$0r%9w?cxhOy' );
define( 'NONCE_KEY',        'gi[GCFK%~1_X=o~L&_`uZ9di7@iBX7!Zfh}/*m(<f1<a/f(.5GDG2Vp(dN_yI$tK' );
define( 'AUTH_SALT',        'L@[@k4TZkPHy/gQNHNn[*||u5QN3Zr&Sub7t{Zm.u0*SxcM~%t[zYrwRJsm124,[' );
define( 'SECURE_AUTH_SALT', 'E_9Z2vdb-94Y.@g.cPRNMmP (`5}*ZM|*IV[l2XmER68!j,:PkfR^xdlae.7b E)' );
define( 'LOGGED_IN_SALT',   '4Sy,/|y!!auUi;AZMW~My<Au2u-nn)Gk;OiDIaIW!kCW9}M&E|g*#8amCMKgRlO8' );
define( 'NONCE_SALT',       'vh~f*V1!j)14$>1(VBexeKVXCO;dLm4Jgv|NZQF**!Dm|ZRl99/$&%N@}Ec~.Lzt' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'tw_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
