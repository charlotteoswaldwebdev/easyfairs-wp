<?php

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