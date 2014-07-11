<?php
	class Timber_BuddyPress {
		
		function __construct() {
			add_filter('timber_post_getter_posts', array($this,'timber_post_getter_posts'));
		}

		/*
		 * Inject BuddyPress content into TimberPost.
		 *
		 * If BuddyPress detects a page that has BuddyPress content it bypasses the content loop, 
		 * replacing it with BuddyPress content. 
		 * This causes TimberPostGetter::get_posts to always return a single post without content.
		 */

		function timber_post_getter_posts($posts) {
			global $wp_query;

			if (is_buddypress()) {

				/*
				 * Trick BuddyPress to think we are in the loop
				 */
				$wp_query->in_the_loop = true;
				
				/*
				 * Inject BuddyPress content
				 */
				$posts[0]->content = apply_filters('the_content',get_the_content());
			}
			return $posts;
		}

	}
	
	new Timber_BuddyPress();