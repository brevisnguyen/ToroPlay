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
define( 'DB_NAME', 'toro_play' );

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
define( 'AUTH_KEY',         '6F9^<NV([Po0IF<YXi|4F1E,yQA@Pq=#;fx,.d>W=7Xk[/r:&FPw:Zw)N.wU`@)D' );
define( 'SECURE_AUTH_KEY',  '&uo!gfyXSVQ&/{da>K(U![h0hcSBFLo<;od-iCH-f{d@4lc:D?-6htT]1_+fMuo!' );
define( 'LOGGED_IN_KEY',    'qOav4xpY&#:`S5A_=^Z)5CQ}uO_t!Y&57|!}oHh-XQ`>1]m^m)ML8F6^JXPM3sA1' );
define( 'NONCE_KEY',        'OnW<<q1>*^+R%Z#8T;FlWNC8UQqe]}+98-~Tng2x4/pVlQf?c2!q>rkWiKk$5Egw' );
define( 'AUTH_SALT',        'tBK|0cN Y;~@.STZjIgQvOB0l-+Ai4<WS<L]Fi!?)woj~Fwg/B44Se5J&vAuW7DI' );
define( 'SECURE_AUTH_SALT', 'ofa@3FgiK&@yV50Og1;0-gm9rME~euT]z?uy@c[</|2?z3rqi;r@rb`*4o_e22{)' );
define( 'LOGGED_IN_SALT',   'LfVU-83wrC_:A}AR0ii+&.,hdeadj)e`Ow|3FET5T7vNmM|,E=MZ=yYNtPm[ }w5' );
define( 'NONCE_SALT',       'eDf;nd1MO@)s[_A?{`tb/hT ~ 1v&UKhb?rFOC`z<=u]>KX7N*1&f+^y2CgnVCo@' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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

// define( 'WP_HOME', 'https://ab99-180-232-113-168.ap.ngrok.io' );
// define( 'WP_SITEURL', 'https://ab99-180-232-113-168.ap.ngrok.io' );


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
