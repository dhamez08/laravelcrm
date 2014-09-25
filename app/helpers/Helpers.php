<?php
class Helpers {

	// http://magp.ie/2013/04/17/search-associative-array-with-wildcard-in-php/
    public static function array_key_exists_wildcard ( $array, $search, $return = '' ) {
		$search = str_replace( '\*', '.*?', preg_quote( $search, '/' ) );
		$result = preg_grep( '/^' . $search . '$/i', array_keys( $array ) );
		if ( $return == 'key-value' )
			return array_intersect_key( $array, array_flip( $result ) );
		return $result;
	}

	public static function array_value_exists_wildcard ( $array, $search, $return = '' ) {
		$search = str_replace( '\*', '.*?', preg_quote( $search, '/' ) );
		$result = preg_grep( '/^' . $search . '$/i', array_values( $array ) );
		if ( $return == 'key-value' )
			return array_intersect( $array, $result );
		return $result;
	}
	// http://magp.ie/2013/04/17/search-associative-array-with-wildcard-in-php/

}
