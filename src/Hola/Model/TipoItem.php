<?php

namespace Hola\Model;

use \JsonSerializable;

class TipoItem implements JsonSerializable{

	private $tipo;
	private $item;

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