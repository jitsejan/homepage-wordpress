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
define('DB_NAME', 'wp_v8');

/** MySQL database username */
define('DB_USER', 'wp_v8');

/** MySQL database password */
define('DB_PASSWORD', '6vQst9f4faZreXtU');

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
define('AUTH_KEY',         '[>UHv= y oiy<-eP:+Ogr#plTT@](=(/+R{ujY+]:L3Z)+{?|YMW9Q) OhSM:kSP');
define('SECURE_AUTH_KEY',  'wHnYm_j6*a89rGA_er/-M~Y}{^zWdkBu1y@IN{vf|l&LLVR)wxRGe|W3_bZ/!~-V');
define('LOGGED_IN_KEY',    'D:uJ,>6=vI7%^,$)@hb6w|1jF<FhMbE v+pU$V /l*n9o(Nvb-5be?J[,x:#[mYu');
define('NONCE_KEY',        'Nk|_} nrUG_J1,n3{!KpL@F38XAXc3t+<aIYF-iRlrR*pU@j`;Qvr<2e{Q9y`x,:');
define('AUTH_SALT',        '>l FJL$4B<i0MSu!Hd(nSU2x|5-)~>#8-vrGWNP<EX>f5NX(OtUPOqwse2;O-C#3');
define('SECURE_AUTH_SALT', '{.8`r.F dT[!2W2t}Yq4=I;^Di%+-:2mu3!*|~<Cr%-$(s&GJd3<?01pz6Q|fK:Z');
define('LOGGED_IN_SALT',   'Y<p*7Z!s+g23(OO,;NC*`02T(8miak@s.>kI{VOIHz|H~w.U+mH%<+BRA}/9^nHS');
define('NONCE_SALT',       ',n_ODE|nss*>4RI~3f+qW^M|u$@~d;#txM:%L$1zjd|%grxfW*JoWh-PsiZ6>2^.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_v8_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
