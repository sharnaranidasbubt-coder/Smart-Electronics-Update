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
define( 'DB_HOST', 'mysql' );

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
define( 'AUTH_KEY',          'w?MJ.WwX^rQ37~k]4GlC0$Tt!!{Zv156 nnMjPQqv!QMz6#}7GL{h Q^o,=1O(]8' );
define( 'SECURE_AUTH_KEY',   'Qi1u;PUP0(,2@Ea:4<{S9R^7jhDBWm?j#}.v, S*hJc?Gts1K@bks8OyR&A6#uoa' );
define( 'LOGGED_IN_KEY',     '^`k*!wBa3(Q=j@$T`:{7oO)+|/oOT!&<-Edcuh5$ (Lf*S*}sv}(~2+bd>Y>[7) ' );
define( 'NONCE_KEY',         'F!iO!dm|c:dzb:UfYd&E$6Kw,g#v@D7#qvv)LT?1.[ye*`{D[qq9bC6XOsz6U0<K' );
define( 'AUTH_SALT',         '&Y1O @;qE}Wv_=t_(m$U%fs5J=u2:8zIcr~z[P}W/=?#$yt,rMc:PGh=yO8iD5-B' );
define( 'SECURE_AUTH_SALT',  '6W4YK&!YxbQ/pN|t 47%M{7;GZkRt_?!>vP_~Cyt*iiCP!&bYZ+MRMiXdjyWZRZr' );
define( 'LOGGED_IN_SALT',    'T VUk!J|^8@,}YB8^U|l pafZ[RML-+JfcE86YDj|-~Gk,NS[}$c2^I3r:{=Gh0J' );
define( 'NONCE_SALT',        'Ha>fp1<50igs1I5p0kxR!?!=-[k^Dv0X!doLVV6n]f/H4yzo;Dwd5P+u$=sDP~Uv' );
define( 'WP_CACHE_KEY_SALT', 'YZ=yaB]XpVwrmlJnOy<DlqA=pT:t*P4vl -:}WQT}j=v|C2~O,.(-u+-gB4U#} Q' );


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

// Fix FTP issue in Docker environment
define( 'FS_METHOD', 'direct' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
