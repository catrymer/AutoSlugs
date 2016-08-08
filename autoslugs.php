<?php
/*
Plugin Name: Autoslugs
Description: A plugin to create easy to read post slugs for posts that don't have titles.
Version:     1.0
Author:      Cat Rymer
License:     GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

class CR_Auto_Slug {

	function __construct() {
		add_filter( 'wp_insert_post_data', array($this, 'build_slug'), 10, 2 );
	}

	function build_slug( $data, $postarr ){
		if( $data['post_title'] == FALSE ) { 
			$fetus_slug = $this->slug_words( $data['post_content'] );           
			$clean_slug = sanitize_title( $fetus_slug );
			$data['post_name'] = $clean_slug;
		}
    		return $data;
	}

	function slug_words ( $content ) { 
		$clean_content = strip_tags( $content ); 
		$blastocyst_slug = str_word_count( $clean_content, 1, '0123456789' );   
		$embryo_slug = array_slice( $blastocyst_slug, 0, 5 );
		$fetus_slug = implode( " ", $embryo_slug );
		return $fetus_slug;
	}
	
}

new CR_Auto_Slug;
