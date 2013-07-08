<?php

namespace Hola\Service;

class Security{
	public static function filterCharacters($input){		
		preg_match_all("/[a-zA-Z0-9_!@#$^&*.]/", $input, $match);
		return implode('', $match[0]);
	}

	public static function preventXSS($input){
		return strip_tags(htmlspecialchars($input));
	}

	public static function filterNumbers($input){
		if(is_null($input))
			return null;
		preg_match_all("/[0-9]/", $input, $match);
		return implode('', $match[0]);
	}
}

?>