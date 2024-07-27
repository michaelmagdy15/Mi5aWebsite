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
define( 'DB_NAME', 'u981670979_4GjfS' );

/** Database username */
define( 'DB_USER', 'u981670979_QgMKD' );

/** Database password */
define( 'DB_PASSWORD', 'HiOSJV52YC' );

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
define( 'AUTH_KEY',          'a;R,ufYP$idNc.hU#CEPcKE)ZLw)^i/0 k~11X)hRB}/`31ywW~;~|0s2x/@-=N7' );
define( 'SECURE_AUTH_KEY',   '#c8>3U4DQqu`yQ+l[7[<z|Jq~|FUy5i=hvNDNzH!{28faI]53ogvGk(uLuvtU3 O' );
define( 'LOGGED_IN_KEY',     '4rnP6C1iYgEz16 K+.-3u1(dbmT])q |QT4hGQ>erY^sf)?qQsIo31#qqnTw8vds' );
define( 'NONCE_KEY',         'RhK!][`.&8[WA@;QXnxQ}).ePO8iV:zFCn*?FtThdJxKgNAoLg+V#`]LmRudVR,|' );
define( 'AUTH_SALT',         '! O&Y2+E>.salvFoC0k;|kp2yy_|*1vE38}9k/4_{6s1J i8 &h1`0p6[q+u!k.}' );
define( 'SECURE_AUTH_SALT',  ';Odh%iN5uunyesH!O/ur#[!Qp4gTrGS#{*H.*Y./`TJhUKfz]:|(xdHLMh(v]6e,' );
define( 'LOGGED_IN_SALT',    'JR5Mo&<OE@e`IivNZKj0:UGl;&{RNr$CFgK!9<Q3p!OZAB&[?DQchM*#-F=Qt$)p' );
define( 'NONCE_SALT',        'Iei.|QklpF]` ^P)^t[5W[+NxcO>TZR`#40k;j3yu_Tv:6 4#r<`w=.jIi,bbQ4A' );
define( 'WP_CACHE_KEY_SALT', '`$LJ_zC..</`z4mp`}KV`m:cD8|TC3C<#6H%r%D`&*[JA{5r@(pnz|F9JeI#hH $' );


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



define( 'WP_AUTO_UPDATE_CORE', 'minor' );
define( 'FS_METHOD', 'direct' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
