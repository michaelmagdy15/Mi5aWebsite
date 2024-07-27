<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u981670979_bjAOu' );

/** Database username */
define( 'DB_USER', 'u981670979_g6FWX' );

/** Database password */
define( 'DB_PASSWORD', '4DiQwW47uQ' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          'W}Lz(*:}yxN`Rj{!&u;]w<(6tp$dW;WNQLqimC=r|(KEYfP++elWb0LQHgb=xN9Y' );
define( 'SECURE_AUTH_KEY',   'cd<kY?/ctBz}U1`lk}?lWx:u}:-(/ELh>=uM-$&M?ATQt4e8l]St$xl01[h)[8P7' );
define( 'LOGGED_IN_KEY',     '+n>+$a.P{&,GRPl=X<`7wu~M{4_G Y1E./`Y;6ux@c#pis=*%/#_QI$GZg>v;`F}' );
define( 'NONCE_KEY',         'm8wb$lx{I#sX.r|ohu=OvQ[Ung8-ahZ{3(#B)FKCMrK_v,D;z!h<(;>,NMN}.e/*' );
define( 'AUTH_SALT',         '_q6&jNQrjn5`>}ZDzOW6ngUb%On}2`T[@WHMXJMl;]P]zYbab?:3@;/.QWP=+VF,' );
define( 'SECURE_AUTH_SALT',  '7:6s).FS/`zn%b/0U]HQhwU^y9U5{J1QgG5j?P9a^fX31RtkdnQ7%6DW/oGJGEbT' );
define( 'LOGGED_IN_SALT',    'EM]]aOtwP>8X4f-yV>LBv[yRyBR&v`N*.v_rZ8?==Apt[5DvC=Sx1yG_|f}sLb,^' );
define( 'NONCE_SALT',        'bW5o^5[RWA;{hakbV9yps2n!!rK<q: XhJ)$G}(-pSq3VjPi 6de0jq>F*c)o:C!' );
define( 'WP_CACHE_KEY_SALT', '`:0%0(H0+UdhBg})j,i7gfIn=?=#$=`n+?GC89WtUCM*Z66a#%|/m-P%y`s3eqr8' );


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



define( 'WP_AUTO_UPDATE_CORE', false );
define( 'FS_METHOD', 'direct' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
