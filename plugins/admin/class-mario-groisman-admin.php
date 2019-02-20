<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/Jose-Luziarte-Kindle
 * @since      1.0.0
 *
 * @package    Mario_Groisman
 * @subpackage Mario_Groisman/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mario_Groisman
 * @subpackage Mario_Groisman/admin
 * @author     José Luziarte <jose.luziarte@agenciakindle.com.br>
 */
class Mario_Groisman_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mario_Groisman_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mario_Groisman_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mario-groisman-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mario_Groisman_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mario_Groisman_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mario-groisman-admin.js', array( 'jquery' ), $this->version, false );

	}
	/**
	 * Registrar opção de configurações de Header e Footer
	 *
	 * @since    1.0.0
	 */
	public function mg_admin_options_page() {
		if( !is_admin() ){ return; }
		if( function_exists('acf_add_options_page') ) {
	
			if( function_exists('acf_add_options_page') ) {
				acf_add_options_page(array(
					'page_title' 	=> 'Mg configurações',
					'menu_title'	=> 'Ajustes do Site',
					'menu_slug' 	=> 'mg_general_settings',
					'capability'	=> 'manage_options',
					'position'	    => 20,
				));

				acf_add_options_sub_page(array(
					'page_title' 	=> 'Cabeçalho',
					'menu_title'	=> 'Cabeçalho',
					'parent_slug'	=> 'mg_general_settings',
				));

				acf_add_options_sub_page(array(
					'page_title' 	=> 'WebDoor',
					'menu_title'	=> 'WebDoor',
					'parent_slug'	=> 'mg_general_settings',
				));

				acf_add_options_sub_page(array(
					'page_title' 	=> 'A clinica',
					'menu_title'	=> 'A clinica',
					'parent_slug'	=> 'mg_general_settings',
				));

				acf_add_options_sub_page(array(
					'page_title' 	=> 'Odontologia Digital',
					'menu_title'	=> 'Odontologia Digital',
					'parent_slug'	=> 'mg_general_settings',
				));
				
				acf_add_options_sub_page(array(
					'page_title' 	=> 'Áudios, artigos, mídias e livros',
					'menu_title'	=> 'Publicações',
					'parent_slug'	=> 'mg_general_settings',
				));
				
				acf_add_options_sub_page(array(
					'page_title' 	=> 'Clinicas',
					'menu_title'	=> 'Endereços',
					'parent_slug'	=> 'mg_general_settings',
				));
				
				acf_add_options_sub_page(array(
					'page_title' 	=> 'Rodapé',
					'menu_title'	=> 'Rodapé',
					'parent_slug'	=> 'mg_general_settings',
				));
			}
		}
	}

	public function mg_post_types() {
		$post_types = array(
				'Tratamentos'  => array(
				'plural'       => 'Tratamentos',
				'singular'     => 'Tratamento',
				'menu-icon'    => 'dashicons-list-view',
				'category'     => 'slides-category',
			),
		);

		$support = array(
			'title',
			'excerpt',
			'editor',
			'custom-fields',
			'revisions',
			'trackback',
			'thumbnail',
			'author',
		);

		foreach ( $post_types as $slug => $info ) {
			$labels = array(
				'name'          => $info['plural'],
				'singular_name' => $info['singular'],
				'add_new'       => 'Adicionar ' . $info['singular'],
				'add_new_item'  => 'Nova ' . $info['singular'],
				'edit_item'     => 'Editar ' . $info['singular'],
				'menu_name'     => $info['plural'],
			);

			$args = array(
				'labels'           => $labels,
				'public'           => true,
				'slug'             => true,
				'public_queryable' => true,
				'show_ui'          => true,
				'query_var'        => true,
				'capability_type'  => 'post',
				'supports'         => $support,
				'description'      => true,
				'menu_icon'        => $info['menu-icon'],
				'taxonomies'       => array( $info['category'] ),
				'menu_position'    => 20,
			);

			register_post_type( $slug, $args );
		}
	}
	
}