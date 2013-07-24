<?php

namespace Hola\Service;

use	Hola\DAO\postgresql\Factory,
	Hola\DAO\postgresql\TipoDAO,
	Hola\Model\Tipo;

class TipoService {

	private $dao;
	private $tipo;

	private function createObject($nome){
		$this->tipo = new Tipo($nome);
		return $this->tipo;
	}

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getTipoDAO();
	}

	public function post($nome){
		$this->dao->post(self::createObject(Security::preventXSS($nome)));
		unset($this->tipo);
	}

	public function search($input = null){
		if(!is_null($input))
			return $this->dao->read(Security::preventXSS($input));
		else
			return $this->dao->getAll();
	}

	public function update($nome){
		$this->dao->update(self::createObject(Security::preventXSS($nome)));
		unset($this->tipo);
	}

	public function delete($input){
		$this->dao->delete(Security::filterNumbers($input));
	}

}

?>