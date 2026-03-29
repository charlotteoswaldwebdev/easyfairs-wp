<?php
/**
 * PHPUnit bootstrap for WordPress tests.
 */

// Point to the wp-phpunit package installed by Composer.
$_tests_dir = dirname( __DIR__ ) . '/vendor/wp-phpunit/wp-phpunit';

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