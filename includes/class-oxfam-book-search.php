<?php
/**
 * Created by PhpStorm.
 * User: koen
 * Date: 08.09.17
 * Time: 10:23
 */

namespace oxfambooks;

require_once __DIR__ . '/class-oxfam-book.php';
require_once  __DIR__ . '/class-oxfam-google-book-api.php';

class OxfamBookSearch {

	private $google_api;
	private $oxfam_book;

	public function __construct() {
		$this->google_api = new OxfamGoogleBookApi();
		$this->oxfam_book = new OxfamBook();

		add_action( 'wp_ajax_searchbookbyisbn', array( $this, 'get_books_by_isbn') );
	}

	public function get_books_by_isbn() {
		$isbn = $_GET['isbn'];

		$results_from_database = $this->oxfam_book->search_by_isbn( $isbn );

		if( sizeof( $results_from_database ) > 0  ) {
			wp_send_json_success( $results_from_database );
		} else {
			$this->get_books_from_google_api( $isbn );
		}
	}

	private function get_books_from_google_api( $isbn ) {
		$results_from_google = $this->google_api->search_book( $isbn );
		if ( sizeof( $results_from_google ) > 0 ) {
			wp_send_json_success( $results_from_google );
		} else {
			wp_send_json_error( array() );
		}
	}
}