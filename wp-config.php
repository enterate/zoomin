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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tproject-cp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'hyPxc@:TZb5X?Xn!kCX_~ZL#@9HFsW^R24$JD)RI<373ux6otAOHgkbmYq7#F1C}');
define('SECURE_AUTH_KEY',  'OlvPEon$/LvLE},r6c9?J$*e5]B5jF=2Bq?wT%N4=?<hW:p;cgPHF43aWFJ]5)Wl');
define('LOGGED_IN_KEY',    '}+bhxa&PHtbXC6r+VOsYUZIcZ$d6b8<v(`%k=1yNF-UQTs>fofIE_Vw@m{|HWQ1r');
define('NONCE_KEY',        'kEfE,/Q{0hZ?otXcD32+#0qu|bo*gMTJtKlEwv|H23^!xMDSrH%qGUP9f^L8kAaK');
define('AUTH_SALT',        'SK|qw5En0=M9!`4ZD]7jRa[=w$.=abV516Sbr(ts@_M!(qN2RTlVGe6qsXcj9KWa');
define('SECURE_AUTH_SALT', 'h@ke`RS(>`{aAj?NC_mi~7 *$(1gBMm[%I#+]YD 5VtG;y@h.}gsFHJODv($=}LF');
define('LOGGED_IN_SALT',   '$2pGR@S<&*86KEG8WB3GJS*%X7D@S_MVEfKMTucG3>u$+oHzCqpj2T:X(w{0Kbfj');
define('NONCE_SALT',       '3msj4`>h?5<BE,E0>6>PtV7Pc&eZhjEI}Pep0.2P&Oq,78p&~T]j#pq}lqMZJfAf');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
