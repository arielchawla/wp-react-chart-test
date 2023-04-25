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
define( 'DB_NAME', 'wp-react-chart' );

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
define( 'AUTH_KEY',         'eILJkJD%+qKYHsXmQ5{}kf]JtDO%}vQJd|k$:4YGYL7 1zx]G@^!IYZnHSWx=hfx' );
define( 'SECURE_AUTH_KEY',  ',*OsJ^*(h (d8qC5C(PR:di0Uw`&Sii=i@A+pj!MR d`6:{x]~7eoBH[TSE3KRAB' );
define( 'LOGGED_IN_KEY',    ')]Z0FDVSp[!S~:nHvwye&6Y9Z.OwsUExIig^x0rb~Q<Py/Of8CC)n};i%L M0z0!' );
define( 'NONCE_KEY',        'T/}iZEU NQ[@f(un&ToK!=E1l>oa.N?Xs4M%co8.-0cyk)9%ud9wzhW[yd<YCb6r' );
define( 'AUTH_SALT',        'uQ,Q lK%:x2xuAy8nTWX1SG0v}mYXUn30Zi:Pf4$=,GqM7n*_2!Bp@>Ttmpct_|Y' );
define( 'SECURE_AUTH_SALT', '+fP8S,fT2;EgQ[av5[W`Z|K9YodF|5.g,m=R)L+CLIMmWb_S(%E7P5m~3h.~J]$]' );
define( 'LOGGED_IN_SALT',   'C@H11o70~%I8po@k8lhatIo}7ua&pvNbyJqoB8s0WTMn&s-W.,mHp}:B7gpYX_eM' );
define( 'NONCE_SALT',       '$QcAW}0C.:nee#Cb$S@!*iz|Hr3(8V~@_G~r*n:0LcxE8n,OJL8ieoN_)2[^2FT%' );

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
