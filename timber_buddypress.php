<?php
	/*
	 * Trick BuddyPress to think we are in the loop.
	 *
	 * Whenever BuddyPress detects a page that has BuddyPress content it wipes all posts from wp_query.
	 * It then adds a new post with the BuddyPress content.
	 * This however relies on being in the loop, which isn't used by Timber.
	 */

	class Timber_BuddyPress {
		
		function __construct() {
			if (has_action('timber_post_init')) {
				add_action('timber_post_init',array($this,'timber_post_init'));
			}
			else {
				/**
				 * @since 1.1	The 'timber_post_init' action no longer exists in newer versions of Timber, use 'wp'.
				 */
				add_action('wp',array($this,'wp'));
			}
		}

		function wp($wp) {
			$this->trick_buddypress();
		}
		function timber_post_init($post) {
			$this->trick_buddypress();
		}

		function trick_buddypress() {
			global $wp_query;

			if (is_buddypress()) {
				$wp_query->in_the_loop = true;				
			}			
		}
	}
	
	new Timber_BuddyPress();