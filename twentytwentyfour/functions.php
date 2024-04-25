<?php
/**
 * Twenty Twenty-Four functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty-Four
 * @since Twenty Twenty-Four 1.0
 */

/**
 * Register block styles.
 * 
 * 
 * 
 */

// Add custom code to intercept form submissions and convert radio button values to integers
add_action( 'forminator_custom_form_submit_before', 'convert_radio_to_int', 10, 2 );

function convert_radio_to_int( $entry_data, $entry_id ) {
    // Specify the field IDs of the radio buttons you want to convert to integers
    $field_ids = array( radio-1, radio-2, radio-3, radio-4, radio-5, radio-6, radio-7, radio-8 );

    foreach ( $field_ids as $field_id ) {
        // Check if the field ID exists in the submitted data
        if ( isset( $entry_data[ $field_id ] ) ) {
            // Convert the value to an integer
            $entry_data[ $field_id ] = intval( $entry_data[ $field_id ] );
        }
    }

    // Update the Forminator entry data with the modified values
    Forminator_Form_Entry_Model::update_entry( $entry_id, $entry_data );
}


if ( ! function_exists( 'twentytwentyfour_block_styles' ) ) :
    /**
     * Register custom block styles
     *
     * @since Twenty Twenty-Four 1.0
     * @return void
     */
    function twentytwentyfour_block_styles() {

        register_block_style(
            'core/details',
            array(
                'name'         => 'arrow-icon-details',
                'label'        => __( 'Arrow icon', 'twentytwentyfour' ),
                /*
                 * Styles for the custom Arrow icon style of the Details block
                 */
                'inline_style' => '
                .is-style-arrow-icon-details {
                    padding-top: var(--wp--preset--spacing--10);
                    padding-bottom: var(--wp--preset--spacing--10);
                }

                .is-style-arrow-icon-details summary {
                    list-style-type: "\2193\00a0\00a0\00a0";
                }

                .is-style-arrow-icon-details[open]>summary {
                    list-style-type: "\2192\00a0\00a0\00a0";
                }',
            )
        );
        // Add your other block styles here
    }
endif;

add_action( 'init', 'twentytwentyfour_block_styles' );

/**
 * Enqueue block stylesheets.
 */

if ( ! function_exists( 'twentytwentyfour_block_stylesheets' ) ) :
    /**
     * Enqueue custom block stylesheets
     *
     * @since Twenty Twenty-Four 1.0
     * @return void
     */
    function twentytwentyfour_block_stylesheets() {
        // Add your block stylesheets here
    }
endif;

add_action( 'init', 'twentytwentyfour_block_stylesheets' );

/**
 * Register pattern categories.
 */

if ( ! function_exists( 'twentytwentyfour_pattern_categories' ) ) :
    /**
     * Register pattern categories
     *
     * @since Twenty Twenty-Four 1.0
     * @return void
     */
    function twentytwentyfour_pattern_categories() {

        register_block_pattern_category(
            'twentytwentyfour_page',
            array(
                'label'       => _x( 'Pages', 'Block pattern category', 'twentytwentyfour' ),
                'description' => __( 'A collection of full page layouts.', 'twentytwentyfour' ),
            )
        );
    }
endif;

add_action( 'init', 'twentytwentyfour_pattern_categories' );

function display_radar_chart() {
   ob_start(); // 출력 버퍼링 시작
   include 'graph_template.php'; 
   $output = ob_get_clean();
   return $output;
}

add_shortcode('display_graph', 'display_radar_chart');