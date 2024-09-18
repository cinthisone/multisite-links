<?php
/*
Plugin Name: Multisite Links
Plugin URI: https://example.com
Description: A simple plugin to display links to all sub-sites in a WordPress multisite network.
Version: 1.0
Author: Your Name
Author URI: https://example.com
License: GPL2
*/

// Function to fetch and display all sub-site URLs
function display_multisite_links() {
    // Ensure the site is part of a multisite network
    if ( ! is_multisite() ) {
        return 'This is not a multisite network.';
    }

    // Get all the sites in the network
    $sites = get_sites();

    if ( empty( $sites ) ) {
        return 'No sites found in this network.';
    }

    // Start building the output
    $output = '<ul>';

    foreach ( $sites as $site ) {
        $site_url = get_site_url( $site->blog_id ); // Get the URL of the sub-site
        $output .= '<li><a href="' . esc_url( $site_url ) . '">' . esc_html( $site_url ) . '</a></li>';
    }

    $output .= '</ul>';

    return $output; // Return the list of site URLs
}

// Register a shortcode [multisite_links] to display the links
function register_multisite_links_shortcode() {
    add_shortcode( 'multisite_links', 'display_multisite_links' );
}

// Hook the shortcode registration function
add_action( 'init', 'register_multisite_links_shortcode' );
