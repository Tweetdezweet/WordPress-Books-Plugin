<?php

namespace oxfambooks;

class OxfamBook {

	public function __construct() {
		add_action( 'wp_ajax_addtostock', array( $this, 'add_to_stock' ) );
	}

	public function search_by_isbn( $isbn ) {
		$product_id = \wc_get_product_id_by_sku( $isbn );

		if( $product_id != 0 ) {
			$product_attributes = get_post_meta( $product_id, '_product_attributes', true );
			$post = get_post( $product_id );

			return array(
				'title' => $post->post_title,
				'subtitle' => $product_attributes['subtitle']['value'],
				'authors' => $product_attributes['authors']['value'],
				'language' => $product_attributes['language']['value'],
				'description' => $post->post_content,
				'pageCount' => $product_attributes['page_count']['value'],
				'publishedDate' => $product_attributes['published_date']['value'],
				'price' => get_post_meta( $product_id, '_price', true),
			);
		} else {
			return array();
		}
	}

	public function add_to_stock( $data ) {

	}
}