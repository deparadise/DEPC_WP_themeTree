<?php
/* Admin top bar configuration */
function control_top_admin_bar() {
	if (!current_user_can('administrator')){
		global $wp_admin_bar;
		//$wp_admin_bar->remove_menu('wp-logo');
		//$wp_admin_bar->remove_menu('site-name');
		$wp_admin_bar->remove_node( 'view-site' );
		//$wp_admin_bar->remove_menu('comments');
		//$wp_admin_bar->remove_menu('new-content');

		//$wp_admin_bar->remove_menu('my-account');
		// $wp_admin_bar->add_node(array(
		// 	'id' => 'logoutSimple',
		// 	'title' => 'Log Out',
		// 	'href' => ''
		// ));		
	}
}
add_action( 'wp_before_admin_bar_render', 'control_top_admin_bar' );


/* Determines what admin menus are available for the current user */
function user_menu_control() {
	if (current_user_can('administrator')) {
		//remove_menu_page( 'index.php' );                  //Dashboard
		//remove_menu_page( 'jetpack' );                    //Jetpack* 
		//remove_menu_page( 'edit.php' );                   //Posts
		//remove_menu_page( 'upload.php' );                 //Media
		//remove_menu_page( 'edit.php?post_type=page' );    //Pages
		//remove_menu_page( 'edit-comments.php' );          //Comments
		//remove_menu_page( 'themes.php' );                 //Appearance
		//remove_menu_page( 'plugins.php' );                //Plugins
		//remove_menu_page( 'users.php' );                  //Users
		//remove_menu_page( 'tools.php' );                  //Tools
		//remove_menu_page( 'options-general.php' );        //Settings
	
	}elseif (current_user_can('editor')){
		//remove_menu_page( 'index.php' );                  //Dashboard
		//remove_menu_page( 'edit.php' );                   //Posts
		//remove_menu_page( 'edit.php?post_type=page' );    //Pages
		//remove_menu_page( 'upload.php' );                 //Media
		remove_menu_page( 'edit-comments.php' );          //Comments

		//remove_menu_page( 'profile.php' );					// Profile
		remove_menu_page( 'tools.php' );                  //Tools
		remove_menu_page( 'options-general.php' ); 		//Settings

	}elseif (current_user_can('author')){
		//remove_menu_page( 'index.php' );                  //Dashboard
		//remove_menu_page( 'edit.php' );                   	//Posts
		//remove_menu_page( 'upload.php' );                 //Media
		remove_menu_page( 'edit-comments.php' );          	//Comments

		//remove_menu_page( 'profile.php' );					// Profile
		remove_menu_page( 'tools.php' );                  	//Tools
		remove_menu_page( 'options-general.php' ); 		//Settings
	}
}
add_action( 'admin_menu', 'user_menu_control' );

