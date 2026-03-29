<?php
// Sample file for WordPress test configuration. Copy this to wp-tests-config.php and fill in the values for your test database.\

// Database credentials for the TEST database only — never your real site DB.
define( 'DB_NAME',     'wordpress_test' );
define( 'DB_USER',     'wordpress' );
define( 'DB_PASSWORD', 'wordpress' );
define( 'DB_HOST',     'db_host_name' );

define( 'WP_TESTS_DOMAIN',  'localhost' );
define( 'WP_TESTS_EMAIL',   'admin@wp.com' );
define( 'WP_TESTS_TITLE',   'Test Site' );

define( 'WP_PHP_BINARY', 'php' );
define( 'ABSPATH', dirname( __DIR__ ) . '/web/wp/' );