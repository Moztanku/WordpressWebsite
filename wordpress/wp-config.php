<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
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


//define('WP_HOME','http://hak3r37.ddns.net/wordpress');
//define('WP_SITEURL','http://hak3r37.ddns.net/wordpress');
//define('RELOCATE',true);
//define( 'WP_MEMORY_LIMIT', '512M' );

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wp_root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wp_root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
//define( 'DB_HOST', 'hak3r37.ddns.net' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'RIAgs^q}o/g97hOEpCZzZc,&a*Zhpbn:5|Umg1eJ>$!(H/|+z2X%G[T6CX~Re@24' );
define( 'SECURE_AUTH_KEY',  '9Zsyw`I^-Z~`;ij,DbU$SNqn|#+d *~laN4DA.G3J};M4;)0#->cC`YpUtZ}9 >9' );
define( 'LOGGED_IN_KEY',    'pJIB@%jgya;p}R#lMuqHria)(rKC ;6q(=XJ*n)F[d9ki/,xb}0O#L;KI@5v~XTv' );
define( 'NONCE_KEY',        '2b/![sX|n?@4u.=[0pww/Nk}KMqwRhIwy#_##NU,K<F;reN5$#^!2@ G-[/VjFY)' );
define( 'AUTH_SALT',        '4Kz{9[~7kohhe0~v>S`:qX?n_5$*pcdno=;[6x!/xk`*o`)vaKpMkth<1UT@rwhb' );
define( 'SECURE_AUTH_SALT', 'ydz[_:1%Au`]POcsu<_ATCjzSR+$ohVMyQ6!(xhns@iL2OzG8YC~%+Oofgy`|$>_' );
define( 'LOGGED_IN_SALT',   '+j)3-+,CjfJA=wl?e.~wVd25ivF{L}@k~P}9S=Zv@=]CX-3,6K$_*hNylR+Z1<0U' );
define( 'NONCE_SALT',       'o@TwZ1q?H %bk6 ?+&&bonB%.m[~K2X$;$/H.GkdT?Ool6sJL=m{dZ|6],={cy?Q' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
