<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ozsm_db' );

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
define( 'AUTH_KEY',         'k[Ubt%=t%W~mr;jt!sR$^h3u]5ai(pBvq/E[s6PPJ-Sfkg& HR-_6~!x%}5JSWR+' );
define( 'SECURE_AUTH_KEY',  '4@0.XQ(u?)B$;X6$}Dmm`zN`1i6zn/5kCTUx3+TJfAk*&NXO<3ghD6B.L{u}5/?k' );
define( 'LOGGED_IN_KEY',    'B|wm;0V(jS5/hy/V 2oGDxkY;>4P@F2^qu:,6I^>rqQ%J|rLy_:ZMkfa;l*sswB/' );
define( 'NONCE_KEY',        'L *P_ZowI)-c8nDy8-CWO9TqaOqz^mF@BS#tuQP409[|qJ_Ek} +o/ _qYhm!g6?' );
define( 'AUTH_SALT',        '0s?2/fu0GyxB)D|xWY,8dyAdU6K@_+~b9Wnx6D#4yFKfZMCKa)9C P-=PzbGKl!D' );
define( 'SECURE_AUTH_SALT', '&DC>SELaiqJ(ZW+sf_hH=GCO{YPBWf|8Yc.Z1^+YzdTW9!eD#C?HVc<9G0.5B!NN' );
define( 'LOGGED_IN_SALT',   'hDQM6}bL@^uEz_EQ?Nxv)VHA;R>2&L%LU0NI[tX!H93C!j@CE+vHn&#!X!yKPGv/' );
define( 'NONCE_SALT',       '4R,BK!l,/yyZzrcbZ*rDtmzc%o=c*kTEVS`hb_:*;re;o2#v)k83lB(e`m.${X6%' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
