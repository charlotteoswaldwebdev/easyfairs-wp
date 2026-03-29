<?php

test('multisite is enabled', function () {
    expect(is_multisite())->toBeTrue();
});

test('network has at least two sites', function () {
    $sites = get_sites();
    expect(count($sites))->toBeGreaterThanOrEqual(2);
});