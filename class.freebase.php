<?php
class Freebase {

	private $api_key;


	public function __construct( $api_key ) {

		$this->api_key = $api_key;
	}

	public function search( $query = '', $start = 0, $limit = 10, $exact = 'false' ) {

		$query = urlencode( $query );
		$url  = 'https://www.googleapis.com/freebase/v1/search?query='. $query;
		$url .= '&start=' . $start;
		$url .= '&limit=' . $limit;
		$url .= '&exact=' . $exact;
		$url .= '&key=' . $this->api_key;

		$freebase_results = @file_get_contents( $url );

		if ( !empty( $freebase_results ) ) {
			$decoded = json_decode( $freebase_results, true );
			return $decoded['result'];
		}
	}



	public function image( $entity_id, $max_width = 150, $max_height = 150 ) {

		$url = 'https://usercontent.googleapis.com/freebase/v1/image' . $entity_id;
		$url .= '?maxwidth=' . $max_width;
		$url .= '&maxheight=' . $max_height;
		$url .= '&key=' . $this->api_key;

		return $url;
	}

	public function text( $entity_id, $max_length = '0' ) {

		$url  = 'https://www.googleapis.com/freebase/v1/text/' . $entity_id;
		$url .= '?maxlength=' . $max_length;
		$url .= '&key=' . $this->api_key;

		$freebase_results = @file_get_contents( $url );

		if ( !empty( $freebase_results ) ) {
			$decoded = json_decode( $freebase_results, true );
			return $decoded['result'];
		}

	}

	public function topic( $entity_id ) {

		$url = 'https://www.googleapis.com/freebase/v1/topic' . $entity_id;

		$freebase_results = @file_get_contents( $url );

		if ( !empty( $freebase_results ) ) {
			return json_decode( $freebase_results, true );
		}

	}
}
