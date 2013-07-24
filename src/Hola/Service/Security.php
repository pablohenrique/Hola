<?php

namespace Hola\Service;

class Security{
	public static function filterCharacters($input){
		preg_match_all("/[a-zA-Z0-9_!@#$^&*.]/", substr($input, 0, 20), $match);
		return implode('', $match[0]);
	}

	public static function filterLetters($input){
		preg_match_all("/\w/", substr($input, 0, 20), $match);
		return implode('', $match[0]);
	}

	public static function preventXSS($input){
		return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
	}

	public static function filterNumbers($input){
		if(is_null($input))
			return null;
		preg_match_all("/[0-9]/", substr($input, 0, 11), $match);
		return implode('', $match[0]);
	}

	public static function encrypt($target,$helper){
		return crypt($target,md5($helper . substr($helper, 0, 3)));
	}
}

?>