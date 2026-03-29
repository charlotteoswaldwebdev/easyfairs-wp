<?php

test('multisite is enabled', function () {
    expect(is_multisite())->toBeTrue();
});

test('network has at least two sites', function () {
    // The test database starts fresh with one site. Create a second to verify
    // the multisite API works — this is isolated to the test DB, not production.
    wpmu_create_blog( 'example.org', '/second/', 'Second Site', 1 );

    $sites = get_sites();
    expect(count($sites))->toBeGreaterThanOrEqual(2);
});