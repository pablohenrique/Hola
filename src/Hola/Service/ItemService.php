<?php

namespace Hola\Service;

use	Hola\DAO\postgresql\Factory,
	Hola\DAO\postgresql\ItemDAO,
	Hola\Model\Item;

class ItemService {

	private $dao;
	private $usuarioservice;
	private $item;

	private function createObject($nome, $usuario, $id = null){
		$this->usuarioservice = new UsuarioService();
		$this->item = new Item();
		$this->item->setNome($nome);
		$this->item->setUsuario($this->usuarioservice->search($usuario));
		if(!is_null($id))
			$this->item->setId($id);
		return $this->item;
	}

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getItemDAO();
	}

	public function post($nome, $usuario, $id = null){
		$this->dao->post(self::createObject($nome, $usuario, $id));
		unset($this->item,$this->usuarioservice);
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
		$this->dao->update(self::createObject($nome, $usuario, $id));
		unset($this->item,$this->usuarioservice);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>