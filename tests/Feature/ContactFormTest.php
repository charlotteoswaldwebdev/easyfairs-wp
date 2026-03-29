<?php

/**
 * Tests for the EasyFairs Platform contact form mu-plugin.
 *
 * We test shortcode registration, hook registration, and HTML output.
 * We do NOT test ef_handle_contact_form() directly because it calls
 * wp_safe_redirect() + exit — that would require a more advanced mocking
 * setup (e.g. Brain Monkey) which is out of scope here.
 */

test('contact form shortcode is registered', function () {
    expect(shortcode_exists('ef_contact_form'))->toBeTrue();
});

test('admin_post hooks are registered for the form handler', function () {
    expect(
        has_action('admin_post_nopriv_ef_contact_form', 'ef_handle_contact_form')
    )->not->toBeFalse();

    expect(
        has_action('admin_post_ef_contact_form', 'ef_handle_contact_form')
    )->not->toBeFalse();
});

test('shortcode renders a form by default', function () {
    $output = ef_contact_form_shortcode();

    expect($output)
        ->toContain('<form')
        ->toContain('name="ef_name"')
        ->toContain('name="ef_email"')
        ->toContain('name="ef_message"');
});

test('shortcode renders success message when contact query param is success', function () {
    $_GET['contact'] = 'success';

    $output = ef_contact_form_shortcode();

    expect($output)
        ->toContain('ef-form-success')
        ->not->toContain('<form');

    unset($_GET['contact']); // clean up after yourself
});

test('shortcode renders error message but still shows form when contact param is error', function () {
    $_GET['contact'] = 'error';

    $output = ef_contact_form_shortcode();

    expect($output)
        ->toContain('ef-form-error')
        ->toContain('<form'); // form still renders on error

    unset($_GET['contact']);
});

test('shortcode form posts to admin-post.php', function () {
    $output = ef_contact_form_shortcode();

    expect($output)->toContain('admin-post.php');
});

test('shortcode includes a nonce field', function () {
    $output = ef_contact_form_shortcode();

    // wp_nonce_field outputs a hidden input — check it's present
    expect($output)->toContain('ef_contact_nonce');
});