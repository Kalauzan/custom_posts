<?php
/**
*------------------------------------------------------------------------------------------------
* :: ABORT IF DIRECTY ACCESSED
*------------------------------------------------------------------------------------------------
*/
if(!defined('ABSPATH')){
	exit;
}
/**
*-----------------------------------------------------------------------------------------------
* :: CUSTOM POST ONE
*------------------------------------------------------------------------------------------------
*/

class Plugin_Custom_Posts {

	//public $singular = "food";
		
	public function __construct(){
		$this->register_custom_posts();
		$this->register_custom_taxonomies();
	}
	public function register_custom_posts(){
		$singular = apply_filters("custom_posts","food");
		$singular_uc = ucwords($singular);
		$plural = $singular . "s";
		$plural_uc = ucwords($plural);
		$plugin_text_domain = 'custom_posts';
		$labels = array(
			'name'               => _x( $plural_uc, 'post type general name', $plugin_text_domain ),
			'singular_name'      => _x( 'Book', 'post type singular name', $plugin_text_domain ),
			'menu_name'          => _x( $plural_uc, 'admin menu', $plugin_text_domain ),
			'name_admin_bar'     => _x( $singular_uc, 'add new on admin bar', $plugin_text_domain ),
			'add_new'            => _x( 'Add New', 'book', $plugin_text_domain ),
			'add_new_item'       => __( 'Add New '.$singular_uc, $plugin_text_domain ),
			'new_item'           => __( 'New Book', $plugin_text_domain ),
			'edit_item'          => __( 'Edit '.$singular_uc, $plugin_text_domain ),
			'view_item'          => __( 'View '.$singular_uc, $plugin_text_domain ),
			'all_items'          => __( 'All '.$plural_uc, $plugin_text_domain ),
			'search_items'       => __( 'Search '.$plural_uc, $plugin_text_domain ),
			'parent_item_colon'  => __( 'Parent Books:', $plugin_text_domain ),
			'not_found'          => __( 'No '.$plural.' found.', $plugin_text_domain ),
			'not_found_in_trash' => __( 'No '.$plural.' found in Trash.', $plugin_text_domain )
		);
	
		$args = array(
			'labels'             => $labels,
	                'description'        => __( 'Description.', $plugin_text_domain ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $singular ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);
	
		register_post_type( $singular, $args );
	}
	
	public function register_custom_taxonomies(){
		// Add new taxonomy, make it hierarchical (like categories)
		$domain = apply_filters('plugin_domain','plugin_textdomain');
		$labels = array(
			'name'              => _x( 'Genres', $domain ),
			'singular_name'     => _x( 'Genre', $domain ),
			'search_items'      => __( 'Search Genres', $domain),
			'all_items'         => __( 'All Genres', $domain),
			'parent_item'       => __( 'Parent Genre', $domain ),
			'parent_item_colon' => __( 'Parent Genre:', $domain ),
			'edit_item'         => __( 'Edit Genre', $domain ),
			'update_item'       => __( 'Update Genre', $domain ),
			'add_new_item'      => __( 'Add New Genre', $domain ),
			'new_item_name'     => __( 'New Genre Name', $domain ),
			'menu_name'         => __( 'Heroes', $domain ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'heroes' ),
		);
		register_taxonomy( 'vegetable', array( 'food' ), $args );
		// Add new taxonomy, NOT hierarchical (like tags)
		$labels = array(
			'name'                       => _x( 'Writers', $domain ),
			'singular_name'              => _x( 'Writer', $domain ),
			'search_items'               => __( 'Search Writers', $domain ),
			'popular_items'              => __( 'Popular Writers', $domain ),
			'all_items'                  => __( 'All Writers', $domain ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Writer', $domain ),
			'update_item'                => __( 'Update Writer', $domain ),
			'add_new_item'               => __( 'Add New Writer', $domain ),
			'new_item_name'              => __( 'New Writer Name', $domain ),
			'separate_items_with_commas' => __( 'Separate writers with commas', $domain ),
			'add_or_remove_items'        => __( 'Add or remove writers', $domain ),
			'choose_from_most_used'      => __( 'Choose from the most used writers', $domain ),
			'not_found'                  => __( 'No writers found.', $domain ),
			'menu_name'                  => __( 'Heroines', $domain ),
		);
		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'heroines' ),
		);
		register_taxonomy( 'taste', 'food', $args );
	}
}
function plugin_custom_posts(){
	$posts = new Plugin_Custom_Posts;
}
add_action('init','plugin_custom_posts');

//	TO REWRITE THE SLUG, IF PROBLEM GO TO SETTINGS AND SAVE AGAIN AND RELOAD THE PAGE
function theme_rewrite_flush() {
    plugin_custom_posts();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'theme_rewrite_flush' );
