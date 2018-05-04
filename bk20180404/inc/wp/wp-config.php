<?php
define('WP_SITEURL', 'https://bond-botanical.jp/inc/wp');
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
define('DB_NAME', 'LAA0122674-bond');

/** MySQL database username */
define('DB_USER', 'LAA0122674');

/** MySQL database password */
define('DB_PASSWORD', 'bondinc001');

/** MySQL hostname */
define('DB_HOST', 'mysql125.phy.lolipop.lan');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'a(V2)T*aIQ@Yzs/d[{W-uzIQgM`4o2@{K4&AO4{+bC*F0qK5F|@i:ve-}Y@b|(lW');
define('SECURE_AUTH_KEY',  'kksTWqC-L+me2K9X@eFNo~zTEwt[56^+<H|-y|+{_0fosvG-OaeD|r|g[]p6|O1E');
define('LOGGED_IN_KEY',    'Iy4F. U9v@i%tt|}Hz>Bm&x}M5R02Q9~tz+j>Ml>a`4MSp*gB4OV!sbx({? ^4mg');
define('NONCE_KEY',        '*#?q8*7_WF^k^,9hPz`E^dF%oV E{NL3i=$8os-R@X=2Jw6j=y(ibit4L|O[6T4R');
define('AUTH_SALT',        'u*{2p@tCq]xpZ6;K4EXkr.|=ZU?-L(cE*JGmiMHLE-{hQ#X#p?`UGmZqbF=MJ`|%');
define('SECURE_AUTH_SALT', 'Vi>@t,Vo9gz!6y+BD|zE=+sj~%:|@jL*5s}|Zuc[1ZF1<hs>y(y]tDnb`.U-_vt ');
define('LOGGED_IN_SALT',   '8@1+P4UXA)U^_5+#|FNh{:e=k#/]A_n+G-a7fI>zF1]73=A{0L3#+K~X#K<%3!8#');
define('NONCE_SALT',       'n61euMe+-viH,xA<~g/PY-|U2W/E=Ms%,():d^A&^++`GeIZzM(6![9PmX|XF`Hj');

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
