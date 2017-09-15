<?php

namespace oxfambooks;


class OxfamAdminPages {

	public function __construct() {
		add_action('admin_menu', array( $this, 'register_submenu_page' ), 99 );
		add_action( 'admin_init', array( $this, 'settings_init' ) );
	}

	function register_submenu_page() {
		$menu_page = add_menu_page(
			'Oxfam Secondhand books',
			'Oxfam Secondhand books',
			'manage_options',
			'oxfam-books-submenu-page',
			array( $this, 'oxfam_books_submenu_page_callback' )
		);

		add_action( 'admin_print_styles-' . $menu_page, array( $this, 'add_stylesheets' ) );
		add_action( 'admin_print_scripts-' . $menu_page, array( $this, 'add_scripts' ) );

		$this->add_google_api_options_page();
	}

	function oxfam_books_submenu_page_callback() {
		include_once __DIR__ . '/../views/book.php';
	}
	function add_stylesheets() {
		wp_enqueue_style( 'oxfam_stylesheet', plugin_dir_url( __FILE__) . '../css/book.css' );
	}

	function add_scripts() {
		wp_enqueue_script( 'oxfam_script', plugin_dir_url( __FILE__) . '../js/book.js' );
		wp_enqueue_script( 'jquery' );
	}

	public function settings_init() {
		register_setting( 'oxfam', 'oxfam_options' );

		// register a new section in the "wporg" page
		add_settings_section(
			'oxfam_google_api_section',
			__( 'Google book api settings.', 'oxfambooks' ),
			array( $this, 'oxfam_google_api_section_callback'),
			'oxfam-google-api-settings'
		);

		// register a new field in the "wporg_section_developers" section, inside the "wporg" page
		add_settings_field(
			'oxfam_google_book_api_key', // as of WP 4.6 this value is used only internally
			// use $args' label_for to populate the id inside the callback
			__( 'Google Book API key', 'oxfambooks' ),
			array( $this, 'oxfam_google_api_key_field_callback' ),
			'oxfam-google-api-settings',
			'oxfam_google_api_section',
			[
				'label_for' => 'oxfam_google_book_api_key',
				'class' => 'oxfam-api-settings-field',
				'oxfam_custom_data' => 'custom',
			]
		);
	}

	public function oxfam_google_api_key_field_callback( $args ) {
		// get the value of the setting we've registered with register_setting()
		$options = get_option( 'oxfam_options' );
		// output the field
		?>
		<input id="<?php echo esc_attr( $args['label_for'] ); ?>" name="oxfam_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo $options[esc_attr( $args['label_for'])] ?>" />
		<?php
	}

	public function add_google_api_options_page() {
		add_submenu_page(
			'oxfam-books-submenu-page',
			'Google Book Api Settings',
			'Google API',
			'manage_options',
			'oxfam-google-api-settings',
			array( $this, 'submenupage_callback')
		);
	}

	public function oxfam_google_api_section_callback() {
		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Enter the google api key here.', 'oxfambooks' ); ?></p>
		<?php
	}

	public function submenupage_callback() {
		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// add error/update messages

		// check if the user have submitted the settings
		// wordpress will add the "settings-updated" $_GET parameter to the url
		if ( isset( $_GET['settings-updated'] ) ) {
			// add settings saved message with the class of "updated"
			add_settings_error( 'oxfam_messages', 'oxfam_message', __( 'Settings Saved', 'wporg' ), 'updated' );
		}

		// show error/update messages
		settings_errors( 'oxfam_messages' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php
				// output security fields for the registered setting "wporg"
				settings_fields( 'oxfam' );
				// output setting sections and their fields
				// (sections are registered for "wporg", each field is registered to a specific section)
				do_settings_sections( 'oxfam-google-api-settings' );
				// output save settings button
				submit_button( 'Save Settings' );
				?>
			</form>
		</div>
		<?php
	}
}