<?php

namespace WPPPT;

class PluginPublic {

	public function __construct( $plugin ){
		$this->plugin = $plugin;
	}

	public function register_post_types(){

		$args = array(
			'label'  => 'Podcast',
			'labels' => array(
				'name'          => 'Podcasts',
				'singular_name' => 'Podcast',
			),
			'public'      => true,
			'supports' =>   array(
				'title',
				'editor',
				'thumbnail',
			),
			'has_archive' => 'podcasts'
		);

		register_post_type( 'podcast', $args );

	}

	public function register_tags(){
		register_taxonomy_for_object_type( 'post_tag', 'attachment' );
		register_taxonomy_for_object_type( 'post_tag', 'podcast' );
	}

	public function connect_post_types(){
		if( function_exists('p2p_register_connection_type') ){
			add_action( 'p2p_init', function () {

				p2p_register_connection_type( array(
					'name' => 'attachment_to_podcast',
					'from' => 'attachment',
					'to' => 'podcast'
				) );

				p2p_register_connection_type( array(
					'name' => 'podcast_to_product',
					'from' => 'podcast',
					'to' => 'product'
				) );

				p2p_register_connection_type( array(
					'name' => 'attachment_to_product',
					'from' => 'attachment',
					'to' => 'product'
				) );

			});
		}
	}
}
