<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class EM_Events_CPT {

    public function __construct() {
        // Register CPT
        add_action( 'init', [ $this, 'register_event_cpt' ] );

        // Meta boxes
        add_action( 'add_meta_boxes', [ $this, 'register_meta_boxes' ] );

        // Save meta fields
        add_action( 'save_post_event', [ $this, 'save_event_meta' ] );
    }

    /**
     * Register Custom Post Type: Event
     */
    public function register_event_cpt() {
        $labels = [
            'name'               => 'Events',
            'singular_name'      => 'Event',
            'menu_name'          => 'Events',
            'name_admin_bar'     => 'Event',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Event',
            'new_item'           => 'New Event',
            'edit_item'          => 'Edit Event',
            'view_item'          => 'View Event',
            'all_items'          => 'All Events',
            'search_items'       => 'Search Events',
            'not_found'          => 'No events found.',
            'not_found_in_trash' => 'No events found in Trash.',
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'show_in_menu'       => true,
            'menu_icon'          => 'dashicons-calendar',
            'supports'           => [ 'title', 'editor', 'thumbnail' ],
            'has_archive'        => true,
            'rewrite'            => [ 'slug' => 'events' ],
            'show_in_rest'       => true, // Gutenberg + REST API support
        ];

        register_post_type( 'event', $args );
    }

    /**
     * Register meta boxes
     */
    public function register_meta_boxes() {
        add_meta_box(
            'event_details',
            'Event Details',
            [ $this, 'render_event_meta_box' ],
            'event',
            'normal',
            'high'
        );
    }

    /**
     * Render Event Meta Box fields
     */
    public function render_event_meta_box( $post ) {
        // Get saved values
        $date      = get_post_meta( $post->ID, 'event_date', true );
        $location  = get_post_meta( $post->ID, 'event_location', true );
        $organizer = get_post_meta( $post->ID, 'event_organizer', true );

        ?>
        <p>
            <label for="event_date"><strong>Date:</strong></label><br>
            <input type="date" name="event_date" id="event_date" value="<?php echo esc_attr( $date ); ?>" />
        </p>
        <p>
            <label for="event_location"><strong>Location:</strong></label><br>
            <input type="text" name="event_location" id="event_location" value="<?php echo esc_attr( $location ); ?>" style="width:100%;" />
        </p>
        <p>
            <label for="event_organizer"><strong>Organizer:</strong></label><br>
            <input type="text" name="event_organizer" id="event_organizer" value="<?php echo esc_attr( $organizer ); ?>" style="width:100%;" />
        </p>
        <?php
    }

    /**
     * Save Event Meta Box values
     */
    public function save_event_meta( $post_id ) {
        // Prevent autosave overwrite
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        // Verify post type
        if ( get_post_type( $post_id ) !== 'event' ) return;

        // Save fields if set
        if ( isset( $_POST['event_date'] ) ) {
            update_post_meta( $post_id, 'event_date', sanitize_text_field( $_POST['event_date'] ) );
        }
        if ( isset( $_POST['event_location'] ) ) {
            update_post_meta( $post_id, 'event_location', sanitize_text_field( $_POST['event_location'] ) );
        }
        if ( isset( $_POST['event_organizer'] ) ) {
            update_post_meta( $post_id, 'event_organizer', sanitize_text_field( $_POST['event_organizer'] ) );
        }
    }
}