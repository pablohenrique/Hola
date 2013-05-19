<?php

namespace Hola\Model;

use \JsonSerializable;

class Item implements JsonSerializable{

	private $id;
	private $nome;
	private $usuario = null;

	/*GETTERS*/
	public function getId(){ return $this->id; }
	public function getNome(){ return $this->nome; }
	public function getUsuario(){ return $this->usuario; }

	/*SETTERS*/
	public function setId($input){ $this->id = $input; }
	public function setNome($input){ $this->nome = $input; }
	public function setUsuario(Usuario $input){ $this->usuario = $input; }

	/*OTHERS*/
	public function JsonSerialize() {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'usuario' => $this->getUsuario()
        	];
    }

}

?>