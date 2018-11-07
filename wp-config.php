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
define('DB_NAME', 'VF_DB');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '12345');

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
define('AUTH_KEY',         '+l^{JE=c*j3Bn^ro1-EY~?sF<_(KMY34:b0rTB|Oi1Nrh N]bSZ@k8>scvnkOOx;');
define('SECURE_AUTH_KEY',  'm,wn0]iNf74i(idNE9WE#!=;6mq2C/DWXEn(b>cAZNvx:Z.M0e3W*YuoNI*z,9<A');
define('LOGGED_IN_KEY',    '];Zl{wmfzF%lm/KO:39,309+@!%2zl1r!_30sY-wly-6puvU7IBpE&AB,V[?Ho_5');
define('NONCE_KEY',        '(JjF%#bo3;XaZ:U53JG9fd5b*IP]U}zeCMs-U*Yt&IF9R ?yws*kz^[Wv32f *vR');
define('AUTH_SALT',        'K=;vDcz^V4>wUOvYF=BY7q2bUyyBABDZ^[`M@D-V(;7FT&hjXcBcT;Y8N#tOPb$5');
define('SECURE_AUTH_SALT', '17tg0reN7w#ECEhQ?J*Klut[qkfAUmHxj<?TNz/DMGFd7x+}T4>bLsJB,|reIJ)?');
define('LOGGED_IN_SALT',   'i9RI)a}|hr98oi0D2wsi0OZF@l3#d9W&FKLv&?}j()#Qs~-FM$]+/?spv=@{(TE|');
define('NONCE_SALT',       '^_Rc}f=RS+V[Ax=kuPEI{gq.eRUv`F.kSV<qRvcDe5Ou/5asNG~cEw#`l$Obe07U');

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
