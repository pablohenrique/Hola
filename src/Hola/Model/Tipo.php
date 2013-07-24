<?php

namespace Hola\Model;

use \JsonSerializable;

class Tipo implements JsonSerializable{
	private $nome;

	public function __construct($nome = null){
		if(!is_null($nome))
			self::setNome($nome);
	}

	/*GETTERS*/
	public function getNome(){ return $this->nome; }

	/*SETTERS*/
	public function setNome($input){ $this->nome = $input; }

	/*OTHERS*/
	public function JsonSerialize() {
        return [
            'nome' => $this->getNome()
        	];
    }

}

?>