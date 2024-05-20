<?php
$_SERVER["HTTPS"] = "on";
// define('FORCE_SSL_ADMIN', true);

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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'petPalace' );

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
define( 'AUTH_KEY',         'fT3f1SCI_7{.#n_Lrq&~[Us-;*Txk8>bmQz&>B~EJXXCh*FX1g]Kmw;&Pyprv2-F' );
define( 'SECURE_AUTH_KEY',  ' <MbNx=qLwtGu@ *9WkTMbGtBQ>7c-B/pZm^_T6k}>-1I-zr`Z#$Zn|z7mOfZl{v' );
define( 'LOGGED_IN_KEY',    'L75,%NYY(ECZo=0nhwU@:nT9:~_KBf]l&}-g+93|M, YW`XFs3)(A)%+tf8*yDMa' );
define( 'NONCE_KEY',        'q/Ww$F~;e#D{q09)SG)[oG6x Bt<]8N^*m!m@~V,k9/YM]Eu<qhc`9,*{;q&3yI(' );
define( 'AUTH_SALT',        '($yX6i@b6vi*]K)mbx~clc:;]kNB2fnntgnb6eQ@RSI,2|ck~9%/S2ZLR Hx84^-' );
define( 'SECURE_AUTH_SALT', 'h}XaKs,0OC5hQSjfH;HE7Gmd7y%5N`wcEZ!uIJ.$/ER)trmVcw6DAxTIj2;^/qM>' );
define( 'LOGGED_IN_SALT',   '7_qV*0I){$eM!AFF[>KN{5Ld|A|Niha=|Le4GaLnxhk-!^Gnc-PPJ~`j6/G+fg^.' );
define( 'NONCE_SALT',       '1{eB}.T~n*LA@!-V?scGU3wCT1WO`;_Be771?~6wv2w>bb-pyj}b46zN=TaIc& n' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
