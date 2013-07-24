<?php

namespace Hola\Service;

use	Hola\DAO\postgresql\Factory,
	Hola\DAO\postgresql\ItemDAO,
	Hola\Model\Item;

class ItemService {

	private $dao;
	private $item;

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getItemDAO();
	}

	private function createObject($nome){
		$this->item = new Item($nome);
		return $this->item;
	}

	public function post($nome, $usuario, $id = null){
		$this->dao->post(self::createObject(Security::filterLetters($nome));
		unset($this->item);
	}

	public function search($input = null){
		if(is_string($input))
			return $this->dao->read(Security::filterLetters($input));
		else
			return $this->dao->getAll();
	}

	public function update($nome, $usuario, $id){
		$this->dao->update(self::createObject(Security::filterLetters($nome)));
		unset($this->item);
	}

	public function delete($input){
		$this->dao->delete(Security::filterNumbers($input));
	}

}

?>