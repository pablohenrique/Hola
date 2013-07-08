<?php

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
		$this->tipoitem = new TipoItem();
		$this->tiposervice = new TipoService();
		$this->itemservice = new ItemService();
		$this->tipoitem->setTipo($this->tiposervice->search($tipo));
		$this->tipoitem->setItem($this->itemservice->search($item));
		return $this->tipoitem;
	}

	public function __construct(){
		$this->dao = Factory::getFactory(FACTORY::PGSQL)->getTipoItemDAO();
	}

	public function post($tipo, $item){
		$this->dao->post(self::createObject(Security::preventXSS($tipo), Security::preventXSS($item)));
		unset($this->tipoitem,$this->tiposervice,$this->itemservice);
	}

	public function search($input1 = null, $input2 = null){
		if(is_numeric($input1) && is_numeric($input2))
			return $this->dao->get(Security::filterNumbers($input1),Security::filterNumbers($input2));
		if(!is_null($input1) && !is_null($input2))
			return $this->dao->read(Security::preventXSS($input1),Security::preventXSS($input2));
		if(is_numeric($input1) && is_null($input2))
			return $this->dao->seek(Security::filterNumbers($input1));
		else
			return $this->dao->getAll();
	}

}

?>