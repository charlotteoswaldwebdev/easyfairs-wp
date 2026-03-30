<?php
/**
 * Plugin Name: EasyFairs Platform – Contact Form
 * Description: Shared contact form handler for all sites in the network.
 * Version:     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Process the contact form POST submission.
 * Uses WordPress's admin-post.php routing so no theme PHP is needed.
 */
function ef_handle_contact_form(): void {
    if ( ! isset( $_POST['ef_contact_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce(
        sanitize_text_field( wp_unslash( $_POST['ef_contact_nonce'] ) ),
        'ef_contact_form'
    ) ) {
        wp_die( 'Security check failed.', 'Error', [ 'response' => 403 ] );
    }

    $name    = sanitize_text_field( wp_unslash( $_POST['ef_name'] ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['ef_email'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['ef_message'] ?? '' ) );

    if ( empty( $name ) || empty( $email ) || ! is_email( $email ) || empty( $message ) ) {
        wp_safe_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
        exit;
    }

    wp_mail(
        get_option( 'admin_email' ),
        sprintf( '[%s] New contact message', get_bloginfo( 'name' ) ),
        sprintf( "Name: %s\nEmail: %s\n\nMessage:\n%s", $name, $email, $message ),
        [ 'Content-Type: text/plain; charset=UTF-8' ]
    );

    wp_safe_redirect( add_query_arg( 'contact', 'success', wp_get_referer() ) );
    exit;
}
add_action( 'admin_post_nopriv_ef_contact_form', 'ef_handle_contact_form' );
add_action( 'admin_post_ef_contact_form',        'ef_handle_contact_form' );

/**
 * Render the contact form HTML via a shortcode.
 * The block pattern in the theme uses [ef_contact_form] inside a Shortcode block.
 * This keeps all PHP logic out of the theme entirely.
 */
function ef_contact_form_shortcode(): string {
    $status = sanitize_text_field( wp_unslash( $_GET['contact'] ?? '' ) );

    ob_start();

    if ( 'success' === $status ) {
        echo '<p class="ef-form-success">Thank you — your message has been sent.</p>';
        return ob_get_clean();
    }

    if ( 'error' === $status ) {
        echo '<p class="ef-form-error">Please fill in all fields with a valid email address.</p>';
    }
    ?>
    <form class="ef-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <input type="hidden" name="action" value="ef_contact_form">
        <?php wp_nonce_field( 'ef_contact_form', 'ef_contact_nonce' ); ?>

        <div class="ef-field">
            <label for="ef_name">Name</label>
            <input type="text" id="ef_name" name="ef_name" required>
        </div>

        <div class="ef-field">
            <label for="ef_email">Email</label>
            <input type="email" id="ef_email" name="ef_email" required>
        </div>

        <div class="ef-field">
            <label for="ef_message">Message</label>
            <textarea id="ef_message" name="ef_message" rows="6" required></textarea>
        </div>

        <button type="submit" class="wp-block-button__link wp-element-button">Send message</button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode( 'ef_contact_form', 'ef_contact_form_shortcode' );

function ef_enqueue_contact_form_styles(): void {
    wp_enqueue_style(
        'ef-contact-form',
        plugin_dir_url( __FILE__ ) . 'style.css',
        [],
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'ef_enqueue_contact_form_styles' );