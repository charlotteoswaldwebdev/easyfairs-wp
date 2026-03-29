<?php
/**
 * Charlotte's Web - Easyfairs — Theme Functions
 *
 * Responsibilities:
 *  - Enqueue Google Fonts (all four families used across style variations)
 *  - Register a custom block pattern category
 *  - Restrict the editor block set to a curated platform list
 *
 * Architecture note:
 *  Block restrictions enforce consistency across all sites in the network.
 *  Branding differences (colours, fonts, border-radius) are handled entirely
 *  through style variations in /styles/, not through PHP.
 */

declare(strict_types=1);

/**
 * Enqueue Google Fonts on the front-end and inside the block editor.
 *
 * Fonts loaded:
 *  - Inter           → base body font for all sites
 *  - Space Grotesk   → heading font for Tech Expo variation
 *  - Playfair Display → heading font for Food Summit variation
 *  - Lato            → body font for Food Summit variation
 */
function easyfairs_enqueue_fonts_and_styles(): void {
    $font_url = 'https://fonts.googleapis.com/css2'
        . '?family=Inter:wght@400;500;600;700'
        . '&family=Space+Grotesk:wght@400;500;600;700'
        . '&family=Playfair+Display:ital,wght@0,400;0,700;1,400'
        . '&family=Lato:wght@400;700'
        . '&display=swap';

    wp_enqueue_style(
        'easyfairs-google-fonts',
        $font_url,
        [],
        null
    );
    wp_enqueue_style(
        'charlottes-web-custom',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'easyfairs_enqueue_fonts_and_styles');
add_action('enqueue_block_editor_assets', 'easyfairs_enqueue_fonts_and_styles');

/**
 * Register the Easyfairs pattern category so all platform patterns
 * are grouped together in the pattern inserter.
 */
function easyfairs_register_pattern_categories(): void {
    register_block_pattern_category(
        'easyfairs',
        ['label' => __('Easyfairs', 'easyfairs-platform')]
    );
}
add_action('init', 'easyfairs_register_pattern_categories');

/**
 * Restrict available blocks to a curated platform set.
 *
 * This is a deliberate guardrail — editors can do everything they need
 * with these blocks, but cannot introduce arbitrary or inconsistent
 * structural elements. The list covers text, media, layout, interactive
 * elements, and all blocks needed for template editing.
 *
 * Trade-off: some power-user blocks (HTML, Table, Classic) are excluded
 * intentionally to protect editorial consistency across the network.
 *
 * @param bool|array      $allowed_blocks
 * @param WP_Block_Editor_Context $editor_context
 * @return array
 */
function easyfairs_allowed_blocks( $allowed_blocks, $editor_context ): array {
    return [
        // Text
        'core/paragraph',
        'core/heading',
        'core/list',
        'core/list-item',
        'core/quote',
        'core/separator',

        // Media
        'core/image',
        'core/cover',
        'core/media-text',
        'core/video',

        // Layout
        'core/group',
        'core/columns',
        'core/column',
        'core/spacer',

        // Interactive
        'core/buttons',
        'core/button',

        // Patterns and reusable blocks
        'core/pattern',
        'core/block',

        // Site identity (used in template parts)
        'core/site-title',
        'core/site-tagline',
        'core/site-logo',
        'core/navigation',
        'core/navigation-link',
        'core/navigation-submenu',

        // Post content (used in page/archive templates)
        'core/post-title',
        'core/post-content',
        'core/post-featured-image',
        'core/post-excerpt',
        'core/query',
        'core/post-template',
        'core/template-part',
    ];
}
add_filter('allowed_block_types_all', 'easyfairs_allowed_blocks', 10, 2);
