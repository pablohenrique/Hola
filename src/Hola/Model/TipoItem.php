<?php

/*
 * Esta parte foi parada devido a uma mudanca no Hola. Sera continuada quando sair da versao alpha.
*/

namespace Hola\Model;

use \JsonSerializable,
	Hola\util\LazyDelCollection;

class TipoItem implements JsonSerializable{

	private $tipo;
	private $item;

	public function __construct(Tipo $tipo = null, $item = null){
		self::setTipo($tipo);
		if(!is_null($item))
			foreach ($item as $value)
				self::setItem($value);
	}

	/*GETTERS*/
	public function getTipo(){ return $this->tipo; }
	public function getItem(){ return $this->item; }

	/*SETTERS*/
	public function setTipo(Tipo $input){ $this->tipo = $input; }
	public function setItem(Item $input){ $this->item = $input; }

	/*OTHERS*/
	public function JsonSerialize() {
        return [
            'tipo' => $this->getTipo(),
            'item' => $this->getItem()
        	];
    }

}

?>