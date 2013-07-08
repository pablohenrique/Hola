<?php

namespace Hola\Service;

use	Hola\DAO\postgresql\Factory,
	Hola\DAO\postgresql\TipoDAO,
	Hola\Model\Tipo;

class TipoService {

	private $dao;
	private $tipo;

	private function createObject($nome, $id = null){
		$this->tipo = new Tipo();
		$this->tipo->setNome($nome);
		if(!is_null($id))
			$this->tipo->setId($id);
		return $this->tipo;
	}

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getTipoDAO();
	}

	public function post($nome, $id = null){
		$this->dao->post(self::createObject(Security::preventXSS($nome), Security::filterNumbers($id)));
		unset($this->tipo);
	}

	public function search($input = null){
		if(is_numeric($input))
			return $this->dao->get(Security::filterNumbers($input));
		if(!is_null($input))
			return $this->dao->read(Security::preventXSS($input));
		else
			return $this->dao->getAll();
	}

	public function update($nome, $id){
		$this->dao->update(self::createObject(Security::preventXSS($nome),Security::filterNumbers($id)));
		unset($this->tipo);
	}

	public function delete($input){
		$this->dao->delete(Security::filterNumbers($input));
	}

}

?>