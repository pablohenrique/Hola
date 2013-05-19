<?php

namespace Hola\Model;

use \JsonSerializable;

class Tipo implements JsonSerializable{

	private $id;
	private $nome;

	/*GETTERS*/
	public function getId(){ return $this->id; }
	public function getNome(){ return $this->nome; }

	/*SETTERS*/
	public function setId($input){ $this->id = $input; }
	public function setNome($input){ $this->nome = $input; }

	/*OTHERS*/
	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome()
        	];
    }

}

?>