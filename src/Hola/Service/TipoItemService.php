<?php
/*
 * Esta parte foi parada devido a uma mudanca no Hola. Sera continuada quando sair da versao alpha.
*/
namespace Hola\Service;

use	Hola\DAO\postgresql\Factory,
	Hola\DAO\postgresql\TipoItemDAO,
	Hola\Model\TipoItem;

class TipoItemService {

	private $dao;
	private $tipoitem;
	private $tiposervice;
	private $itemservice;

	private function createObject($tipo, $item){
		$this->tiposervice = new TipoService();
		$this->itemservice = new ItemService();
		$this->tipoitem = new TipoItem($this->tiposervice->search($tipo), $this->itemservice->search($item));
		return $this->tipoitem;
	}

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getTipoItemDAO();
	}

	public function post($tipo, $item){
		$this->dao->post(self::createObject(Security::filterLetters($tipo), Security::filterLetters($item)));
		unset($this->tipoitem,$this->tiposervice,$this->itemservice);
	}

	public function search($input1 = null, $input2 = null){
		if(!is_null($input1) && !is_null($input2))
			return $this->dao->read(Security::filterLetters($input1), Security::filterLetters($input2));
		if(is_string($input1) && is_null($input2))
			return $this->dao->seek(Security::filterLetters($input1));
		else
			return $this->dao->getAll();
	}

}

?>