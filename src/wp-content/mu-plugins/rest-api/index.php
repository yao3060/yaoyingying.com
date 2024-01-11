<?php

add_action( 'rest_api_init', function () {

	register_rest_route( 'wp/v2', 'nav-menus', array(
	    'methods' => 'GET',
	    'callback' => function() {
		 // Replace your menu name, slug or ID carefully
		 return wp_get_nav_menus();
	    },
	    
	) );
   
	register_rest_route( 'wp/v2', 'nav-menus/(?P<slug>[\w-]+)', array(
	    'methods' => 'GET',
	    'callback' => function(WP_REST_Request  $request) {
		 // Replace your menu name, slug or ID carefully
		 return wp_get_nav_menu_items($request->get_param('slug'));
	    },
	    
	) );
   } );