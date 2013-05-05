<?php

namespace Hola\Model;

use \JsonSerializable;

interface IModel{
	
	/**
	 * Usado em cada classe model. Transforma um objeto PHP em JSON
	 *@return JSONSerialible array
	 */
	public function JsonSerialize();

}

?>