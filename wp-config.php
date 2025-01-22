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
define( 'AUTH_KEY',          'rd)|41614=ZxKJDJZIIa$#!zzM_#>f5tc^~I7/J9*t?Z}ik]`]Tu+-c</#MYOAj+' );
define( 'SECURE_AUTH_KEY',   '8{}GzbY$>-qisDyQ]]vM8_`T#h]46L$;1U<_a8U?dLxMbQ|LBffC8h*sOzbJa(Vd' );
define( 'LOGGED_IN_KEY',     'qT`=`;*+Q.s}OuZ^eSC|?khu%Td4vO EiJI.GJajkd+#rY;u!XVt; `Jg;r*-GXW' );
define( 'NONCE_KEY',         'gXW>402#o3{<NQ6/=?sOK=?(.I-Mt0^zImU<Z=p|j.*HY4XC?}?BD;jpt,=Q#a=N' );
define( 'AUTH_SALT',         'CiKr[8P{)@}-,y2Poe!, hd,l{ldW!{-QDCS/HY(.@VO1e_<2OmK9;aQQ@rBWsP:' );
define( 'SECURE_AUTH_SALT',  ':17C-r[TArDxxBdh4Gxf]RKL^EC>5!CedtoPTahZD|G!4SYJ__FC0rwsf=;F_4_B' );
define( 'LOGGED_IN_SALT',    'r>?V4zU}hVDR-dNiV1CZ=q2$Yk*.B%@`1QHFvPU%P2nH?aqm]w+K%A&~4.l<otgD' );
define( 'NONCE_SALT',        'Gm/&p|~R`T/_~5ytG2Bs_U%y/vTPC#hcwy?nfc@{Q4W<uLBJzrCw@eOg;E}zuT1b' );
define( 'WP_CACHE_KEY_SALT', '_Ujy<w+OM!p@])U~|=ZNl%7E.,sg0zgo*V`[@9OpQ%]!jF ye`llZPL0l53e:Dx9' );


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
