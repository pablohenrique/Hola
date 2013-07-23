<?php

namespace Hola\Service;

class Security{
	public static function filterCharacters($input){
		$input = substr($input, 0, 20);
		preg_match_all("/[a-zA-Z0-9_!@#$^&*.]/", $input, $match);
		return implode('', $match[0]);
	}

	public static function preventXSS($input){
		return htmlspecialchars(strip_tags($input), ENT_QUOTES, 'UTF-8');
	}

	public static function filterNumbers($input){
		if(is_null($input))
			return null;
		$input = substr($input, 0, 11);
		preg_match_all("/[0-9]/", $input, $match);
		return implode('', $match[0]);
	}

	public static function encrypt($target,$helper){
		return crypt($target,md5($helper . substr($helper, 0, 3)));
	}
}

?>