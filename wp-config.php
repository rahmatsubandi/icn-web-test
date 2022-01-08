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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'icn' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '#*U--<3dS1^*r2@kM)+kZ@ Mcl7$Ak~Y_4R) Fu)y:QxZl_YNAyOw@E3aD?|oqn<' );
define( 'SECURE_AUTH_KEY',  '?O5Y5fNrm!dgjEPT.Dd[L7e*Mk*~y`W{7]I|T{xQb.KU[mq!r@UztgQ4MJf*Mf>8' );
define( 'LOGGED_IN_KEY',    'mvD@@l7!:t*|CX{#*~^O2x~HOojsvgCR>Tv< TlkwpiYO@? L0m,NFF3O9[E$iNB' );
define( 'NONCE_KEY',        'B*5L8R9tk3C1%:s[/Mu~9*gj9o!8&X6606UJ/it)x@hchEfst9tWv^Y(~c>&~T%m' );
define( 'AUTH_SALT',        '(S`WbIm2QlrrbMli1>akYoh`<t;6]0wAQs3x^_cmw9nnpbW$ycGHjvE<CC*$|+up' );
define( 'SECURE_AUTH_SALT', 'dY7*)>,>?nRM&6#4sfFhW^F=>K}<#P?G$%S|?bV2,-6i?vV,=U)}]hU#X52U9KAB' );
define( 'LOGGED_IN_SALT',   '?Qp32C-a/3n8*X]iwr)?J;m=lsZ)PLWOySz6V:7sJoS Qf>[/H$n47=vVCW5Sp4z' );
define( 'NONCE_SALT',       '}wRmAo>#(1Ic,K5um5cIKdl->5oitH%6lnBYLM+,s&KAFxg`,j`$ ]-g53],l#xN' );

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
