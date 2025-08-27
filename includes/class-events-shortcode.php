<?php
class EM_Events_Shortcode {
    public function __construct() {
        add_shortcode( 'events_list', [ $this, 'render_events' ] );
    }

    public function render_events() {
        $args = [
            'post_type' => 'event',
            'meta_key'  => 'event_date',
            'orderby'   => 'meta_value',
            'order'     => 'ASC',
            'posts_per_page' => -1,
            'meta_type'      => 'DATE',
        ];
        $query = new WP_Query($args);
        $output = '<div class="events-list">';

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $date = get_post_meta(get_the_ID(), 'event_date', true);
                $location = get_post_meta(get_the_ID(), 'event_location', true);
                $organizer = get_post_meta(get_the_ID(), 'event_organizer', true);
                $output .= "<div class='event-item'>
                    <h3>". get_the_title() ." </h3>
                    <p><strong>Date:</strong> $date</p>
                    <p><strong>Location:</strong> $location</p>
                    <p><strong>Organizer:</strong> $organizer</p>
                    <p>". get_the_content() ."</p> 
                </div>";
            }
        } else {
            $output .= "<p>No upcoming events.</p>";
        }

        wp_reset_postdata();
        return $output . '</div>';
    }
}