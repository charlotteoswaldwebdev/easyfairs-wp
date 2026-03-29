<?php
/**
 * PHPUnit bootstrap for WordPress tests.
 * Guard allows this file to be required from Pest.php without double-loading.
 */
if ( defined( 'WP_TESTS_BOOTSTRAPPED' ) ) {
    return;
}
define( 'WP_TESTS_BOOTSTRAPPED', true );

// Point to the wp-phpunit package installed by Composer.
$_tests_dir = dirname( __DIR__ ) . '/vendor/wp-phpunit/wp-phpunit';

// Tell wp-phpunit where our config file lives (default search path is wrong for non-core installs).
define( 'WP_TESTS_CONFIG_FILE_PATH', __DIR__ . '/wp-tests-config.php' );

// Tell wp-phpunit where yoast/phpunit-polyfills lives (default resolves to vendor/vendor/… which is wrong).
define( 'WP_TESTS_PHPUNIT_POLYFILLS_PATH', dirname( __DIR__ ) . '/vendor/yoast/phpunit-polyfills' );

// Load the WordPress test functions.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load any plugins/mu-plugins you want available during tests.
 */
function _manually_load_plugin() {
    // Custom Contact Form Plugin
    require dirname( __DIR__ ) . '/web/app/mu-plugins/contact-form/contact-form.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Bootstrap WordPress itself.
require $_tests_dir . '/includes/bootstrap.php';