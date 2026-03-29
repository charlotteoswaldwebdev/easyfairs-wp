<?php

/*
|--------------------------------------------------------------------------
| WordPress Bootstrap
|--------------------------------------------------------------------------
| Pest 4 processes this file during its own initialization, before PHPUnit
| fires the bootstrap= attribute. Requiring it here (idempotently guarded)
| ensures WP_UnitTestCase is defined before uses() triggers autoloading of
| Tests\TestCase on the next line.
*/
require_once __DIR__ . '/bootstrap.php';

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
| Tell Pest which base class to use for tests in each directory.
| 'uses()' here is like extending a class — all Feature tests will
| automatically have access to WordPress test helpers.
*/

uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations / Helpers (optional)
|--------------------------------------------------------------------------
| You can define custom expectations here that are available globally.
*/