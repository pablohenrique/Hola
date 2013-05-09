<?php

namespace Hola\Service;

use	Hola\DAO\postgresql\Factory,
	Hola\DAO\postgresql\DAO,
	Hola\Model\;

require_once(__DIR__ . '/../Autoloader.php');

class Service {

	private $dao;
	private $;

	private function createObject($nome, $id = null){
		$this-> = new ();
		$this->setNome($nome);
		if(!is_null($id))
			$this->setId($id);
		return $this->;
	}

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getDAO();
	}

	public function post($nome, $id = null){
		$this->dao->post(self::createObject($nome, $id));
		unset($this->);
	}

	public function search($input = null){
		if(is_numeric($input))
			return $this->dao->get($input);
		if(!is_null($input))
			return $this->dao->read($input);
		else
			return $this->dao->getAll();
	}

	public function seek($input){
		return $this->dao->seek($input);
	}

	public function update($nome, $id){
		return $this->dao->update(self::createObject($nome,$id));
		unset($this->);
	}

	public function delete($input){
		$this->dao->delete($input);
	}

}

?>