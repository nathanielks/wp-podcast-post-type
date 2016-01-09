<?php

namespace Podcast_Clips;

class PluginPublic {

	public function __construct( $plugin ){
		$this->plugin = $plugin;
	}

	public function register_post_types(){

		$args = array(
			'label'    => 'Podcast Clips',
			'public'   => true,
			'supports' => array(
				'title',
				'custom-fields'
			),
		);

		register_post_type( 'podcast_clip', $args );

	}

	public function connect_post_types(){
		if( function_exists('p2p_register_connection_type') ){
			add_action( 'p2p_init', function () {
				p2p_register_connection_type( array(
					'name' => 'podcast_clip_to_product',
					'from' => 'podcast_clip',
					'to' => 'product'
				) );
			});
		}
	}
}
