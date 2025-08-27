<?php
class EM_Events_Defaults {
    public function __construct() {
        add_action( 'save_post_event', [ $this, 'apply_default_location' ], 10, 3 );
    }

    public function apply_default_location( $post_id, $post, $update ) {
        // Don't run on autosave or revisions
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( wp_is_post_revision( $post_id ) ) return;

        // Check if event_location is already set
        $location = get_post_meta( $post_id, 'event_location', true );

        // If empty, set it to the default from settings
        if ( empty( $location ) ) {
            $default_location = get_option( 'em_default_location', '' );
            if ( ! empty( $default_location ) ) {
                update_post_meta( $post_id, 'event_location', $default_location );
            }
        }
    }
}
