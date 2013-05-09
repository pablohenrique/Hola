<?php

namespace Hola\Service;

use	Hola\DAO\postgresql\Factory,
	Hola\DAO\postgresql\ItemDAO,
	Hola\Model\Item;

require_once(__DIR__ . '/../Autoloader.php');

class ItemService {

	private $dao;
	private $uservice;
	private $item;

	private function createObject($nome, $usuario, $id = null){
		$this->item = new Item();
		$this->item->setNome($nome);
		$this->item->setUsuario($this->uservice->get($usuario));
		if(!is_null($id))
			$this->item->setId($id);
		return $this->item;
	}

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getItemDAO();
		$this->uservice = new UsuarioService();
	}

	public function post($nome, $usuario, $id = null){
		$this->dao->post(self::createObject($nome, $id));
		unset($this->item);
	}

	public function search($input = null){
		if(is_numeric($input))
			return $this->dao->get($input);
		if(!is_null($input))
			return $this->dao->read($input);
		else
			return $this->dao->getAll();
	}

	public function update($nome, $usuario, $id){
		return $this->dao->update(self::createObject($nome,$id));
		unset($this->item);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>