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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'R$@m[(N:)r__-hO7<@3)VcOG{$VR!ECOq2x_>;J|y]Ga|0!d`:I&edHYa3w}*<VI' );
define( 'SECURE_AUTH_KEY',   '/1`4w* c6[[:03R}}y-=|yWTz!.O(I<hJw`S8&5n#u_+VKU~k? S)aIr>nxC1Xm[' );
define( 'LOGGED_IN_KEY',     '}U_66)x4^W#[axdkZ2A jqg(~J>hNO+~Blk2CGPa1Ji$Ar,&|a3h:fe#fUE&zT)^' );
define( 'NONCE_KEY',         '&+VJ>%}Ee>WeH)FOw2fiLgMwM~cD J}`uUwq#0sftz gBXzeY,)J!:[CbqhUX>us' );
define( 'AUTH_SALT',         '&?Fx1~.`gcL>$M7yc&52+zPxMSM/.@&|B:hxVpF+7[j= O[-At35.yX9YQYvLYB?' );
define( 'SECURE_AUTH_SALT',  'LE{o:*]_H.4VBtJhk<sz>|)/.,_<kE&sOjB^{z=P5R }YXObQ~%*^x0X=p*`F1XD' );
define( 'LOGGED_IN_SALT',    '/XK.$b4}gl/er)`+}rtyGu2k%KLX?ZAu._<NNzb&EX^6S.=aZ<:FMJrV)|E<A`Go' );
define( 'NONCE_SALT',        'K3O>q[i8F.+#8R-&V[Qe=%QwodRop5tmpXAa70h-qAhF6@W~wn<4y;(1_7uG0@|:' );
define( 'WP_CACHE_KEY_SALT', '){J_4aK4=a:{XC4`s#+8+Kc2hly;W4VU4U$|HTE {[lKUw. Y|%=XSE88Co<{e3R' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
