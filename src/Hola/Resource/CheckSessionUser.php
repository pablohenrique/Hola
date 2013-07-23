<?php
namespace Hola\Resource;

class CheckSessionUser{
	
	public static function check($sessionUser, $user){
		if(strcmp($sessionUser, $user) != 0)
			throw new Exception("Error while doing Atomic operation. Don't you dare do that again... OK? =]");
	}

}

?>