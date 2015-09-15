<?php

/*
Plugin Name: BuddyPress for Timber
Plugin URI:  https://github.com/slimndap/TimberBuddyPress
Description: Add Buddypress support to the Timber plugin.
Version: 1.1
Author: Jeroen Schmit, Slim & Dapper
*/

/**
 * Load only when BuddyPress is present.
 */
function timber_bp_include() {
	require( dirname( __FILE__ ) . '/timber_buddypress.php' );
}
add_action( 'bp_include', 'timber_bp_include' );
