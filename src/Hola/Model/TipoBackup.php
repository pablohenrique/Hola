<?php

namespace Hola\Model;

use \JsonSerializable,
	Hola\util\LazyDelCollection;

class Tipo implements JsonSerializable{
	private $nome;
	private $itens;

	public function __construct($nome = null, $itens = null){
		$itens = new LazyDelCollection();
		if(!is_null($nome))
			self::setNome($nome);
		if(!is_null($itens))
			foreach ($itens as $value)
				self::addItem($value);
	}

	/*GETTERS*/
	public function getNome(){ return $this->nome; }
	public function getItem(){ return array_merge($this->itens->atuais(), $this->itens->novos()); }

	/*SETTERS*/
	public function setNome($input){ $this->nome = $input; }
	public function addItem(Item $item){ $this->item->add($item); }
    public function removeItem($id){ $this->item->remove($id); }

	/*OTHERS*/
	public function JsonSerialize() {
        return [
            'nome' => $this->getNome(),
            'itens' => $this->itens->
        	];
    }

}

?>