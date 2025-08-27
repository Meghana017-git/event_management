<?php
class EM_Events_Template {
    public function __construct() {
        add_filter( 'the_content', [ $this, 'inject_event_details' ] );
    }

    public function inject_event_details( $content ) {
        if ( get_post_type() !== 'event' || !is_singular('event') ) {
            return $content;
        }

        $date      = get_post_meta( get_the_ID(), 'event_date', true );
        $location  = get_post_meta( get_the_ID(), 'event_location', true );
        $organizer = get_post_meta( get_the_ID(), 'event_organizer', true );

        $details  = '<div class="event-meta">';
        if ( $date ) {
            $details .= '<p><strong>Date:</strong> ' . esc_html($date) . '</p>';
        }
        if ( $location ) {
            $details .= '<p><strong>Location:</strong> ' . esc_html($location) . '</p>';
        }
        if ( $organizer ) {
            $details .= '<p><strong>Organizer:</strong> ' . esc_html($organizer) . '</p>';
        }
        $details .= '</div>';

        // Prepend details before main content
        return $details . $content;
    }
}
