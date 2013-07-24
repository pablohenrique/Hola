<?php
/*
 * Esta parte foi parada devido a uma mudanca no Hola. Sera continuada quando sair da versao alpha.
*/
namespace Hola\Model;

use \JsonSerializable;

class Item implements JsonSerializable{
	private $nome;

	public function __construct($nome = null){
		if(!is_null($nome))
			self::setNome($nome);
	}

	/*GETTERS*/
	public function getNome(){ return $this->nome; }
	public function getId(){ return self::getNome(); }

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