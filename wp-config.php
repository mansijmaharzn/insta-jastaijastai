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
define( 'DB_NAME', 'insta-jastaijastai' );

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
define( 'AUTH_KEY',         '(nbB8O~3cB>Tz^R<*$lw.nH+1x_^)o,?4vx-X:82?%w68{=R=eyvYLFw-&LS6 IP' );
define( 'SECURE_AUTH_KEY',  'M5YK#Y*Lw6L:U};KI9K;B7t@bn;5$ZSfHumi.f$KJL>qo}t(]0C^teFNq5Ifu<Tq' );
define( 'LOGGED_IN_KEY',    '?IK4l[WMj]l3gca0RZKpZZ0Y2W^@>{.<opky#TjBRXCEL*kgC=Yf7#?8f4JLW,Hq' );
define( 'NONCE_KEY',        'V71j@2,kZ},ZVw:0]jr$B6z/SM>b3u191jeH|?9:4j&W]S~Ou 1AUd{5)?~KcMu_' );
define( 'AUTH_SALT',        'Lj-S8R_Yd^u&QcCq*!5,YS1xg#q;&RU@ekI+fGcL$s_#1cbS~z$-(F0qy8`l&lQt' );
define( 'SECURE_AUTH_SALT', '#:LCU{J;6.{6*5U{gXD3b]%&cJ0RT@-eRVxCspMWK-TK%yx1-fEa#g(vap$;Gq#z' );
define( 'LOGGED_IN_SALT',   '`/d4OuYNMVN%U^--%c@FE<ZxQ&DA#(dk9QmNj5go-$ll`El*KFI_B%9#)L&&U%:w' );
define( 'NONCE_SALT',       'Zc9g?EgtBTyV]}A(sSpgx1.LPx3vi2$2cPKMft<fkM[_>xP6nY>h=9H@pCi/MSLC' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
